<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Districts;
use App\Models\Provinces;
use Illuminate\Http\Request;
use Validator;

class districtsController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{  	
		$this->globalNotitfy = new Users();
		$this->module = '23';
		$this->data=[
			'title'=>'ទីតាំងស្រុក',
			'm'=>'manage_location',
			'sm'=>$this->module,
      // Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-heart"></i> ទីតាំងស្រុក</li>',

			// Select Data From Table
			'districts' => Districts::orderBy('dist_province_id', 'asc')->get(),
		];
		// return view('districts.index',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('districts.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('districts.index') .'"><i class="fa fa-heart"></i> ទីតាំងស្រុក</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			'provinces' => Provinces::orderBy('pro_description', 'asc')->get(),
		];
		// return view('districts.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('districts.create',$this->data) : view('errors.permission',$this->data) );
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
			'dist_name' => 'required',
			'dist_code' => 'required|numeric',
			'dist_province_id' => 'required',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$districts = new districts;
			$districts->dist_name = $r->dist_name;
			$districts->dist_code = $r->dist_code;
			$districts->dist_province_id = $r->dist_province_id;
			$districts->dist_description = $r->dist_description;
			$districts->save();

			// Redirect
			return redirect()->route('districts.index')
				->with('success', 'ទីតាំងស្រុកបានបញ្ចូលដោយជោគជ័យ: ' . $r->dist_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\districts  $districts
	 * @return \Illuminate\Http\Response
	 */
	public function show(districts $districts)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\districts  $districts
	 * @return \Illuminate\Http\Response
	 */
	public function edit(districts $districts, $id)
	{
		$this->data+=[
			'dist' => Districts::find($id),
			'provinces' => Provinces::orderBy('pro_description', 'asc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('districts.index') .'"><i class="fa fa-heart"></i> ទីតាំងស្រុក</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Districts::find($id)->dist_name.'</li>',
		];
		// return view('districts.edit',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('districts.edit',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\districts  $districts
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, districts $districts, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'dist_name' => 'required',
			'dist_code' => 'required|numeric',
			'dist_province_id' => 'required',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update Item
			$districts = Districts::find($id);
			$districts->dist_name = $r->dist_name;
			$districts->dist_code = $r->dist_code;
			$districts->dist_province_id = $r->dist_province_id;
			$districts->dist_description = $r->dist_description;
			$districts->save();

			// redirect
			return redirect()->route('districts.index')
				->with('success', 'ទីតាំងស្រុកបានកែប្រែដោយជោគជ័យ៖ ' . $r->dist_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\districts  $districts
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(districts $districts, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
			$s = Districts::find($id);
			$dist_name = $s->dist_name;
			$s->delete();

			// redirect
			return redirect()->route('districts.index')
				->with('success', 'ទីតាំងស្រុកបានលុបចោលដោយជោគជ័យ៖ '. $dist_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
