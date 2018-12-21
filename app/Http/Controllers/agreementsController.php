<?php

namespace App\Http\Controllers;

use App\Models\agreements;
use App\Models\Users;
use App\Models\Companies;
use Illuminate\Http\Request;

class agreementsController extends Controller
{

	private $date;

	public function __construct()
	{
		$this->data=[
			'm'=>'manage_processing',
			'sm'=>'agreements',
			'title'=>'កិច្ចសន្យាជួប',
	  // Notification agreements
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
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-file-contract"></i> កិច្ចសន្យាជួប</li>',
			// Select Data From Table
			'agreements' => agreements::orderBy('created_at', 'asc')->get(),
		];
		return view('agreements.index',$this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('quotations.index') .'"><i class="fa fa-file-contract"></i> កិច្ចសន្យាជួប</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
		];
		return view('agreements.create',$this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r)
	{
		dd($r->file());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\agreements  $agreements
	 * @return \Illuminate\Http\Response
	 */
	public function show(agreements $agreements)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\agreements  $agreements
	 * @return \Illuminate\Http\Response
	 */
	public function edit(agreements $agreements)
	{
		$this->data+=[
			// Select Data From Table
		  'appointment' => agreements::find($id),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
			'services' => Services::orderBy('s_name', 'asc')->get(),
		  'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('agreements.index') .'"><i class="fa fa-file-contract"></i> កិច្ចសន្យាជួប</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. agreements::find($id)->agr_files.'</li>',
		];
		return view('agreements.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\agreements  $agreements
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, agreements $agreements)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'agr_files' => 'required|date',
			'agr_company_id' => 'required',
			'agr_status' => 'required',
			'agr_services_id' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Insert to Table
		$agreements = agreements::find($id);
		$agreements->agr_files = $r->agr_files;
		$agreements->agr_user_id = $r->agr_user_id;
		$agreements->agr_company_id = $r->agr_company_id;
		$agreements->agr_status = $r->agr_status;
		$services_id = serialize($r->agr_services_id);
		$agreements->agr_services_id = $services_id;
		$agreements->agr_description = $r->agr_description;
		$agreements->agr_created_by = Auth::id();
		$agreements->agr_updated_by = Auth::id();
		$agreements->save();
		// Redirect
		return redirect()->route('agreements.index')
			->with('success', 'កាណាត់ជួបបានកែប្រែដោយជោគជ័យ: ' . $r->agr_files);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\agreements  $agreements
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(agreements $agreements)
	{
		// delete
		$app = agreements::find($id);
		$agr_files = $app->agr_files;
		$app->delete();
		// redirect
		return redirect()->route('agreements.index')
			->with('success', 'កាត់ជួបត្រូវបានលុបចោលដោយជោគជ័យ៖ '. $agr_files);
	}
}
