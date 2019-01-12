<?php

namespace App\Http\Controllers;

use App\Models\invoice_detail;
use App\Models\invoice;
use Illuminate\Http\Request;
use DB;

class invoiceDetailController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
		$inv_id = $r->invd_invoice_id;
		// Insert to Table
		$detail = new invoice_detail;
		$detail->invd_price = $r->invd_price;
		$detail->invd_qty = $r->invd_qty;
		$detail->invd_description = $r->invd_description;
		$detail->invd_service_id = $r->invd_service_id;
		$detail->invd_invoice_id = $r->invd_invoice_id;
		$detail->save();
		
		// update to Table Invoices
		$invoicetotal = invoice_detail::where('invd_invoice_id', $inv_id)->get();
		$total = 0;
		foreach ($invoicetotal as $i => $invd) {
			$total += $invd->invd_price * $invd->invd_qty;
		}
		$invoice = invoice::find($inv_id);
		$invoice->inv_total = $total;
		$invoice->save();
		echo "សេវាកម្មបានបញ្ចូលក្នុងវិក្កយបត្រដោយជោគជ័យ";
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\invoice_detail  $invoice_detail
	 * @return \Illuminate\Http\Response
	 */
	public function show(invoice_detail $invoice_detail)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\invoice_detail  $invoice_detail
	 * @return \Illuminate\Http\Response
	 */
	public function edit(invoice_detail $invoice_detail, $id)
	{
		$invd = invoice_detail::find($id);
		$output = $invd->invd_service_id.';:;'.$invd->invd_description.';:;'.$invd->id.';:;'.$invd->invd_price.';:;'.$invd->invd_qty;
		echo $output;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\invoice_detail  $invoice_detail
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, invoice_detail $invoice_detail, $id)
	{
		// Insert to Table
		$invoicedetail = invoice_detail::find($id);
		$inv_id = $invoicedetail->invd_invoice_id;
		$old_price = $invoicedetail->invd_price * $invoicedetail->invd_qty;
		$invoicedetail->invd_price = $r->invd_price;
		$invoicedetail->invd_qty = $r->invd_qty;
		$invoicedetail->invd_description = $r->invd_description;
		$invoicedetail->invd_service_id = $r->invd_service_id;
		$invoicedetail->save();

		// update to Table Invoices
		$invoicetotal = invoice_detail::where('invd_invoice_id', $inv_id)->get();
		$total = 0;
		foreach ($invoicetotal as $i => $invd) {
			$total += $invd->invd_price * $invd->invd_qty;
		}
		$invoice = invoice::find($inv_id);
		$invoice->inv_total = $total;
		$invoice->save();
		echo "សេវាកម្មបានបញ្ចូលក្នុងវិក្កយបត្រដោយជោគជ័យ";
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\invoice_detail  $invoice_detail
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(invoice_detail $invoice_detail, $id)
	{
		// delete
		$invd = invoice_detail::find($id);
		$inv_id = $invd->invd_invoice_id;
		$invd_price = $invd->invd_price;
		$invd_qty = $invd->invd_qty;
		$invd_service_name = $invd->service->s_name;
		$invd->delete();
		
		// update to Table Invoices
		$invoicetotal = invoice_detail::where('invd_invoice_id', $inv_id)->get();
		$total = 0;
		foreach ($invoicetotal as $i => $invd) {
			$total += $invd->invd_price * $invd->invd_qty;
		}
		$invoice = invoice::find($inv_id);
		$invoice->inv_total = $total;
		$invoice->save();
		// redirect
		return redirect()->route('invoices.detail',$inv_id)
			->with('success', 'សេវាកម្មបានលុបចោលពីក្នុងវិក្កយបត្រដោយជោគជ័យ៖ '. $invd_service_name);
	}
}
