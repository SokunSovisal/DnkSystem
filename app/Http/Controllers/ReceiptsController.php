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

	private $globalNotitfy;
	private $module;

	public function __construct()
	{  	
		$this->globalNotitfy = new Users();
		$this->module = '5';
		$this->data=[
			'm'=>'manage_income',
			'sm'=>$this->module,
			'title'=>'ប័ណ្ណបង់ប្រាក់',
	  	// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}
	
	public function index()
	{
		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-receipt"></i> ប័ណ្ណបង់ប្រាក់</li>',

			// Select Data From Table
			'receipts' => Receipts::orderBy('rec_number', 'asc')->get(),
		];
		// return view('receipts.index', $this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('receipts.index',$this->data) : view('errors.permission',$this->data) );
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
			'receipt' => receipts::orderBy('rec_number', 'desc')->first(),
			'invoices' => invoice::where('inv_paid_status',0)->orderBy('created_at', 'desc')->get(),
			'companies' => Companies::where('com_type', 1)->orWhere('com_type', 3)->orderBy('com_name', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
		];
		// return view('receipts.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('receipts.create',$this->data) : view('errors.permission',$this->data) );
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
			'rec_inv_id' => 'required',
			'rec_received_amount' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$receipt = new Receipts;
			$receipt->rec_number = $r->rec_number;
			$receipt->rec_date = $r->rec_date;
			$receipt->rec_inv_id = $r->rec_inv_id;
			$receipt->rec_received_amount = $r->rec_received_amount;
			$receipt->rec_description = $r->rec_description;
			$receipt->rec_created_by = Auth::id();
			$receipt->rec_updated_by = Auth::id();
			$receipt->save();
			if ($r->rec_balance == 0) {
				// Insert to Table
				$invoice = invoice::find($r->rec_inv_id);
				$invoice->inv_paid_status = 1;
				$invoice->save();
			}
			// Redirect
			return redirect()->route('receipts.index')
				->with('success', 'ប័ណ្ណទទួលប្រាក់បានបញ្ចូលដោយជោគជ័យ: ' . $r->rec_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Receipts  $receipts
	 * @return \Illuminate\Http\Response
	 */
	public function show(Receipts $receipts, $id)
	{

		$invoice = invoice::find(Receipts::find($id)->rec_inv_id);
		$compan_name = $invoice->company->com_name_en;
    $this->data+=[
			// Select Data From Table
			'receipt' => Receipts::find($id),
			'compan_name' => $compan_name,
			// Select Data From Table
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('receipts.index') .'"><i class="fa fa-receipt"></i> ប័ណ្ណបង់ប្រាក់</li></a></li><li class="active"><i class="fa fa-eye"></i> បង្ហាញ៖ '.Receipts::find($id)->rec_number.'</li>',
    ];
    // return view('receipts.show',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('receipts.show',$this->data) : view('errors.permission',$this->data) );
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
			'companies' => Companies::where('com_type', 1)->orWhere('com_type', 3)->orderBy('com_name', 'asc')->get(),
			'invoice' => invoice::orderBy('created_at', 'desc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('receipts.index') .'"><i class="fa fa-receipt"></i> ប័ណ្ណបង់ប្រាក់</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Receipts::find($id)->rec_number.'</li>',
		];
		// return view('receipts.edit', $this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('receipts.edit',$this->data) : view('errors.permission',$this->data) );
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
			'rec_received_amount' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$receipt = Receipts::find($id);
			$receipt->rec_number = $r->rec_number;
			$receipt->rec_date = $r->rec_date;
			$receipt->rec_received_amount = $r->rec_received_amount;
			$receipt->rec_description = $r->rec_description;
			$receipt->rec_updated_by = Auth::id();
			$receipt->save();

			if ($r->rec_balance == 0) {
				// Insert to Table
				$invoice = invoice::find($r->inv_id);
				$invoice->inv_paid_status = 1;
				$invoice->save();
			}else{
				// Insert to Table
				$invoice = invoice::find($r->inv_id);
				$invoice->inv_paid_status = 0;
				$invoice->save();
			}

			// Redirect
			return redirect()->route('receipts.index')
				->with('success', 'ប័ណ្ណទទួលប្រាក់បានកែប្រែដោយជោគជ័យ: ' . $r->rec_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Receipts  $receipts
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Receipts $receipts, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$invoice = invoice::find(Receipts::find($id)->rec_inv_id);
			$invoice->inv_paid_status = 0;
			$invoice->save();
			// delete Main service
	    $receipt = Receipts::find($id);
	    $rec_number = $receipt->rec_number;
	    $receipt->delete();
	    // redirect
			return redirect()->route('receipts.index')
				->with('success', 'ប័ណ្ណទទួលប្រាក់បានលុបចោលដោយជោគជ័យ៖ '. $rec_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
