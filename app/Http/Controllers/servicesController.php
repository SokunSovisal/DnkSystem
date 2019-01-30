<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Services;
use App\Models\Mainservices;
use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;

class servicesController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '24';
		$this->data=[
			'title'=>'សេវាកម្មទាំងអស់',
			'm'=>'services',
			'sm'=>$this->module,
			// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-heart"></i> សេវាកម្មទាំងអស់</li>',

			// Select Data From Table
			'services' => Services::orderBy('s_name', 'asc')->get(),
		];
		// return view('services.index',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('services.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('services.index') .'"><i class="fa fa-heart"></i> សេវាកម្មទាំងអស់</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			'm_services' => Mainservices::orderBy('ms_name', 'asc')->get(),
		];
		// return view('services.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('services.create',$this->data) : view('errors.permission',$this->data) );
	}


	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			's_name' => 'required',
			's_price' => 'required|numeric',
			's_ms_id' => 'required',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$services = new services;
			$services->s_name = $r->s_name;
			$services->s_price = $r->s_price;
			$services->s_ms_id = $r->s_ms_id;
			$services->s_description = $r->s_description;
			$services->s_created_by = Auth::id();
			$services->s_updated_by = Auth::id();
			$services->save();

			// Redirect
			return redirect()->route('services.index')
				->with('success', 'សេវាកម្មបានបញ្ចូលដោយជោគជ័យ: ' . $r->s_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Services  $services
	 * @return \Illuminate\Http\Response
	 */
	public function show(Services $services)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Services  $services
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Services $services, $id)
	{
		$this->data+=[
			'service' => Services::find($id),
			'm_services' => Mainservices::orderBy('ms_name', 'asc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('services.index') .'"><i class="fa fa-heart"></i> សេវាកម្មទាំងអស់</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Services::find($id)->s_name.'</li>',
		];
		// return view('services.edit',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('services.edit',$this->data) : view('errors.permission',$this->data) );
	}

	
	public function update(Request $r, Services $services, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			's_name' => 'required',
			's_price' => 'required|numeric',
			's_ms_id' => 'required',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update Item
			$services = Services::find($id);
			$services->s_name = $r->s_name;
			$services->s_price = $r->s_price;
			$services->s_ms_id = $r->s_ms_id;
			$services->s_description = $r->s_description;
			$services->s_updated_by = Auth::id();
			$services->save();

		// redirect
			return redirect()->route('services.index')
			->with('success', 'សេវាកម្មបានកែប្រែដោយជោគជ័យ៖ ' . $r->s_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function destroy(Services $services, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
			$s = Services::find($id);
			$s_name = $s->s_name;
			$s->delete();

			// redirect
				return redirect()->route('services.index')
					->with('success', 'សេវាកម្មបានលុបចោលដោយជោគជ័យ៖ '. $s_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
