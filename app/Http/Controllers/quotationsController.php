<?php

namespace App\Http\Controllers;

use App\Models\Quotations;
use App\Models\quotation_services;
use App\Models\Appointments;
use App\Models\Companies;
use App\Models\Services;
use App\Models\Users;
use Illuminate\Http\Request;
use Auth;
use Validator;

class quotationsController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '3';
		$this->data=[
			'm'=>'manage_income',
			'sm'=>$this->module,
			'title'=>'សម្រង់តម្លៃ',
		  // Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
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
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-file-alt"></i> សម្រង់តម្លៃ</li>',
			// Select Data From Table
			'quotations' => Quotations::orderBy('quote_date', 'asc')->get(),
		];
		// return view('quotations.index',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('quotations.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('quotations.index') .'"><i class="fa fa-file-alt"></i> សម្រង់តម្លៃ</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'quote' => Quotations::orderBy('created_at', 'desc')->first(),
			'companies' => Companies::where('com_type', 1)->orWhere('com_type', 3)->orderBy('com_name', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
		];
		// return view('quotations.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('quotations.create',$this->data) : view('errors.permission',$this->data) );
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
			'quote_number' => 'required|unique:quotations|numeric',
			'quote_date' => 'required|date',
			'quote_cp_name' => 'required',
			'quote_cp_phone' => 'required',
			'quote_company_id' => 'required',
			'quote_status' => 'required',
			'quote_purpose' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$quotation = new quotations;
			$quotation->quote_number = $r->quote_number;
			$quotation->quote_date = $r->quote_date;
			$quotation->quote_cp_name = $r->quote_cp_name;
			$quotation->quote_cp_phone = $r->quote_cp_phone;
			$quotation->quote_cp_email = $r->quote_cp_email;
			$quotation->quote_company_id = $r->quote_company_id;
			$quotation->quote_status = $r->quote_status;
			$quotation->quote_purpose = $r->quote_purpose;
			$quotation->quote_term = $r->quote_term;
			$quotation->quote_created_by = Auth::id();
			$quotation->quote_updated_by = Auth::id();
			$quotation->save();

			// Redirect
			return redirect()->route('quotations.index')
				->with('success', 'សម្រងតម្លៃបានបញ្ចូលដោយជោគជ័យ: ' . $r->quote_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\quotations  $quotations
	 * @return \Illuminate\Http\Response
	 */
	public function show(quotations $quotations, $id)
	{
    $this->data+=[
			// Select Data From Table
			'quote' => Quotations::find($id),
			'quotationservices' => quotation_services::all()->where('qs_quote_id',$id),
			'total_amount' => 0,
			// Select Data From Table
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('quotations.index') .'"><i class="fa fa-file-alt"></i> សម្រង់តម្លៃ</li></a></li><li class="active"><i class="fa fa-eye"></i> បង្ហាញ៖ '.Quotations::find($id)->quote_number.'</li>',
    ];
    // return view('quotations.show',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('quotations.show',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\quotations  $quotations
	 * @return \Illuminate\Http\Response
	 */
	public function edit(quotations $quotations,$id)
	{
    $this->data+=[
			// Select Data From Table
			'quote' => Quotations::find($id),
			'companies' => Companies::where('com_type', 1)->orWhere('com_type', 3)->orderBy('com_name', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
			// Select Data From Table
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('quotations.index') .'"><i class="fa fa-file-alt"></i> សម្រង់តម្លៃ</li></a></li><li class="active"><i class="fa fa-pencil-alt"></i> កែប្រែ៖ '.Quotations::find($id)->quote_number.'</li>',
    ];
    // return view('quotations.edit',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('quotations.edit',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\quotations  $quotations
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, quotations $quotations,$id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'quote_date' => 'required|date',
			'quote_cp_name' => 'required',
			'quote_cp_phone' => 'required',
			'quote_cp_email' => 'email',
			'quote_company_id' => 'required',
			'quote_status' => 'required',
			'quote_purpose' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$quotation = Quotations::find($id);
			$quotation->quote_date = $r->quote_date;
			$quotation->quote_cp_name = $r->quote_cp_name;
			$quotation->quote_cp_phone = $r->quote_cp_phone;
			$quotation->quote_cp_email = $r->quote_cp_email;
			$quotation->quote_company_id = $r->quote_company_id;
			$quotation->quote_status = $r->quote_status;
			$quotation->quote_purpose = $r->quote_purpose;
			$quotation->quote_term = $r->quote_term;
			$quotation->quote_created_by = Auth::id();
			$quotation->quote_updated_by = Auth::id();
			$quotation->save();

			// Redirect
			return redirect()->route('quotations.index')
				->with('success', 'សម្រងតម្លៃបានកែប្រែដោយជោគជ័យ: ' . $r->quote_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\quotations  $quotations
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(quotations $quotations,$id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
			$quote = Quotations::find($id);
			$quote_number = $quote->quote_number;
			$quote->delete();
			// redirect
			return redirect()->route('quotations.index')
				->with('success', 'សម្រង់តម្លៃបានលុបចោលដោយជោគជ័យ៖ '. $quote_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
