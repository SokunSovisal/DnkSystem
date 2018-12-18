<?php

namespace App\Http\Controllers;

use App\Models\Objectives;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;

class objectivesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	
	private $date;

	public function __construct()
	{
  	$today = date("Y-m-d", time());
  	$timeNow = date("h:i:s", time());
  	
		$this->data=[
			'm'=>'manage_companies',
			'sm'=>'objectives',
			'title'=>'សកម្មភាពអាជីវកម្ម',
      // Notification Appointments
      'app_alert' => DB::table('appointments')
                          ->whereDate('app_datetime','<=', $today)
                          ->whereTime('app_datetime', '<=', $timeNow)
                          ->where('app_status',1)
                          ->get(),
		];
	}
	
	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-database"></i> សកម្មភាពអាជីវកម្ម</li>',

			// Select Data From Table
			'objectives' => Objectives::orderBy('obj_name', 'asc')->get(),
		];
		return view('objectives.index',$this->data);
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
		return view('objectives.create',$this->data);
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
		return view('objectives.edit',$this->data);
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

		// Update Item
		$objectives = Objectives::find($id);
		$objectives->obj_name = $r->obj_name;
		$objectives->obj_description = $r->obj_description;
		$objectives->obj_updated_by = Auth::id();
		$objectives->save();

    // redirect
		return redirect()->route('objectives.index')
			->with('success', 'សកម្មវភាពបានកែប្រែដោយជោគជ័យ៖ ' . $r->obj_name);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Objectives  $objectives
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Objectives $objectives, $id)
	{
		// delete
    $obj = Objectives::find($id);
    $obj_name = $obj->obj_name;
    $obj->delete();
    // redirect
		return redirect()->route('objectives.index')
			->with('success', 'សកម្មវភាពបានលុបចោលដោយជោគជ័យ៖ '. $obj_name);
	}
}
