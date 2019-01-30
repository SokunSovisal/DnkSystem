<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Receipts;
use App\Models\invoice;
use Illuminate\Http\Request;
use DB;

class IncomeReportController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{   
		$this->globalNotitfy = new Users();
		$this->module = '10';
		$this->data=[
			'm'=>'manage_reports',
			'sm'=>$this->module,
			'title'=>'របាយការណ៍ចំណូល',
	  // Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

	public function index()
	{
		$i = 0;
		$tbody = '';
		$tfoot = '';
		$inv_month = '';
		$inv_ytotal = 0;
		$inv_mtotal = 0;
		$rec_month = '';
		$rec_received = 0;
		$rec_received_total = 0;
		$balance_tt = 0;
		$balance_total = 0;
		$cur_year = date('Y', time());
		$invoices = invoice::whereYear('inv_date', $cur_year)->orderBy('inv_date', 'asc')->get();
		foreach ($invoices as $key => $invoice) {
			if (date('m', strtotime($invoice->inv_date)) != $inv_month) {
				$inv_mtotal = 0;
				$rec_received = 0;
				$inv_month = date('m', strtotime($invoice->inv_date));
				$invoices_in_month = invoice::whereMonth('inv_date', $inv_month)->orderBy('inv_date', 'asc')->get();
				foreach ($invoices_in_month as $j => $inv_in_month) {
					$inv_total = $inv_in_month->inv_total;
					if ($inv_in_month->inv_vat_status == 2) {
						$inv_total = $inv_total*1.1;
					}
					$inv_mtotal += $inv_total;
					$inv_ytotal += $inv_total;

					// Receipts Calculation
					foreach ($inv_in_month->receipt as $rec) {
						$rec_received += $rec->rec_received_amount;
						$rec_received_total += $rec->rec_received_amount;
					}
				}
				$balance_tt = $inv_mtotal - $rec_received;
				$balance_total = $inv_ytotal - $rec_received_total;
				$i++;
				$tbody .= '<tr>
										<td>'.$i.'</td>
										<td>'.date('Y', strtotime($invoice->inv_date)).'</td>
										<td>'.date('F', strtotime($invoice->inv_date)).'</td>
										<td class="text-right" style="border-left: 1px dotted #999; border-right: 1px dotted #999;" data-value="'.$inv_mtotal.'"><span class="pull-left">$</span> '.number_format($inv_mtotal, 2).'</td>
										<td class="text-right" style="border-right: 1px dotted #999;" data-value="'.$rec_received.'"><span class="pull-left">$</span> '.number_format($rec_received, 2).'</td>
										<td class="text-right '.(($balance_tt>0)? 'text-danger':'' ).'" style="border-right: 1px dotted #999;" data-value="'.$balance_tt.'"><span class="pull-left">$</span> '.number_format($balance_tt, 2).'</td>
										<td class="text-right"><button type="button" onclick="getMonth(\''.date('Y-m', strtotime($invoice->inv_date)).'\')" data-month="" data-toggle="modal" data-target=".bs-example-modal-lg" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
									</tr>';
			}
		}
		$tfoot .= '<tr>
								<td></td>
								<td></td>
								<td class="text-right KHMERBTB"><strong>សរុប​ </strong></td>
								<td data-value="'.$inv_ytotal.'" id="inv_ytotal" class="text-right bg-info"><strong><span class="pull-left">$</span> <span class="value">'.number_format($inv_ytotal, 2).'</span></strong></td>
								<td data-value="'.$rec_received_total.'" id="rec_received_total" class="text-right bg-info"><strong><span class="pull-left">$</span> <span class="value">'.number_format($rec_received_total, 2).'</span></strong></td>
								<td data-value="'.$balance_total.'" id="balance_total" class="text-right bg-info '.(($balance_total>0)? 'text-danger':'' ).'"><strong><span class="pull-left">$</span> <span class="value">'.number_format($balance_total, 2).'</span></strong></td>
								<td></td>
							</tr>';

		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-file-import"></i> របាយការណ៍ចំណូល</li>',

			// // Select Data From Table
			'tfoot' => $tfoot,
			'tbody' => $tbody,
		];
		// return view('incomereport.index', $this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('incomereport.index',$this->data) : view('errors.permission',$this->data) );
	}

