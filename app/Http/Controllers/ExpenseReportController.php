<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\bills;
use App\Models\payment_transitions;
use Illuminate\Http\Request;
use DB;

class ExpenseReportController extends Controller
{
	private $globalNotitfy;
	private $module;

	public function __construct()
	{   
		$this->globalNotitfy = new Users();
		$this->module = '11';
		$this->data=[
			'm'=>'manage_reports',
			'sm'=>$this->module,
			'title'=>'របាយការណ៍ចំណាយ',
	  	// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

	public function index()
	{
		$i = 0;
		$tbody = '';
		$tfoot = '';
		$br_month = '';
		$br_ytotal = 0;
		$br_mtotal = 0;
		$pt_amount = 0;
		$pt_amount_total = 0;
		$balance_tt = 0;
		$balance_total = 0;
		$cur_year = date('Y', time());
		$bills = bills::whereYear('br_date', $cur_year)->orderBy('br_date', 'asc')->get();
		foreach ($bills as $key => $bill) {
			if (date('m', strtotime($bill->br_date)) != $br_month) {
				$br_mtotal = 0;
				$pt_amount = 0;
				$br_month = date('m', strtotime($bill->br_date));
				$bills_in_month = bills::whereMonth('br_date', $br_month)->orderBy('br_date', 'asc')->get();
				foreach ($bills_in_month as $j => $br_in_month) {
					$br_total = $br_in_month->br_total;
					$br_mtotal += $br_total;
					$br_ytotal += $br_total;
					// payment_transitions Calculation
					foreach ($br_in_month->payment as $pt) {
						$pt_amount += $pt->pt_amount;
						$pt_amount_total += $pt->pt_amount;
					}
				}
				$balance_tt = $br_mtotal - $pt_amount;
				$balance_total = $br_ytotal - $pt_amount_total;
				$tbody .= '<tr>
										<td>'.++$i.'</td>
										<td>'.date('Y', strtotime($bill->br_date)).'</td>
										<td>'.date('F', strtotime($bill->br_date)).'</td>
										<td class="text-right" data-value="'.$br_mtotal.'" style="border-left: 0.5px dotted #999;border-right: 0.5px dotted #999;"><span class="pull-left">$</span> '.number_format($br_mtotal, 2).'</td>
										<td class="text-right" data-value="'.$pt_amount.'" style="border-right: 0.5px dotted #999;"><span class="pull-left">$</span> '.number_format($pt_amount, 2).'</td>
										<td class="text-right '.(($balance_tt>0)? 'text-danger':'' ).'" data-value="'.$balance_tt.'" style="border-right: 0.5px dotted #999;"><span class="pull-left">$</span> '.number_format($balance_tt, 2).'</td>
										<td class="text-right"><button type="button" onclick="getMonth(\''.date('Y-m', strtotime($bill->br_date)).'\')" data-month="" data-toggle="modal" data-target=".bs-example-modal-lg" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
									</tr>';
			}
		}
			$tfoot .= '<tr>
									<td></td>
									<td></td>
									<td class="text-right KHMERBTB"><strong>សរុប​ </strong></td>
									<td data-value="'.$br_ytotal.'" id="br_ytotal" class="bg-info text-right"><strong><span class="pull-left">$</span>  <span class="value">'.number_format($br_ytotal, 2).'</span></strong></td>
									<td data-value="'.$pt_amount_total.'" id="pt_amount_total" class="bg-info text-right"><strong><span class="pull-left">$</span>  <span class="value">'.number_format($pt_amount_total, 2).'</span></strong></td>
									<td data-value="'.$balance_total.'" id="balance_total" class="bg-info text-right '.(($balance_total>0)? 'text-danger':'' ).'"><strong><span class="pull-left">$</span>  <span class="value">'.number_format($balance_total, 2).'</span></strong></td>
									<td></td>
								</tr>';

		$this->data +=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-file-export"></i> របាយការណ៍ចំណាយ</li>',
			'tfoot' => $tfoot,
			'tbody' => $tbody,
		];
		// return view('expensereport.index', $this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('expensereport.index',$this->data) : view('errors.permission',$this->data) );
	}


	public function search(Request $r)
	{
		$no = 0;
		$tbody = '';
		$tfoot = '';
		$br_month = '';
		$br_ytotal = 0;
		$br_mtotal = 0;
		$pt_amount = 0;
		$pt_amount_total = 0;
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
				// Expense
				$br_mtotal = 0;
				$balance_tt = 0;
				$pt_amount = 0;
				$bills_in_month = bills::whereYear('br_date', $year1)
																	->whereMonth('br_date', $month1)
																	->orderBy('br_date', 'asc')->get();
				foreach ($bills_in_month as $br => $br_in_month) {
					$br_total = $br_in_month->br_total;
					$br_mtotal += $br_total;
					$br_ytotal += $br_total;

					// payment_transitions Calculation
					foreach ($br_in_month->payment as $pt) {
						$pt_amount += $pt->pt_amount;
						$pt_amount_total += $pt->pt_amount;
					}
				}
				$balance_tt = $br_mtotal - $pt_amount;
				$balance_total = $br_ytotal - $pt_amount_total;
				$tbody .= '<tr>
										<td>'.++$no.'</td>
										<td>'.date('Y', strtotime($year1)).'</td>
										<td>'.date('F', mktime(0, 0, 0, str_pad($month1, 2, '0', STR_PAD_LEFT), 1, 2011)).'</td>
										<td class="text-right" data-value="'.$br_mtotal.'" style="border-left: 0.5px dotted #999;border-right: 0.5px dotted #999;"><span class="pull-left">$</span> '.number_format($br_mtotal, 2).'</td>
										<td class="text-right" data-value="'.$pt_amount.'" style="border-right: 0.5px dotted #999;"><span class="pull-left">$</span> '.number_format($pt_amount, 2).'</td>
										<td class="text-right '.(($balance_tt>0)? 'text-danger':'' ).'" data-value="'.$balance_tt.'" style="border-right: 0.5px dotted #999;"><span class="pull-left">$</span> '.number_format($balance_tt, 2).'</td>
										<td class="text-right"><button type="button" onclick="getMonth(\''.$year1.'-'.str_pad($month1, 2, '0', STR_PAD_LEFT).'\')" data-month="" data-toggle="modal" data-target=".bs-example-modal-lg" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
									</tr>';

				$month1 ++;
			}
			$month1 = '01';
			$year1 ++;
		}
		$tfoot .= '<tr>
								<td></td>
								<td></td>
								<td class="text-right KHMERBTB"><strong>សរុប​ </strong></td>
								<td data-value="'.$br_ytotal.'" id="br_ytotal" class="bg-info text-right"><strong><span class="pull-left">$</span>  <span class="value">'.number_format($br_ytotal, 2).'</span></strong></td>
								<td data-value="'.$pt_amount_total.'" id="pt_amount_total" class="bg-info text-right"><strong><span class="pull-left">$</span>  <span class="value">'.number_format($pt_amount_total, 2).'</span></strong></td>
								<td data-value="'.$balance_total.'" id="balance_total" class="bg-info text-right '.(($balance_total>0)? 'text-danger':'' ).'"><strong><span class="pull-left">$</span>  <span class="value">'.number_format($balance_total, 2).'</span></strong></td>
								<td></td>
							</tr>';

