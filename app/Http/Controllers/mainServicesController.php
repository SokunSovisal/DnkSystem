<?php

namespace App\Http\Controllers;

use App\Models\Mainservices;
use Illuminate\Http\Request;
use Validator;
use DB;

class mainServicesController extends Controller
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
			'm'=>'services',
			'sm'=>'mainservices',
			'title'=>'សេវាកម្មធំៗ',
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
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="far fa-heart"></i> សេវាកម្មធំៗ</li>',

			// Select Data From Table
			// 'm_services' => Mainservices::orderBy('ms_name', 'asc')->limit(3)->get(),
			'm_services' => Mainservices::orderBy('ms_name', 'asc')->get(),
		];
		return view('mainservices.index',$this->data);
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
		return view('mainservices.create',$this->data);
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

		// Insert to Table
		$mainservices = new Mainservices;
		$mainservices->ms_name = $r->ms_name;
		$mainservices->ms_description = $r->ms_description;
		$mainservices->save();

		// Redirect
		return redirect()->route('mainservices.index')
			->with('success', 'សេវាកម្មធំបានបញ្ចូលដោយជោគជ័យ: ' . $r->ms_name);
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
		return view('mainservices.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Mainservices  $mainservices
	 * @return \Illuminate\Http\Response
	 */
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
		// Update Item
		$mainservices = Mainservices::find($id);
		$mainservices->ms_name = $r->ms_name;
		$mainservices->ms_description = $r->ms_description;
		$mainservices->save();
    // redirect
		return redirect()->route('mainservices.index')
			->with('success', 'សេវាកម្មធំបានកែប្រែដោយជោគជ័យ៖ ' . $r->ms_name);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Mainservices  $mainservices
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Mainservices $mainservices, $id)
	{
		// delete Main service
    $ms = Mainservices::find($id);
    $ms_name = $ms->ms_name;
    $ms->delete();
    // redirect
		return redirect()->route('mainservices.index')
			->with('success', 'សេវាកម្មធំបានលុបចោលដោយជោគជ័យ៖ '. $ms_name);
	}
}