<?php

namespace App\Http\Controllers;

use App\Models\companies;
use App\Models\Users;
use App\Models\file_categories;
use App\Models\Files;
use Illuminate\Http\Request;
use Validator;
use File;
use Image;
use Auth;
use Response;

class filesController extends Controller
{

	private $date;
	private $path;
	private $globalNotitfy;
	private $module;

	public function __construct()
	{  	
		// Define Upload Image Path
		$this->path=public_path().'/documents/';
		$this->globalNotitfy = new Users();
		$this->module = '16';

		$this->data=[
			'm'=>'manage_companies',
			'sm'=>$this->module,
			'title'=>'ឯកសារ',
      // Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="far fa-file-alt"></i> ឯកសារ</li>',

			// Select Data From Table
			// 'm_services' => filecategories::orderBy('fc_name', 'asc')->limit(3)->get(),
			'files' => Files::all(),
			'companies' => Companies::where('com_type', 1)->orWhere('com_type', 3)->orderBy('com_name', 'asc')->get(),
			'filecategories' => file_categories::orderBy('fc_name', 'asc')->get(),
		];
		// return view('files.index',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('files.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('quotations.index') .'"><i class="far fa-file-alt"></i> ឯកសារ</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'companies' => Companies::where('com_type', 1)->orWhere('com_type', 3)->orderBy('com_name', 'asc')->get(),
			'filecategories' => file_categories::orderBy('fc_name', 'asc')->get(),
		];
		// return view('files.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('files.create',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'f_name' => 'required|unique:files',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			$file = $r->file('f_document');
			if($r->hasFile('f_document')){
				if ($file->getClientOriginalExtension()=='pdf') {
					$f_document=time().'_'.str_replace(' ', '-', $r->f_name).'.pdf';
					if (!File::exists($this->path.$r->f_company_id.'/')) {
						File::makeDirectory($this->path.$r->f_company_id.'/');
					}
					$file->move($this->path.$r->f_company_id.'/', $f_document);
				}else{
					if ($file->getClientOriginalExtension()=='png') {
						$f_document=time().'_'.str_replace(' ', '-', $r->f_name).'.png';
						if (!File::exists($this->path.$r->f_company_id.'/')) {
							File::makeDirectory($this->path.$r->f_company_id.'/');
						}
						Image::make($file->getRealPath())->save($this->path.$r->f_company_id.'/'.$f_document);
					}else{
						$f_document=time().'_'.str_replace(' ', '-', $r->f_name).'.jpg';
						if (!File::exists($this->path.$r->f_company_id.'/')) {
							File::makeDirectory($this->path.$r->f_company_id.'/');
						}
						Image::make($file->getRealPath())->save($this->path.$r->f_company_id.'/'.$f_document);
					}
				}
			}
			// Insert Agreegments
			$files = new Files;
			$files->f_name = $f_document;
			$files->f_description = $r->f_description;
			$files->f_fc_id = $r->f_fc_id;
			$files->f_company_id = $r->f_company_id;
			$files->f_created_by = Auth::id();
			$files->f_updated_by = Auth::id();
			$files->save();
			// Redirect
			return redirect()->route('files.show',$r->f_company_id)
				->with('success', 'ឯកសារបានបញ្ចូលដោយជោគជ័យ: ' . $r->f_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\file  $file
	 * @return \Illuminate\Http\Response
	 */
	public function show(file $file, $id)
	{
		$this->data += [
			'files' => Files::orderBy('f_fc_id', 'asc')->where('f_company_id',$id)->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('files.index') .'"><i class="far fa-file-alt"></i> ឯកសារ</a></li><li class="active"><i class="far fa-building"></i> មើលឯកសារក្នុងក្រុមហ៊ុន៖ '.Companies::find($id)->com_name.'</li>',
		];
		// return view('files.show',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('files.show',$this->data) : view('errors.permission',$this->data) );
	}

	public function pdfViewer($id)
	{
		$file = Files::find($id);
		$filename = $file->f_name;
		$path = $this->path.$file->f_company_id.'/'.$filename;
		// return response()->file($path);
		return (($this->globalNotitfy->permission($this->module)=='true')? response()->file($path) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\file  $file
	 * @return \Illuminate\Http\Response
	 */
	public function edit(file $file)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\file  $file
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, file $file)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\file  $file
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(file $file, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
			$file = Files::find($id);
			$f_name = $file->f_name;
			$f_company_id = $file->f_company_id;
			$file->delete();
			if ($f_name!='default_company.png') {
				File::delete($this->path.$f_company_id.'/'.$f_name);
			}
			// redirect
			return redirect()->route('files.show',$f_company_id)
				->with('success', 'ក្រុមហ៊ុនបានលុបចោលដោយជោគជ័យ៖ '. substr($file->f_name, strpos($file->f_name, "_") + 1));
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