	public function search(Request $r)
	{
		$no = 1;
		$tbody = '';
		$tfoot = '';
		$inv_month = '';
		$inv_ytotal = 0;
		$inv_mtotal = 0;
		$rec_month = '';
		$rec_received = 0;
		$rec_received_total = 0;
		$balance_tt = 0;
		$balance_total = 0;
		// Get Search
		$month_length = 12;
		$monthpickerstart = strtotime($r->monthpickerstart);
		$monthpickerend = strtotime($r->monthpickerend);
		$year1 = date('Y', $monthpickerstart);
		$year2 = date('Y', $monthpickerend);
		$month1 = date('m', $monthpickerstart);
		$month2 = date('m', $monthpickerend);
		// count month and year
		$count_year = ($year2 - $year1) + 1;
		$count_month = (($year2 - $year1) * 12) + ($month2 - $month1) +1;
		for ($i=1; $i <= $count_year; $i++) {
			// echo $i."::::: ".$year1."<br/>";
			if( $i == $count_year ){
				$month_length = $month2;
			}

			for ($j=$month1; $j <= $month_length; $j++) {
				// echo $month2."::::: ".$month1."<br/>";
				// Income
				$inv_mtotal = 0;
				$balance_tt = 0;
				$month_check = '';
				$rec_received = 0;
				$invoices_in_month = invoice::whereYear('inv_date', $year1)
																			->whereMonth('inv_date', str_pad($month1, 2, '0', STR_PAD_LEFT))
																			->orderBy('inv_date', 'asc')->get();
				foreach ($invoices_in_month as $key => $inv_in_month) {
					$inv_total = $inv_in_month->inv_total;
					if ($inv_in_month->inv_vat_status == 2) {
						$inv_total = $inv_in_month->inv_total*1.1;
					}
					$inv_mtotal += $inv_total;
					$inv_ytotal += $inv_total;
					// Receipts Calculation
					$receipts = Receipts::where('rec_inv_id', $inv_in_month->id)->orderBy('rec_date', 'asc')->get();
					foreach ($receipts as $rec => $receipt) {
						$rec_received += $receipt->rec_received_amount;
						$rec_received_total += $receipt->rec_received_amount;
					}
				}

				$balance_tt = $inv_mtotal - $rec_received;
				$balance_total = $inv_ytotal - $rec_received_total;

				$tbody .= '<tr>
										<td>'.$no.'</td>
										<td>'.date('F', mktime(0, 0, 0, str_pad($month1, 2, '0', STR_PAD_LEFT), 1, 2011)).'</td>
										<td class="text-right" style="border-left: 1px dotted #999; border-right: 1px dotted #999;" data-value="'.$inv_mtotal.'"><span class="pull-left">$</span> '.number_format($inv_mtotal, 2).'</td>
										<td class="text-right" style="border-right: 1px dotted #999;" data-value="'.$rec_received.'"><span class="pull-left">$</span> '.number_format($rec_received, 2).'</td>
										<td class="text-right '.(($balance_tt>0)? 'text-danger':'' ).'" style="border-right: 1px dotted #999;" data-value="'.$balance_tt.'"><span class="pull-left">$</span> '.number_format($balance_tt, 2).'</td>
										<td class="text-right"><button type="button" onclick="getMonth(\''.$year1.'-'.str_pad($month1, 2, '0', STR_PAD_LEFT).'\')" data-month="" data-toggle="modal" data-target=".bs-example-modal-lg" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
									</tr>';
				$no++;

				$month1 ++;
			}
			$month1 = '01';
			$year1 ++;
		}
		$tfoot .= '<tr>
								<td></td>
								<td class="text-right KHMERBTB"><strong>សរុប​ </strong></td>
								<td data-value="'.$inv_ytotal.'" class="text-right bg-info" id="inv_ytotal"><strong><span class="pull-left">$</span> <span class="value">'.number_format($inv_ytotal, 2).'</span></strong></td>
								<td data-value="'.$rec_received_total.'" class="text-right bg-info" id="rec_received_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($rec_received_total, 2).'</span></strong></td>
								<td data-value="'.$balance_total.'" class="text-right bg-info '.(($balance_total>0)? 'text-danger':'' ).'" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($balance_total, 2).'</span></strong></td>
								<td></td>
							</tr>';

			echo '<table class="table table-striped table-hover" id="dataTable_income">
							<thead>
								<tr>
									<th width="5%">N&deg;</th>
									<th width="15%">ការបរិច្ឆេទ</th>
									<th>ប្រាក់សរុប</th>
									<th>ប្រាក់ទទួលបាន</th>
									<th>ប្រាក់នៅសល់</th>
									<th width="9%" class="text-right disabled-sorting">សកម្មភាព &nbsp;&nbsp;</th>
								</tr>
							</thead>
							<tbody id="tbody">
								'.$tbody.'
							</tbody>
							<tfoot id="tfoot">
								'.$tfoot.'
							</tfoot>
						</table>';
	}


