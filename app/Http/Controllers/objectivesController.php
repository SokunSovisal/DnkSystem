<?php

namespace App\Http\Controllers;

use App\Models\Objectives;
use App\Models\Users;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;

class objectivesController extends Controller
{
	
	
	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '13';
		$this->data=[
			'm'=>'manage_companies',
			'sm'=>$this->module,
			'title'=>'សកម្មភាពអាជីវកម្ម',
      // Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}
	
	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-database"></i> សកម្មភាពអាជីវកម្ម</li>',

			// Select Data From Table
			'objectives' => Objectives::orderBy('obj_name', 'asc')->get(),
		];
		// return view('objectives.index',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('objectives.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('objectives.index') .'"><i class="fa fa-database"></i> សកម្មភាពអាជីវកម្ម</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
		];
		// return view('objectives.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('objectives.create',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $r
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'obj_name' => 'required|unique:objectives',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$objectives = new Objectives;
			$objectives->obj_name = $r->obj_name;
			$objectives->obj_description = $r->obj_description;
			$objectives->obj_created_by = Auth::id();
			$objectives->obj_updated_by = Auth::id();
			$objectives->save();

			// Redirect
			return redirect()->route('objectives.index')
				->with('success', 'សកម្មវភាពបានបញ្ចូលដោយជោគជ័យ: ' . $r->obj_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Objectives  $objectives
	 * @return \Illuminate\Http\Response
	 */
	public function show(Objectives $objectives)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Objectives  $objectives
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Objectives $objectives, $id)
	{
		$this->data+=[
			'obj' => Objectives::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('objectives.index') .'"><i class="fa fa-database"></i> សកម្មភាពអាជីវកម្ម</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Objectives::find($id)->obj_name.'</li>',
		];
		// return view('objectives.edit',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('objectives.edit',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $r
	 * @param  \App\Models\Objectives  $objectives
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, Objectives $objectives, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'obj_name' => 'required|unique:objectives,obj_name,'.$id,
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update Item
			$objectives = Objectives::find($id);
			$objectives->obj_name = $r->obj_name;
			$objectives->obj_description = $r->obj_description;
			$objectives->obj_updated_by = Auth::id();
			$objectives->save();

	    // redirect
			return redirect()->route('objectives.index')
				->with('success', 'សកម្មវភាពបានកែប្រែដោយជោគជ័យ៖ ' . $r->obj_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Objectives  $objectives
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Objectives $objectives, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
	    $obj = Objectives::find($id);
	    $obj_name = $obj->obj_name;
	    $obj->delete();
	    // redirect
			return redirect()->route('objectives.index')
				->with('success', 'សកម្មវភាពបានលុបចោលដោយជោគជ័យ៖ '. $obj_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
