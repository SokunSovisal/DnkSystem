<?php

namespace App\Http\Controllers;

use App\Models\payment_transitions;
use App\Models\Companies;
use App\Models\Users;
use App\Models\bills;
use Illuminate\Http\Request;
use Validator;
use Auth;

class AccountpayablesController extends Controller
{
	
	 
	private $globalNotitfy;
	private $module;

	public function __construct()
	{  	
		$this->globalNotitfy = new Users();
		$this->module = '7';
		$this->data=[
			'm'=>'manage_expense',
			'sm'=>$this->module,
			'title'=>'ការទូរទាត់',
	  	// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}
	

	public function index()
	{
		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-file-invoice-dollar"></i> ការទូរទាត់</li>',

			// Select Data From Table
			'accountpayables' => payment_transitions::orderBy('pt_number', 'asc')->get(),
		];
		// return view('accountpayables.index', $this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('accountpayables.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('accountpayables.index') .'"><i class="fa fa-file-invoice-dollar"></i> ការទូរទាត់</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'bills' => bills::where('br_paid_status',0)->orderBy('created_at', 'desc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
		];
		// return view('accountpayables.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('accountpayables.create',$this->data) : view('errors.permission',$this->data) );
	}


	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'pt_date' => 'required|date',
			'pt_bill_id' => 'required',
			'pt_amount' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$pt = new payment_transitions;
			$pt->pt_number = $r->pt_number;
			$pt->pt_date = $r->pt_date;
			$pt->pt_bill_id = $r->pt_bill_id;
			$pt->pt_amount = $r->pt_amount;
			$pt->pt_description = $r->pt_description;
			$pt->pt_created_by = Auth::id();
			$pt->pt_updated_by = Auth::id();
			$pt->save();
			if ($r->pt_balance == 0) {
				// Insert to Table
				$bill = bills::find($r->pt_bill_id);
				$bill->br_paid_status = 1;
				$bill->save();
			}
			// Redirect
			return redirect()->route('accountpayables.index')
				->with('success', 'ការទូរទាត់បានបញ្ចូលដោយជោគជ័យ: ' . $r->pt_number);
		}else{
			return redirect(route('errors.permission'));
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\payment_transitions  $payment_transitions
	 * @return \Illuminate\Http\Response
	 */
	public function show(payment_transitions $payment_transitions)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\payment_transitions  $payment_transitions
	 * @return \Illuminate\Http\Response
	 */
	public function edit(payment_transitions $payment_transitions, $id)
	{
		$this->data+=[
			'accountpayable' => payment_transitions::find($id),
			'bills' => bills::orderBy('created_at', 'desc')->get(),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('accountpayables.index') .'"><i class="fa fa-file-invoice-dollar"></i> ការទូរទាត់</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. payment_transitions::find($id)->pt_number.'</li>',
		];
		// return view('accountpayables.edit',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('accountpayables.edit',$this->data) : view('errors.permission',$this->data) );
	}

	public function update(Request $r, payment_transitions $payment_transitions, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'pt_date' => 'required|date',
			'pt_amount' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$pt = payment_transitions::find($id);
			$pt->pt_number = $r->pt_number;
			$pt->pt_date = $r->pt_date;
			$pt->pt_amount = $r->pt_amount;
			$pt->pt_description = $r->pt_description;
			$pt->pt_updated_by = Auth::id();
			$pt->save();

			if ($r->pt_balance == 0) {
				// Insert to Table
				$bill = bills::find($r->bill_id);
				$bill->br_paid_status = 1;
				$bill->save();
			}else{
				// Insert to Table
				$bill = bills::find($r->bill_id);
				$bill->br_paid_status = 0;
				$bill->save();
			}

			// Redirect
			return redirect()->route('accountpayables.index')
				->with('success', 'ការទូរទាត់បានបញ្ចូលដោយជោគជ័យ: ' . $r->pt_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\payment_transitions  $payment_transitions
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(payment_transitions $payment_transitions, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$bill = bills::find(payment_transitions::find($id)->pt_bill_id);
			$bill->br_paid_status = 0;
			$bill->save();
			// delete Main service
	    $pt = payment_transitions::find($id);
	    $pt_number = $pt->pt_number;
	    $pt->delete();
	    // redirect
			return redirect()->route('accountpayables.index')
				->with('success', 'វិក្កយបត្របានលុបចោលដោយជោគជ័យ៖ '. $pt_number);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