		echo '<table class="table table-striped table-hover" id="dataTable_expense">
						<thead>
							<tr>
								<th width="5%">N&deg;</th>
								<th width="10%">សម្រាប់ឆ្នាំ</th>
								<th width="10%">សម្រាប់ខែ</th>
								<th width="22%">ប្រាក់សរុប</th>
								<th width="22%">ប្រាក់បានបង់</th>
								<th width="22%">ប្រាក់នៅសល់</th>
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

	public function bills(Request $r)
	{
		$output='';
		$month= date('m', strtotime($r->monthyear));
		$year= date('Y', strtotime($r->monthyear));
		// payment_transitions Calculation
		$bills = bills::whereYear('br_date', $year)
              ->whereMonth('br_date', $month)
              ->orderBy('br_number', 'asc')->get();
		foreach ($bills as $i => $bill) {
			$i++;

			$pt_amount_tt = 0;
			$balance = 0;
			$payment_transitions = payment_transitions::where('pt_bill_id', $bill->id)->orderBy('id','DESC')->get();
			foreach ($payment_transitions as $j => $payment) {
				$pt_amount_tt += $payment->pt_amount;
			}
			$balance = $bill->br_total - $pt_amount_tt;
			$output .= '<tr>
									<td>'. $i .'</td>
									<td>'. $bill->br_date .'</td>
									<td>'. $bill->br_number .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($bill->br_total, 2) .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($pt_amount_tt, 2) .'</td>
									<td><i class="fa fa-dollar-sign"></i> '. number_format($balance, 2) .'</td>
									<td class="text-right"><button type="button" onclick="getBill(\''. $bill->br_number .'\', \''. $bill->id .'\')" data-month="" data-toggle="modal" data-target=".modal-view-pt" title="Show" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button> &nbsp;&nbsp;</td>
								</tr>';
		}

		echo	'<table class="table table-striped table-hover" id="dataTable_payment">
							<thead>
								<tr>
									<th width="5%">N&deg;</th>
									<th width="15%">ការបរិច្ឆេទ</th>
									<th>លេខរៀង</th>
									<th>ប្រាក់សរុប</th>
									<th>ប្រាក់បានបង់</th>
									<th>ប្រាក់បាននៅសល់</th>
									<th width="8%" class="text-right disabled-sorting">សកម្មភាព &nbsp;&nbsp;</th>
								</tr>
							</thead>
							<tbody id="payment_table">'
									.$output.
							'</tbody>
						</table>';
	}

	public function payments(Request $r)
	{
		$tbody='';
		$br_total=0;
		$pt_amount=0;
		$balance=0;
		$br_id=$r->br_id;
		$bill = bills::find($br_id);
		$br_total = $bill->br_total;
		// pts Calculation
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
