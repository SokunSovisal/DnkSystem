<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Companies;
use App\Models\Services;
use App\Models\Provinces;
use App\Models\Districts;
use App\Models\quotations;
use App\Models\Appointments;
use App\Models\quotation_services;
use App\Models\invoice;
use App\Models\Receipts;
use App\Models\bills;
use App\Models\payment_transitions;
use DB;

class ajaxController extends Controller
{

	public function index()
	{
		# code...
	}

	
	public function lselect(Request $r)
	{
		 $field = $r->get('field');
		 $value = $r->get('value');
		 $chtable = $r->get('chtable');
		 $name = $r->get('name');
		 $text = $r->get('text');
		 $data_fetch = DB::table($chtable)
			 ->where($field, $value)
			 ->get();
		 $output = '<option value="">-- ជ្រើសរើស'. $text.' --</option>';
		 foreach($data_fetch as $row)
		 {
			$output .= '<option value="'.$row->id.'">'.$row->$name.'</option>';
		 }
		 echo $output;
	}

	public function servicePrice(Request $r)
	{
		$id = $r->get('id');
		$service = Services::find($id);
		$output = $service->s_price;
		echo $output;
	}

	public function quoteCompany(Request $r)
	{
		$id = $r->get('id');
		$com = Companies::find($id);
		$output = $com->com_cp_name.':'.$com->com_cp_phone.':'.$com->com_cp_email;
		echo $output;
	}

	public function invoiceCompany(Request $r)
	{
		$id = $r->get('id');
		$com = Companies::find($id);
		$province = Provinces::find($com->com_province_id);
		$district = Districts::find($com->com_district_id);
		$address = ($com->com_addr_house!=""?"ផ្ទះ".$com->com_addr_house.", " :"") . ($com->com_addr_street!=""?"ផ្លូវ".$com->com_addr_street.", " :"") . ($com->com_addr_group!=""?"ក្រុម".$com->com_addr_group.", " :'') . ($com->com_addr_village!=""?"ភូមិ".$com->com_addr_village .", " :"");
		if ($province->pro_name=="ភ្នំពេញ") {
			$address .= ($com->com_addr_commune!=""?"ឃុំ".$com->com_addr_commune.", " :"")."ខណ្ឌ".$district->dist_name.", "."ខេត្ត".$province->pro_name;
		}else{
			$address .= ($com->com_addr_commune!=""?"ឃុំ".$com->com_addr_commune.", " :"")."ស្រុក". $district->dist_name .", ". "ខេត្ត".$province->pro_name;
		}
		$output = $com->com_phone.':'.$address;
		echo $output;
	}

	public function appointmentServices(Request $r)
	{
		$app_id = $r->get('app_id');
		$app = Appointments::find($app_id);
		$services = Services::orderBy('s_name', 'asc')->get();
		$output ='<option value="">-- ជ្រើសរើសសេវាកម្ម --</option>';
		foreach (unserialize($app->app_services_id) as $serv) {
			foreach ($services as $i => $s) {
				if ($s->id==$serv) {
					$output .='<option value="'.$s->id.'">'.$s->s_name.'</option>';
				}
			}
		}
		echo $output;
	}

	public function quotationservices(Request $r)
	{
		$quote_id = $r->get('id');
		$quotation_services = quotation_services::where('qs_quote_id', $quote_id)->get();
		$output ='<option value="">-- ជ្រើសរើសសេវាកម្ម --</option>';
		foreach ($quotation_services as $i => $qs) {
			$output .='<option value="'.$qs->qs_service_id.'">'.$qs->service->s_name.'</option>';
		}
		echo $output;
	}

	public function receiptinvoice(Request $r)
	{
		$id = $r->get('id');
		$inv = invoice::find($id);
		if ($inv->inv_vat_status == 2) {
			$rec_full_amount = $inv->inv_total*1.1;
		}else{
			$rec_full_amount = $inv->inv_total;
		}
		$rec_received_total = 0;
		$receipts = receipts::where('rec_inv_id', $id)->get();
		foreach ($receipts as $id => $receipt) {
			$rec_received_total += $receipt->rec_received_amount;
		}
		
		$output = $inv->inv_company_id.':'.$rec_full_amount.':'.$rec_received_total;
		echo $output;
	}

	public function accountpayable(Request $r)
	{
		$id = $r->get('id');
		$bill = bills::find($id);
		$bill_total = $bill->br_total;
		$bill_company_id = $bill->br_company_id;
		$pt_amount_total = 0;
		$payment_transitions = payment_transitions::where('pt_bill_id', $id)->orderBy('id','DESC')->get();
		foreach ($payment_transitions as $id => $ap) {
			$pt_amount_total += $ap->pt_amount;
		}
		$output = $bill_company_id.':'.$bill_total.':'.$pt_amount_total;
		echo $output;
	}
}
