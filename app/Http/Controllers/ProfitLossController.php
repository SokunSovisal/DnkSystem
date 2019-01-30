<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\bills;
use App\Models\Receipts;
use App\Models\invoice;
use App\Models\payment_transitions;
use DB;



class ProfitLossController extends Controller
{

	private $globalNotitfy;
	private $module;

	public function __construct()
	{   
		$this->globalNotitfy = new Users();
		$this->module = '12';
		$this->data=[
			'm'=>'manage_reports',
			'sm'=>$this->module,
			'title'=>'របាយការណ៍ចំណេញ-ខាត',
	  	// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}



	public function index()
	{
		$tbody = '';
		$tfoot = '';
		$profitloss = 0;
		$profitloss_total = 0;
		// income
		$inv_ytotal = 0;
		$inv_mtotal = 0;
		$rec_received = 0;
		$rec_received_total = 0;
		$rec_balance_tt = 0;
		$rec_balance_total = 0;
		// expense
		$br_ytotal = 0;
		$br_mtotal = 0;
		$pt_amount = 0;
		$pt_amount_total = 0;
		$pt_balance_tt = 0;
		$pt_balance_total = 0;

		$cur_year = date('Y', time());
		for ($i=1; $i <= 12; $i++) {
			$month = str_pad($i, 2, '0', STR_PAD_LEFT);
			// Income
			$rec_received = 0;
			$invoices_in_month = invoice::whereYear('inv_date', $cur_year)
																		->whereMonth('inv_date', $month)
																		->orderBy('inv_date', 'asc')->get();
			foreach ($invoices_in_month as $j => $inv_in_month) {
				$inv_total = $inv_in_month->inv_total;
				// Receipts Calculation
				foreach ($inv_in_month->receipt as $rec) {
					$rec_received += $rec->rec_received_amount;
					$rec_received_total += $rec->rec_received_amount;
				}
			}

			// Expense
			$pt_amount = 0;
			$bills_in_month = bills::whereYear('br_date', $cur_year)
																->whereMonth('br_date', $month)
																->orderBy('br_date', 'asc')->get();
			foreach ($bills_in_month as $j => $br_in_month) {
				// payment_transitions Calculation
				foreach ($br_in_month->payment as $pt) {
					$pt_amount += $pt->pt_amount;
					$pt_amount_total += $pt->pt_amount;
				}
			}

			$profitloss = $rec_received - $pt_amount;
			$profitloss_total = $rec_received_total - $pt_amount_total;

			$tbody .= '<tr>
									<td class="text-center" style="padding-right: 30px;">'.$i.'</td>
									<td class="text-center">'.$cur_year.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>'.date('F', mktime(0, 0, 0, $i, 1, 2011)).'</td>
									<td data-value="'.$rec_received.'" class="text-right" style="border-left: 1px dotted #999; border-right: 1px dotted #999;"><span class="pull-left">$</span> '.number_format($rec_received, 2).'</td>
									<td data-value="'.$pt_amount.'" class="text-right" style="border-right: 1px dotted #999;"><span class="pull-left">$</span> '.number_format($pt_amount, 2).'</td>
									<td data-value="'.$profitloss.'" class="text-right '.(($profitloss > 0)? 'text-success' : (($profitloss == 0)? '' : 'text-danger') ).'" style="border-right: 1px dotted #999;"><span class="pull-left">$</span> '.number_format($profitloss, 2).'</td>
								</tr>';

		}
		$tfoot .= '<tr>
								<td></td>
								<td></td>
								<td class="text-right KHMERBTB"><strong>សរុប​ </strong></td>
								<td id="total_income" class="bg-success text-right"><strong><span class="pull-left">$</span> <span class="value">'.number_format($rec_received_total, 2).'</span></strong></td>
								<td id="total_expense" class="bg-danger text-right"><strong><span class="pull-left">$</span> <span class="value">'.number_format($pt_amount_total, 2).'</span></strong></td>
								<td id="total_profitloss" class="bg-warning text-right '.(($profitloss_total > 0)? 'text-success' : (($profitloss_total == 0)? '' : 'text-danger') ).'"><strong><span class="pull-left">$</span> <span class="value">'.number_format($profitloss_total, 2).'</span></strong></td>
							</tr>';
		$this->data +=[
			'tfoot' => $tfoot,
			'tbody' => $tbody,
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-chart-line"></i> របាយការណ៍ចំណេញ-ខាត</li>',
		];
		// return view('profitlossreport.index', $this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('profitlossreport.index',$this->data) : view('errors.permission',$this->data) );
	}


	public function search(Request $r)
	{	
		$tbody = '';
		$tfoot = '';
		$no = 0;
		$profitloss = 0;
		$profitloss_total = 0;
		// income
		$inv_ytotal = 0;
		$inv_mtotal = 0;
		$rec_received = 0;
		$rec_received_total = 0;
		$rec_balance_tt = 0;
		$rec_balance_total = 0;
		// expense
		$br_ytotal = 0;
		$br_mtotal = 0;
		$pt_amount = 0;
		$pt_amount_total = 0;
		$pt_balance_tt = 0;
		$pt_balance_total = 0;

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
				// echo $month2."::::: ".str_pad($j, 2, '0', STR_PAD_LEFT)."<br/>";
				// Income
				$rec_received = 0;
				$invoices_in_month = invoice::whereYear('inv_date', $year1)
																			->whereMonth('inv_date', str_pad($j, 2, '0', STR_PAD_LEFT))
																			->orderBy('inv_date', 'asc')->get();
				foreach ($invoices_in_month as $key => $inv_in_month) {
					$inv_total = $inv_in_month->inv_total;
					if ($inv_in_month->inv_vat_status == 2) {
						$inv_total = $inv_in_month->inv_total*1.1;
					}
					// Receipts Calculation
					foreach ($inv_in_month->receipt as $rec) {
						$rec_received += $rec->rec_received_amount;
						$rec_received_total += $rec->rec_received_amount;
					}
				}

				// Expense
				$pt_amount = 0;
				$bills_in_month = bills::whereYear('br_date', $year1)
																	->whereMonth('br_date', $month1)
																	->orderBy('br_date', 'asc')->get();
				foreach ($bills_in_month as $k => $br_in_month) {
					// payment_transitions Calculation
					foreach ($br_in_month->payment as $pt) {
						$pt_amount += $pt->pt_amount;
						$pt_amount_total += $pt->pt_amount;
					}
				}

				$profitloss = $rec_received - $pt_amount;
				$profitloss_total = $rec_received_total - $pt_amount_total;
				$tbody .= '<tr>
										<td class="text-center" style="padding-right: 30px;">'.++$no.'</td>
										<td class="text-center">'.$year1.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td>'.date('F', mktime(0, 0, 0, $month1, 1, 2011)).'</td>
										<td data-value="'.$rec_received.'" class="text-right" style="border-left: 1px dotted #999; border-right: 1px dotted #999;"><span class="pull-left">$</span> '.number_format($rec_received, 2).'</td>
										<td data-value="'.$pt_amount.'" class="text-right" style="border-right: 1px dotted #999;"><span class="pull-left">$</span> '.number_format($pt_amount, 2).'</td>
										<td data-value="'.$profitloss.'" class="text-right '.(($profitloss > 0)? 'text-success' : (($profitloss == 0)? '' : 'text-danger') ).'" style="border-right: 1px dotted #999;"><span class="pull-left">$</span> '.number_format($profitloss, 2).'</td>
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
								<td id="total_income" class="bg-success text-right"><strong><span class="pull-left">$</span> <span class="value">'.number_format($rec_received_total, 2).'</span></strong></td>
								<td id="total_expense" class="bg-danger text-right"><strong><span class="pull-left">$</span> <span class="value">'.number_format($pt_amount_total, 2).'</span></strong></td>
								<td id="total_profitloss" class="bg-warning text-right '.(($profitloss_total > 0)? 'text-success' : (($profitloss_total == 0)? '' : 'text-danger') ).'"><strong><span class="pull-left">$</span> <span class="value">'.number_format($profitloss_total, 2).'</span></strong></td>
							</tr>';

		echo '<table class="table table-striped table-hover" id="dataTable_pl">
						<thead>
							<tr>
								<th width="5%" class="text-center">N&deg;</th>
								<th class="text-center" width="8%">សម្រាប់ឆ្នាំ</th>
								<th width="9%">សម្រាប់ខែ</th>
								<th width="14%" class="text-center">ចំណូលសរុប</th>
								<th width="14%" class="text-center">ចំណាយសរុប</th>
								<th width="14%" class="text-center">ប្រាក់ចំណេញ-ខាត</th>
							</tr>
						</thead>
						<tbody class="roboto_r" id="tbody">
							'.$tbody.'
						</tbody>
						<tfoot class="roboto_r" id="tfoot">
							'.$tfoot.'
						</tfoot>
					</table>';
	}

}
