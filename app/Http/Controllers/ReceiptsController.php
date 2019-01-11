<?php

namespace App\Http\Controllers;

use App\Models\Receipts;
use App\Models\Users;
use App\Models\invoice;
use App\Models\companies;
use Illuminate\Http\Request;
use Auth;
use Validator;

class ReceiptsController extends Controller
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
			'sm'=>'receipts',
			'title'=>'ប័ណ្ណបង់ប្រាក់',
	  	// Notification Appointments
			'appNotify' => new Users(),
		];
	}
	
	public function index()
	{
		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-receipt"></i> ប័ណ្ណបង់ប្រាក់</li>',

			// Select Data From Table
			'receipts' => Receipts::orderBy('rec_number', 'asc')->get(),
		];
		return view('receipts.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('receipts.index') .'"><i class="fa fa-receipt"></i> ប័ណ្ណបង់ប្រាក់</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'receipt' => Receipts::orderBy('created_at', 'desc')->first(),
			'invoices' => invoice::orderBy('created_at', 'desc')->get(),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
		];
		return view('receipts.create',$this->data);
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
			'rec_number' => 'required|unique:receipts|numeric',
			'rec_date' => 'required|date',
			'rec_company_id' => 'required',
			'rec_inv_id' => 'required',
			'rec_full_ammount' => 'required',
			'rec_received_ammount' => 'required',
			'rec_balance' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Insert to Table
		$receipt = new Receipts;
		$receipt->rec_number = $r->rec_number;
		$receipt->rec_date = $r->rec_date;
		$receipt->rec_company_id = $r->rec_company_id;
		$receipt->rec_inv_id = $r->rec_inv_id;
		$receipt->rec_full_ammount = $r->rec_full_ammount;
		$receipt->rec_received_ammount = $r->rec_received_ammount;
		$receipt->rec_balance = $r->rec_balance;
		$receipt->rec_description = $r->rec_description;
		$receipt->rec_created_by = Auth::id();
		$receipt->rec_updated_by = Auth::id();
		$receipt->save();

		// Redirect
		return redirect()->route('receipts.index')
			->with('success', 'ប័ណ្ណទទួលប្រាក់បានបញ្ចូលដោយជោគជ័យ: ' . $r->rec_number);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Receipts  $receipts
	 * @return \Illuminate\Http\Response
	 */
	public function show(Receipts $receipts)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Receipts  $receipts
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Receipts $receipts, $id)
	{
		$this->data+=[
			'receipt' => Receipts::find($id),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'invoice' => invoice::orderBy('created_at', 'desc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('receipts.index') .'"><i class="fa fa-receipt"></i> ប័ណ្ណបង់ប្រាក់</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Receipts::find($id)->rec_number.'</li>',
		];
		return view('receipts.edit', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Receipts  $receipts
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, Receipts $receipts, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'rec_number' => 'required|numeric|unique:receipts,rec_number,'.$id,
			'rec_date' => 'required|date',
			'rec_company_id' => 'required',
			'rec_inv_id' => 'required',
			'rec_full_ammount' => 'required',
			'rec_received_ammount' => 'required',
			'rec_balance' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Insert to Table
		$receipt = Receipts::find($id);
		$receipt->rec_number = $r->rec_number;
		$receipt->rec_date = $r->rec_date;
		$receipt->rec_company_id = $r->rec_company_id;
		$receipt->rec_inv_id = $r->rec_inv_id;
		$receipt->rec_full_ammount = $r->rec_full_ammount;
		$receipt->rec_received_ammount = $r->rec_received_ammount;
		$receipt->rec_balance = $r->rec_balance;
		$receipt->rec_description = $r->rec_description;
		$receipt->rec_updated_by = Auth::id();
		$receipt->save();

		// Redirect
		return redirect()->route('receipts.index')
			->with('success', 'ប័ណ្ណទទួលប្រាក់បានកែប្រែដោយជោគជ័យ: ' . $r->rec_number);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Receipts  $receipts
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Receipts $receipts)
	{
		//
	}
}
