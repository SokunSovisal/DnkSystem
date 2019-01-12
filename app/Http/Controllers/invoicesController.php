<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\invoice;
use App\Models\services;
use App\Models\invoice_detail;
use App\Models\quotations;
use App\Models\Companies;
use Illuminate\Http\Request;
use Validator;
use Auth;
class invoicesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	private $date;

	public function __construct()
	{  	
		$this->data=[
			'm'=>'manage_processing',
			'sm'=>'invoices',
			'title'=>'វិក្កយបត្រ',
	  	// Notification Appointments
			'appNotify' => new Users(),
		];
	}
	
	public function index()
	{
		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-file-invoice"></i> វិក្កយបត្រ</li>',

			// Select Data From Table
			'invoices' => invoice::orderBy('inv_number', 'asc')->get(),
		];
		return view('invoices.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('invoices.index') .'"><i class="fa fa-file-invoice"></i> វិក្កយបត្រ</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'invoice' => invoice::orderBy('created_at', 'desc')->first(),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'quotations' => quotations::orderBy('created_at', 'desc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
		];
		return view('invoices.create',$this->data);
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
			'inv_number' => 'required|unique:invoices|numeric',
			'inv_date' => 'required|date',
			'inv_company_id' => 'required',
			'inv_vat_status' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Insert to Table
		$invoice = new invoice;
		$invoice->inv_number = $r->inv_number;
		$invoice->inv_date = $r->inv_date;
		$invoice->inv_company_id = $r->inv_company_id;
		$invoice->inv_com_phone = $r->inv_com_phone;
		$invoice->inv_com_address = $r->inv_com_address;
		$invoice->inv_vat_status = $r->inv_vat_status;
		$invoice->inv_quote_refer = $r->inv_quote_refer;
		$invoice->inv_description = $r->inv_description;
		$invoice->inv_created_by = Auth::id();
		$invoice->inv_updated_by = Auth::id();
		$invoice->save();

		// Redirect
		return redirect()->route('invoices.index')
			->with('success', 'វិក្កយបត្របានបញ្ចូលដោយជោគជ័យ: ' . $r->inv_number);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function detail($id)
	{
			$this->data +=[
				// Select Data From Table
				'invoices' => invoice::find($id),
				'quotations' => quotations::orderBy('quote_number','desc')->get(),
				'invoice_detail' => invoice_detail::where('invd_invoice_id', $id)->get(),
				'services' => Services::orderBy('s_name', 'asc')->get(),
				'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('invoices.index') .'"><i class="fa fa-file-invoice"></i> វិក្កយបត្រ</li></a></li><li class="active"><i class="fa fa-info"></i> វិក្កយបត្រលម្អិត: '.invoice::find($id)->inv_number.'</li>',
			];
			return view('invoices.detail', $this->data);
	}

	// public function updateDtail(Request $r, invoice $invoice)
	// {
	// 	//
	// }


	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
    $this->data+=[
			// Select Data From Table
			'invoice' => invoice::find($id),
			'invoice_detail' => invoice_detail::all()->where('invd_invoice_id',$id),
			'total_amount' => 0,
			// Select Data From Table
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('invoices.index') .'"><i class="fa fa-file-invoice"></i> វិក្កយបត្រ</li></a></li><li class="active"><i class="fa fa-eye"></i> បង្ហាញ៖ '.invoice::find($id)->inv_number.'</li>',
    ];
    return view('invoices.show',$this->data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$this->data+=[
			'invoice' => invoice::find($id),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'quotations' => quotations::orderBy('created_at', 'desc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('mainservices.index') .'"><i class="fa fa-file-invoice"></i> វិក្កយបត្រ</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. invoice::find($id)->inv_number.'</li>',
		];
		return view('invoices.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'inv_number' => 'required|numeric|unique:invoices,inv_number,'.$id,
			'inv_date' => 'required|date',
			'inv_company_id' => 'required',
			'inv_vat_status' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Insert to Table
		$invoice = invoice::find($id);
		$invoice->inv_number = $r->inv_number;
		$invoice->inv_date = $r->inv_date;
		$invoice->inv_company_id = $r->inv_company_id;
		$invoice->inv_com_phone = $r->inv_com_phone;
		$invoice->inv_com_address = $r->inv_com_address;
		$invoice->inv_vat_status = $r->inv_vat_status;
		$invoice->inv_quote_refer = $r->inv_quote_refer;
		$invoice->inv_description = $r->inv_description;
		$invoice->inv_updated_by = Auth::id();
		$invoice->save();

		// Redirect
		return redirect()->route('invoices.index')
			->with('success', 'វិក្កយបត្របានកែប្រែដោយជោគជ័យ: ' . $r->inv_number);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\invoice  $invoice
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		// delete Main service
    $invoice = invoice::find($id);
    $inv_number = $invoice->inv_number;
    $invoice->delete();
    // redirect
		return redirect()->route('invoices.index')
			->with('success', 'វិក្កយបត្របានលុបចោលដោយជោគជ័យ៖ '. $inv_number);
	}
}
