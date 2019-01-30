<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\bills;
use App\Models\payment_transitions;
use Illuminate\Http\Request;
use DB;

class APReportController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{   
		$this->globalNotitfy = new Users();
		$this->module = '9';
		$this->data=[
			'm'=>'manage_reports',
			'sm'=>$this->module,
			'title'=>'របាយការណ៍ប្រាក់មិនទាន់បង់',
	  	// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

  public function index()
  {
  	$tbody ='';
  	$tfoot ='';

		$br_total_footer = 0;
		$pt_amount = 0;
		$pt_amount_total = 0;
		$balance = 0;
		$balance_total = 0;
		$bills = bills::where('br_paid_status', 0)
										->orderBy('br_number', 'asc')->get();
		foreach ($bills as $j => $bill) {

			$br_total = 0;
			$br_total = $bill->br_total;
			if ($bill->br_vat_status == 2) {
				$br_total = $br_total*1.1;
			}
			$br_total_footer += $br_total;
			// payments Calculation
			$pt_amount = 0;
			foreach ($bill->payment as $pt) {
				$pt_amount += $pt->pt_amount;
				$pt_amount_total += $pt->pt_amount;
			}
			$balance = $br_total-$pt_amount;
			$balance_total += $br_total-$pt_amount;
			$tbody .= '<tr>
										<td>'. ++$j.'</td>
										<td>'.date('Y-F', strtotime($bill->br_date)).'</td>
										<td>'.$bill->br_number.'</td>
										<td class="text-right" style="border-right:1px dotted #999; border-left:1px dotted #999;"><span class="pull-left">$</span> '.number_format($br_total, 2).'</td>
										<td class="text-right" style="border-right:1px dotted #999;"><span class="pull-left">$</span> '.number_format($pt_amount, 2).'</td>
										<td class="text-right" style="border-right:1px dotted #999;"><span class="pull-left">$</span> '.number_format($balance, 2).'</td>
										<td class="text-right"><button type="button" onclick="getBill(\''. $bill->br_number .'\', '. $bill->id .')" data-month="" data-toggle="modal" data-target=".modal-view-payment" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
									</tr>';
		}

		$tfoot = '<tr>
								<td></td>
								<td></td>
								<td></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($br_total_footer, 2).'</span></strong></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($pt_amount_total, 2).'</span></strong></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($balance_total, 2).'</span></strong></td>
							</tr>';

		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-hand-holding-usd"></i> របាយការណ៍ប្រាក់មិនទាន់បង់</li>',

			// Select Data From Table
			'tfoot' => $tfoot,
			'tbody' => $tbody,
		];
		// return view('APReport.index', $this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('APReport.index',$this->data) : view('errors.permission',$this->data) );
  }


  public function search(Request $r)
  {
  	$tbody ='';
  	$tfoot ='';

		$no = 0;
		$br_total_footer = 0;
		$pt_amount = 0;
		$pt_amount_total = 0;
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
				$br_mtotal = 0;
				$pt_balance_tt = 0;
				$bills = bills::whereYear('br_date', $year1)
														->whereMonth('br_date', str_pad($j, 2, '0', STR_PAD_LEFT))
														->where('br_paid_status', 0)
														->orderBy('br_number', 'asc')->get();
				foreach ($bills as $k => $bill) {
					$br_total = 0;
					$br_total = $bill->br_total;
					if ($bill->br_vat_status == 2) {
						$br_total = $br_total*1.1;
					}
					$br_total_footer += $br_total;
					// payments Calculation
					$pt_amount = 0;
					foreach ($bill->payment as $pt) {
						$pt_amount += $pt->pt_amount;
						$pt_amount_total += $pt->pt_amount;
					}
					$balance = $br_total-$pt_amount;
					$balance_total += $br_total-$pt_amount;
					$tbody .= '<tr>
												<td>'. ++$no.'</td>
												<td>'.date('Y-F', strtotime($bill->br_date)).'</td>
												<td>'.$bill->br_number.'</td>
												<td class="text-right" style="border-right:1px dotted #999; border-left:1px dotted #999;"><span class="pull-left">$</span> '.number_format($br_total, 2).'</td>
												<td class="text-right" style="border-right:1px dotted #999;"><span class="pull-left">$</span> '.number_format($pt_amount, 2).'</td>
												<td class="text-right" style="border-right:1px dotted #999;"><span class="pull-left">$</span> '.number_format($balance, 2).'</td>
												<td class="text-right"><button type="button" onclick="getBill(\''. $bill->br_number .'\', '. $bill->id .')" data-month="" data-toggle="modal" data-target=".modal-view-payment" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
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
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($br_total_footer, 2).'</span></strong></td>
								<td class="text-right bg-info" id="balance_total"><strong><span class="pull-left">$</span> <span class="value">'.number_format($pt_amount_total, 2).'</span></strong></td>
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

	public function payments(Request $r)
	{
		$tbody='';
		$br_total=0;
		$pt_amount=0;
		$balance=0;
		$br_id=$r->br_id;
		// pts Calculation
		$bill = bills::find($br_id);
		$br_total = $bill->br_total;
		// echo $bill->id;
		$pts = payment_transitions::where('pt_bill_id', $bill->id)->orderBy('pt_date','DESC')->get();
		foreach ($pts as $j => $pt) {
			$pt_amount = $pt->pt_amount;
			$balance = $br_total - $pt_amount;
			$tbody .= '<tr>
									<td>'. ++$j .'</td>
									<td>'. $pt->pt_date .'</td>
									<td>'. $bill->br_number .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($br_total, 2) .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($pt_amount, 2) .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($balance, 2) .'</td>
								</tr>';
			$br_total -= $pt->pt_amount;
		}

		echo	'<table class="table table-striped table-hover" id="dataTable_payment">
						<thead>
							<tr>
								<th width="5%">N&deg;</th>
								<th width="15%">ការបរិច្ឆេទ</th>
								<th>លេខរៀងវិក្កយបត្រ</th>
								<th>ប្រាក់សរុប</th>
								<th>ប្រាក់បានទទួល</th>
								<th>ប្រាក់បាននៅសល់</th>
							</tr>
						</thead>
						<tbody id="pt_table">'
								.$tbody.
						'</tbody>
					</table>';
	}

}
