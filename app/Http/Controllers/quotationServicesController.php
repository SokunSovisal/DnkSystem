<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Services;
use App\Models\Quotations;
use App\Models\Appointments;
use App\Models\quotation_services;
use Illuminate\Http\Request;
use Auth;
use Validator;

class quotationServicesController extends Controller
{
	
	private $date;

	public function __construct()
	{	
		$this->data=[
			'title'=>'សេវាកម្មនៃសម្រង់តម្លៃ',
			'm'=>'manage_processing',
			'sm'=>'quotations',
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
		if (isset($_GET['qid']) && $_GET['qid']!='') {
			$quotations = Quotations::find($_GET['qid']);
			if ($quotations!=null) {
				$this->data += [
					// Select Data From Table
					'quotationservices' => quotation_services::orderBy('qs_quote_id', 'desc')->where('qs_quote_id', $_GET['qid'])->get(),
					'appointments' => Appointments::orderBy('app_datetime', 'desc')->where('app_status', 2)->where('app_company_id', $quotations->quote_company_id)->get(),
					'quotations' => Quotations::find($_GET['qid']),
					'services' => Services::orderBy('s_name', 'asc')->get(),

					'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('quotations.index') .'"><i class="fa fa-file-alt"></i> សម្រង់តម្លៃ៖ '.Quotations::find($_GET['qid'])->quote_number.'</li></a></li><li class="active"><i class="fa fa-heart"></i> សេវាកម្ម</li>',
				];
				return view('quotationservices.index',$this->data);
			}else{
				// Redirect
				return redirect()->route('quotations.index')
					->with('error', 'ពុំមានសម្រង់តម្លៃដែលអ្នកបានបញ្ចូលឡើយ');
			}
		}else{
			// Redirect
			return redirect()->route('quotations.index')
				->with('error', 'ពុំមានសម្រង់តម្លៃដែលអ្នកបានបញ្ចូលឡើយ');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r)
	{
		// Insert to Table
		$quotationservice = new quotation_services;
		$quotationservice->qs_price = $r->qs_price;
		$quotationservice->qs_qty = $r->qs_qty;
		$quotationservice->qs_description = $r->qs_description;
		$quotationservice->qs_service_id = $r->service_id;
		$quotationservice->qs_quote_id = $r->qs_quote_id;
		$quotationservice->qs_created_by = Auth::id();
		$quotationservice->qs_updated_by = Auth::id();
		$quotationservice->save();
		echo "សេវាកម្មបានបញ្ចូលក្នុងសម្រង់តម្លៃដោយជោគជ័យ";
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\quotation_services  $quotation_services
	 * @return \Illuminate\Http\Response
	 */
	public function show(quotation_services $quotation_services)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\quotation_services  $quotation_services
	 * @return \Illuminate\Http\Response
	 */
	public function edit(quotation_services $quotation_services, $id)
	{
		$qs = quotation_services::find($id);
		$output = $qs->qs_service_id.';:;'.$qs->qs_description.';:;'.$qs->id.';:;'.$qs->qs_price.';:;'.$qs->qs_qty;
		echo $output;

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\quotation_services  $quotation_services
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, quotation_services $quotation_services, $id)
	{
		// Insert to Table
		$quotationservice = quotation_services::find($id);
		$quotationservice->qs_price = $r->qs_price;
		$quotationservice->qs_qty = $r->qs_qty;
		$quotationservice->qs_description = $r->qs_description;
		$quotationservice->qs_service_id = $r->service_id;
		$quotationservice->qs_updated_by = Auth::id();
		$quotationservice->save();
		echo "សេវាកម្មបានបញ្ចូលក្នុងសម្រង់តម្លៃដោយជោគជ័យ";
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\quotation_services  $quotation_services
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(quotation_services $quotation_services, $id)
	{
		// delete
		$qs = quotation_services::find($id);
		$qid = $qs->qs_quote_id;
		$qs_service_name = Services::find($qs->qs_service_id)->s_name;
		$qs->delete();
		// redirect
		return redirect()->route('quotationservices.index','qid='.$qid)
			->with('success', 'សេវាកម្មបានលុបចោលពីក្នុងសម្រង់តម្លៃដោយជោគជ័យ៖ '. $qs_service_name);
	}
}
