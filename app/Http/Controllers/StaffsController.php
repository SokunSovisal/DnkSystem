<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use App\Models\Users;
use Illuminate\Http\Request;
use Validator;
use Auth;

class StaffsController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '18';
		$this->data=[
			'title'=>'បុគ្គលិក',
			'm'=>'manage_users',
			'sm'=>$this->module,
			// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}
	
	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-user-friends"></i> បុគ្គលិក</li>',
			// Select Data From Table
			'staffs' => Staffs::orderBy('st_name', 'asc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('staffs.index',$this->data) : view('errors.permission',$this->data) );
	}


	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('services.index') .'"><i class="fa fa-user-friends"></i> បុគ្គលិក</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
		];
		// return view('services.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('staffs.create',$this->data) : view('errors.permission',$this->data) );
	}


	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'st_name' => 'required',
			'st_gender' => 'required',
			'st_salary' => 'required|numeric',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$staff = new Staffs;
			$staff->st_name = $r->st_name;
			$staff->st_gender = $r->st_gender;
			$staff->st_position = $r->st_position;
			$staff->st_salary = $r->st_salary;
			$staff->st_phone = $r->st_phone;
			$staff->st_email = $r->st_email;
			$staff->st_description = $r->st_description;
			$staff->st_created_by = Auth::id();
			$staff->st_updated_by = Auth::id();
			$staff->save();

			// Redirect
			return redirect()->route('staffs.index')
				->with('success', 'បុគ្គលិកបានបញ្ចូលដោយជោគជ័យ: ' . $r->s_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function show(Staffs $staffs)
	{
		//
	}


	public function edit(Staffs $staffs, $id)
	{
		$this->data+=[
			'staff' => Staffs::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('staffs.index') .'"><i class="fa fa-user-friends"></i> បុគ្គលិក</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Staffs::find($id)->st_name.'</li>',
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('staffs.edit',$this->data) : view('errors.permission',$this->data) );
	}


	public function update(Request $r, Staffs $staffs, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'st_name' => 'required',
			'st_gender' => 'required',
			'st_salary' => 'required|numeric',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$staff = Staffs::find($id);
			$staff->st_name = $r->st_name;
			$staff->st_gender = $r->st_gender;
			$staff->st_position = $r->st_position;
			$staff->st_salary = $r->st_salary;
			$staff->st_phone = $r->st_phone;
			$staff->st_email = $r->st_email;
			$staff->st_description = $r->st_description;
			$staff->st_updated_by = Auth::id();
			$staff->save();

			// Redirect
			return redirect()->route('staffs.index')
				->with('success', 'បុគ្គលិកបានបញ្ចូលដោយជោគជ័យ: ' . $r->s_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function destroy(Staffs $staffs, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
			$staff = Staffs::find($id);
			$st_name = $staff->st_name;
			$staff->delete();

			// redirect
				return redirect()->route('staffs.index')
					->with('success', 'បុគ្គលិកបានលុបចោលដោយជោគជ័យ៖ '. $st_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