	public function invoices(Request $r)
	{
		$output='';
		$inv_total=0;
		$month= date('m', strtotime($r->monthyear));
		$year= date('Y', strtotime($r->monthyear));
		// Receipts Calculation
		$invoices = invoice::whereYear('inv_date', $year)
              ->whereMonth('inv_date', $month)
              ->orderBy('inv_number', 'asc')->get();
		foreach ($invoices as $i => $invoice) {
			$rec_received_total = 0;
			$balance = 0;
			$receipts = receipts::where('rec_inv_id', $invoice->id)->orderBy('id','DESC')->get();
			foreach ($receipts as $j => $receipt) {
				$rec_received_total += $receipt->rec_received_amount;
			}
			$inv_total = $invoice->inv_total;
			if ($invoice->inv_vat_status==2) {
				$inv_total = $invoice->inv_total * 1.1;
			}
			$balance = $inv_total - $rec_received_total;
			$output .= '<tr>
									<td>'. ++$i .'</td>
									<td>'. $invoice->inv_date .'</td>
									<td>'. $invoice->inv_number .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($inv_total, 2) .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($rec_received_total, 2) .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($balance, 2) .'</td>
									<td class="text-right"><button type="button" onclick="getInvoice(\''. $invoice->inv_number .'\', '. $invoice->id .')" data-month="" data-toggle="modal" data-target=".modal-view-receipt" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
								</tr>';
		}

		echo	'<table class="table table-striped table-hover" id="dataTable_invoice">
						<thead>
							<tr>
								<th width="5%">N&deg;</th>
								<th width="15%">ការបរិច្ឆេទ</th>
								<th>លេខវិក្កយបត្រ</th>
								<th>ប្រាក់សរុប</th>
								<th>ប្រាក់បានទទួល</th>
								<th>ប្រាក់បាននៅសល់</th>
								<th width="8%" class="text-right disabled-sorting">សកម្មភាព &nbsp;&nbsp;</th>
							</tr>
						</thead>
						<tbody id="receipt_table">'
								.$output.
						'</tbody>
					</table>';
	}

	public function receipts(Request $r)
	{
		$tbody='';
		$inv_total=0;
		$rec_received=0;
		$balance=0;
		$inv_id=$r->inv_id;
		// Receipts Calculation
		$invoice = invoice::find($inv_id);
		$inv_total = $invoice->inv_total;
		if ($invoice->inv_vat_status==2) {
			$inv_total = $invoice->inv_total * 1.1;
		}
		// echo $invoice->inv_total;
		$receipts = receipts::where('rec_inv_id', $invoice->id)->orderBy('rec_date','ASC')->get();
		foreach ($receipts as $j => $receipt) {
			$rec_received = $receipt->rec_received_amount;
			$balance = $inv_total - $rec_received;
			$tbody .= '<tr>
									<td>'. ++$j .'</td>
									<td>'. $invoice->inv_number .'</td>
									<td>'. $receipt->rec_date .'</td>
									<td>'. $receipt->rec_number .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($inv_total, 2) .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($rec_received, 2) .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($balance, 2) .'</td>
								</tr>';
			$inv_total -= $receipt->rec_received_amount;
		}

		echo	'<table class="table table-striped table-hover" id="dataTable_receipt">
						<thead>
							<tr>
								<th width="5%">N&deg;</th>
								<th>លេខរៀងវិក្កយបត្រ</th>
								<th width="15%">ការបរិច្ឆេទ</th>
								<th>លេខរៀងប័ណ្ណបង់ប្រាក់</th>
								<th>ប្រាក់សរុប</th>
								<th>ប្រាក់បានទទួល</th>
								<th>ប្រាក់បាននៅសល់</th>
							</tr>
						</thead>
						<tbody id="receipt_table">'
								.$tbody.
						'</tbody>
					</table>';
	}

}
