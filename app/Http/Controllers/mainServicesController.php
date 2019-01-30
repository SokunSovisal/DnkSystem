<?php

namespace App\Http\Controllers;

use App\Models\Mainservices;
use App\Models\Users;
use Illuminate\Http\Request;
use Validator;
use DB;

class mainServicesController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{  	
		$this->globalNotitfy = new Users();
		$this->module = '17';
		$this->data=[
			'm'=>'services',
			'sm'=>$this->module,
			'title'=>'សេវាកម្មធំៗ',
      // Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="far fa-heart"></i> សេវាកម្មធំៗ</li>',

			// Select Data From Table
			'm_services' => Mainservices::orderBy('ms_name', 'asc')->get(),
		];
		// return view('mainservices.index',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('mainservices.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('mainservices.index') .'"><i class="far fa-heart"></i> សេវាកម្មធំៗ</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
		];
		// return view('mainservices.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('mainservices.create',$this->data) : view('errors.permission',$this->data) );
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
			'ms_name' => 'required|unique:mainservices',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$mainservices = new Mainservices;
			$mainservices->ms_name = $r->ms_name;
			$mainservices->ms_description = $r->ms_description;
			$mainservices->save();

			// Redirect
			return redirect()->route('mainservices.index')
				->with('success', 'សេវាកម្មធំបានបញ្ចូលដោយជោគជ័យ: ' . $r->ms_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Mainservices  $mainservices
	 * @return \Illuminate\Http\Response
	 */
	public function show(Mainservices $mainservices)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Mainservices  $mainservices
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Mainservices $mainservices, $id)
	{
		$this->data+=[
			'ms' => Mainservices::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('mainservices.index') .'"><i class="far fa-heart"></i> សេវាកម្មធំៗ</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Mainservices::find($id)->ms_name.'</li>',
		];
		// return view('mainservices.edit',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('mainservices.edit',$this->data) : view('errors.permission',$this->data) );
	}


	public function update(Request $r, Mainservices $mainservices, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'ms_name' => 'required|unique:mainservices,ms_name,'.$id,
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update Item
			$mainservices = Mainservices::find($id);
			$mainservices->ms_name = $r->ms_name;
			$mainservices->ms_description = $r->ms_description;
			$mainservices->save();
	    // redirect
			return redirect()->route('mainservices.index')
				->with('success', 'សេវាកម្មធំបានកែប្រែដោយជោគជ័យ៖ ' . $r->ms_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function destroy(Mainservices $mainservices, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete Main service
	    $ms = Mainservices::find($id);
	    $ms_name = $ms->ms_name;
	    $ms->delete();
	    // redirect
			return redirect()->route('mainservices.index')
				->with('success', 'សេវាកម្មធំបានលុបចោលដោយជោគជ័យ៖ '. $ms_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
