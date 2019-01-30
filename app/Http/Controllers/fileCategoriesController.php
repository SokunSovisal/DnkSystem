<?php

namespace App\Http\Controllers;

use App\Models\file_categories;
use App\Models\Users;
use Illuminate\Http\Request;
use Validator;
use Auth;

class fileCategoriesController extends Controller
{
	
	private $date;
	private $globalNotitfy;
	private $module;

	public function __construct()
	{  	
		$this->globalNotitfy = new Users();
		$this->module = '15';
		$this->data=[
			'm'=>'manage_companies',
			'sm'=>$this->module,
			'title'=>'ផ្នែកឯកសារ',
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
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="far fa-heart"></i> ផ្នែកឯកសារ</li>',

			// Select Data From Table
			// 'm_services' => filecategories::orderBy('fc_name', 'asc')->limit(3)->get(),
			'filecategories' => file_categories::orderBy('fc_name', 'asc')->get(),
		];
		// return view('filecategories.index',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('filecategories.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('filecategories.index') .'"><i class="far fa-heart"></i> ផ្នែកឯកសារ</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
		];
		// return view('filecategories.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('filecategories.create',$this->data) : view('errors.permission',$this->data) );
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
			'fc_name' => 'required|unique:file_categories',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$filecategories = new file_categories;
			$filecategories->fc_name = $r->fc_name;
			$filecategories->fc_description = $r->fc_description;
			$filecategories->fc_created_by = Auth::id();
			$filecategories->fc_updated_by = Auth::id();
			$filecategories->save();

			// Redirect
			return redirect()->route('filecategories.index')
				->with('success', 'ផ្នែកឯកសារបានបញ្ចូលដោយជោគជ័យ: ' . $r->fc_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\file_categories  $file_categories
	 * @return \Illuminate\Http\Response
	 */
	public function show(file_categories $file_categories, $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\file_categories  $file_categories
	 * @return \Illuminate\Http\Response
	 */
	public function edit(file_categories $file_categories, $id)
	{
		$this->data+=[
			'filecategory' => file_categories::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('filecategories.index') .'"><i class="far fa-heart"></i> ផ្នែកឯកសារ</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. file_categories::find($id)->fc_name.'</li>',
		];
		// return view('filecategories.edit',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('filecategories.edit',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\file_categories  $file_categories
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, file_categories $file_categories, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'fc_name' => 'required|unique:file_categories,fc_name,'.$id,
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update Item
			$filecategories = file_categories::find($id);
			$filecategories->fc_name = $r->fc_name;
			$filecategories->fc_description = $r->fc_description;
			$filecategories->fc_updated_by = Auth::id();
			$filecategories->save();
	    // redirect
			return redirect()->route('filecategories.index')
				->with('success', 'ផ្នែកឯកសារបានកែប្រែដោយជោគជ័យ៖ ' . $r->fc_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\file_categories  $file_categories
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(file_categories $file_categories, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete Main service
			$filecategory = file_categories::find($id);
			$fc_name = $filecategory->fc_name;
			$filecategory->delete();
			// redirect
				return redirect()->route('filecategories.index')
					->with('success', 'ផ្នែកឯកសារបានលុបចោលដោយជោគជ័យ៖ '. $fc_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
