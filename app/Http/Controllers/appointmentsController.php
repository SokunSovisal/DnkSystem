<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Companies;
use App\Models\Services;
use App\Models\Users;
use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;

class appointmentsController extends Controller
{


	private $date;

	public function __construct()
	{
		$this->data=[
			'm'=>'manage_processing',
			'sm'=>'appointments',
			'title'=>'ការណាត់ជួប',
      // Notification Appointments
			'appNotify' => new Users(),
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
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-comments"></i> ការណាត់ជួប</li>',
			// Select Data From Table
			'appointments' => Appointments::orderBy('app_datetime', 'asc')->get(),
		];
		return view('appointments.index',$this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('quotations.index') .'"><i class="fa fa-comments"></i> ការណាត់ជួប</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
			'services' => Services::orderBy('s_name', 'asc')->get(),
		];
		return view('appointments.create',$this->data);
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
			'app_datetime' => 'required|date',
			'app_user_id' => 'required',
			'app_company_id' => 'required',
			'app_status' => 'required',
			'app_services_id' => 'required',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Insert to Table
		$appointments = new Appointments;
		$appointments->app_datetime = $r->app_datetime;
		$appointments->app_user_id = $r->app_user_id;
		$appointments->app_company_id = $r->app_company_id;
		$appointments->app_status = $r->app_status;
		$services_id = serialize($r->app_services_id);
		$appointments->app_services_id = $services_id;
		$appointments->app_description = $r->app_description;
		$appointments->app_created_by = Auth::id();
		$appointments->app_updated_by = Auth::id();
		$appointments->save();
		// Redirect
		return redirect()->route('appointments.index')
			->with('success', 'កាណាត់ជួបបានបញ្ចូលដោយជោគជ័យ: ' . $r->app_datetime);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\appointments  $appointments
	 * @return \Illuminate\Http\Response
	 */
	public function show(appointments $appointments)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\appointments  $appointments
	 * @return \Illuminate\Http\Response
	 */
	public function edit(appointments $appointments,$id)
	{
    $this->data+=[
			// Select Data From Table
      'appointment' => Appointments::find($id),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
			'services' => Services::orderBy('s_name', 'asc')->get(),
      'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('appointments.index') .'"><i class="fa fa-comments"></i> ការណាត់ជួប</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Appointments::find($id)->app_datetime.'</li>',
    ];
    return view('appointments.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\appointments  $appointments
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, appointments $appointments, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'app_datetime' => 'required|date',
			'app_user_id' => 'required',
			'app_company_id' => 'required',
			'app_status' => 'required',
			'app_services_id' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Insert to Table
		$appointments = Appointments::find($id);
		$appointments->app_datetime = $r->app_datetime;
		$appointments->app_user_id = $r->app_user_id;
		$appointments->app_company_id = $r->app_company_id;
		$appointments->app_status = $r->app_status;
		$services_id = serialize($r->app_services_id);
		$appointments->app_services_id = $services_id;
		$appointments->app_description = $r->app_description;
		$appointments->app_created_by = Auth::id();
		$appointments->app_updated_by = Auth::id();
		$appointments->save();
		// Redirect
		return redirect()->route('appointments.index')
			->with('success', 'កាណាត់ជួបបានកែប្រែដោយជោគជ័យ: ' . $r->app_datetime);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\appointments  $appointments
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(appointments $appointments,$id)
	{
		// delete
		$app = Appointments::find($id);
		$app_datetime = $app->app_datetime;
		$app->delete();
		// redirect
		return redirect()->route('appointments.index')
			->with('success', 'កាត់ជួបត្រូវបានលុបចោលដោយជោគជ័យ៖ '. $app_datetime);
	}
}
