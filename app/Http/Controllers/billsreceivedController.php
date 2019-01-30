<?php

namespace App\Http\Controllers;

use App\Models\bills;
use App\Models\Users;
use App\Models\Companies;
use Illuminate\Http\Request;
use Validator;
use Auth;


class billsreceivedController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '6';
		$this->data=[
			'm'=>'manage_expense',
			'sm'=>$this->module,
			'title'=>'វិក្កយបត្រចំណាយ',
	  	// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}
	

	public function index()
	{
		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-file-invoice"></i> វិក្កយបត្រចំណាយ</li>',

			// Select Data From Table
			'billsreceived' => bills::orderBy('br_number', 'asc')->get(),
		];
		// return view('billsreceived.index', $this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('billsreceived.index',$this->data) : view('errors.permission',$this->data) );
	}


	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('billsreceived.index') .'"><i class="fa fa-file-invoice"></i> វិក្កយបត្រចំណាយ</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'companies' => Companies::where('com_type', 2)->orWhere('com_type', 3)->orderBy('com_name', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
		];
		// return view('billsreceived.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('billsreceived.create',$this->data) : view('errors.permission',$this->data) );
	}


	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'br_date' => 'required|date',
			'br_company_id' => 'required',
			'br_total' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$bill = new bills;
			$bill->br_number = $r->br_number;
			$bill->br_date = $r->br_date;
			$bill->br_company_id = $r->br_company_id;
			$bill->br_total = $r->br_total;
			$bill->br_description = $r->br_description;
			$bill->br_created_by = Auth::id();
			$bill->br_updated_by = Auth::id();
			$bill->save();

			// Redirect
			return redirect()->route('billsreceived.index')
				->with('success', 'វិក្កយបត្រចំណាយបានបញ្ចូលដោយជោគជ័យ: ' . $r->br_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\bills  $bills
	 * @return \Illuminate\Http\Response
	 */
	public function show(bills $bills)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\bills  $bills
	 * @return \Illuminate\Http\Response
	 */
	public function edit(bills $bills, $id)
	{
		$this->data+=[
			'billsreceived' => bills::find($id),
			'companies' => Companies::where('com_type', 2)->orWhere('com_type', 3)->orderBy('com_name', 'asc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('billsreceived.index') .'"><i class="fa fa-file-invoice"></i> វិក្កយបត្រចំណាយ</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. bills::find($id)->br_number.'</li>',
		];
		// return view('billsreceived.edit',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('billsreceived.edit',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\bills  $bills
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, bills $bills, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'br_date' => 'required|date',
			'br_company_id' => 'required',
			'br_total' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update to Table
			$bill = bills::find($id);
			$bill->br_number = $r->br_number;
			$bill->br_date = $r->br_date;
			$bill->br_company_id = $r->br_company_id;
			$bill->br_total = $r->br_total;
			$bill->br_description = $r->br_description;
			$bill->br_updated_by = Auth::id();
			$bill->save();

			// Redirect
			return redirect()->route('billsreceived.index')
				->with('success', 'វិក្កយបត្រចំណាយបានបញ្ចូលដោយជោគជ័យ: ' . $r->br_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\bills  $bills
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(bills $bills, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete Main service
	    $bill = bills::find($id);
	    $br_number = $bill->br_number;
	    $bill->delete();
	    // redirect
			return redirect()->route('billsreceived.index')
				->with('success', 'វិក្កយបត្របានលុបចោលដោយជោគជ័យ៖ '. $br_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
