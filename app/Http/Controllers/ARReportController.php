<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Receipts;
use App\Models\invoice;
use Illuminate\Http\Request;
use DB;

class ARReportController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{   
		$this->globalNotitfy = new Users();
		$this->module = '8';
		$this->data=[
			'm'=>'manage_reports',
			'sm'=>$this->module,
			'title'=>'របាយការណ៍ប្រាក់មិនទាន់ទទួល',
	  	// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

  public function index()
  {
  	$tbody ='';
  	$tfoot ='';

		$inv_total_footer = 0;
		$rec_received = 0;
		$rec_received_total = 0;
		$balance = 0;
		$balance_total = 0;
		$invoices = invoice::where('inv_paid_status', 0)
												->orderBy('inv_number', 'asc')->get();
		foreach ($invoices as $j => $inv) {

			$inv_total = 0;
			$inv_total = $inv->inv_total;
			if ($inv->inv_vat_status == 2) {
				$inv_total = $inv_total*1.1;
			}
			$inv_total_footer += $inv_total;
			// Receipts Calculation
			$rec_received = 0;
			foreach ($inv->receipt as $rec) {
				$rec_received += $rec->rec_received_amount;
				$rec_received_total += $rec->rec_received_amount;
			}
			$balance = $inv_total-$rec_received;
			$balance_total += $inv_total-$rec_received;
			$tbody .= '<tr>
										<td>'. ++$j.'</td>
										<td>'.date('Y-F', strtotime($inv->inv_date)).'</td>
										<td>'.$inv->inv_number.'</td>
										<td class="text-right" style="border-right:1px dotted #999; border-left:1px dotted #999;"><span class="pull-left">$</span> '.number_format($inv_total, 2).'</td>
										<td class="text-right" style="border-right:1px dotted #999;"><span class="pull-left">$</span> '.number_format($rec_received, 2).'</td>
										<td class="text-right" style="border-right:1px dotted #999;"><span class="pull-left">$</span> '.number_format($balance, 2).'</td>
										<td class="text-right"><button type="button" onclick="getInvoice(\''. $inv->inv_number .'\', '. $inv->id .')" data-month="" data-toggle="modal" data-target=".modal-view-receipt" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
									</tr>';
		}

		$tfoot = '<tr>
								<td></td>
								<td></td>
								<td></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($inv_total_footer, 2).'</span></strong></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($rec_received_total, 2).'</span></strong></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($balance_total, 2).'</span></strong></td>
							</tr>';
		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-donate"></i> របាយការណ៍ប្រាក់មិនទាន់ទទួល</li>',

			// Select Data From Table
			'tbody' => $tbody,
			'tfoot' => $tfoot,
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('ARReport.index',$this->data) : view('errors.permission',$this->data) );
  }

  public function search(Request $r)
  {
  	$tbody ='';
  	$tfoot ='';

		$no = 0;
		$inv_total_footer = 0;
		$rec_received = 0;
		$rec_received_total = 0;
		$balance = 0;
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
			// echo $year1."::".$year2."<br/>";
			if( $i == $count_year ){
				$month_length = $month2;
			}

			for ($j=$month1; $j <= $month_length; $j++) {
				// echo str_pad($j, 2, '0', STR_PAD_LEFT)."::".$year2."<br/>";
				// Income
				$inv_mtotal = 0;
				$rec_balance_tt = 0;
				$invoices = invoice::whereYear('inv_date', $year1)
														->whereMonth('inv_date', str_pad($j, 2, '0', STR_PAD_LEFT))
														->where('inv_paid_status', 0)
														->orderBy('inv_number', 'asc')->get();
				foreach ($invoices as $k => $inv) {
					$inv_total = 0;
					$inv_total = $inv->inv_total;
					if ($inv->inv_vat_status == 2) {
						$inv_total = $inv_total*1.1;
					}
					$inv_total_footer += $inv_total;
					// Receipts Calculation
					$rec_received = 0;
					foreach ($inv->receipt as $rec) {
						$rec_received += $rec->rec_received_amount;
						$rec_received_total += $rec->rec_received_amount;
					}
					$balance = $inv_total-$rec_received;
					$balance_total += $inv_total-$rec_received;
					$tbody .= '<tr>
												<td>'. ++$no.'</td>
												<td>'.date('Y-F', strtotime($inv->inv_date)).'</td>
												<td>'.$inv->inv_number.'</td>
												<td class="text-right" style="border-right:1px dotted #999; border-left:1px dotted #999;"><span class="pull-left">$</span> '.number_format($inv_total, 2).'</td>
												<td class="text-right" style="border-right:1px dotted #999;"><span class="pull-left">$</span> '.number_format($rec_received, 2).'</td>
												<td class="text-right" style="border-right:1px dotted #999;"><span class="pull-left">$</span> '.number_format($balance, 2).'</td>
												<td class="text-right"><button type="button" onclick="getInvoice(\''. $inv->inv_number .'\', '. $inv->id .')" data-month="" data-toggle="modal" data-target=".modal-view-receipt" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
											</tr>';
				}
				$month1 ++;
			}
			$month1 = '01';
			$year1 ++;
		}
		$tfoot = '<tr>
								<td></td>
								<td></td>
								<td></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($inv_total_footer, 2).'</span></strong></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($rec_received_total, 2).'</span></strong></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($balance_total, 2).'</span></strong></td>
							</tr>';
		echo '<table class="table table-striped table-hover" id="dataTable_income">
						<thead>
							<tr>
								<th width="5%">N&deg;</th>
								<th width="13%">ការបរិច្ឆេទ</th>
								<th width="10%">លេខវិក្កយបត្រ</th>
								<th width="20%">ប្រាក់សរុប</th>
								<th width="20%">ប្រាក់ទទួលបាន</th>
								<th width="20%">ប្រាក់នៅសល់</th>
								<th width="12%" class="text-right disabled-sorting">សកម្មភាព &nbsp;&nbsp;</th>
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
		$receipts = receipts::where('rec_inv_id', $invoice->id)->orderBy('rec_number','DESC')->get();
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
