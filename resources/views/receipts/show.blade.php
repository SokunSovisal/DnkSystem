@extends('layouts.app')

@section('css')
	<style type="text/css">
		#receipts-print{
			border: 1px solid #ddd;
			margin: 25px auto;
			width: 21cm;
			height: 29.7cm;
		}
		.third-receipt > div,
		.second-receipt > div,
		.first-receipt > div{
			font-family: 'Times New Roman' !important;
			font-size: 13pt;
		}
		.third-receipt,
		.second-receipt,
		.first-receipt{
			padding-top: 0.16cm;
			width: 20.92cm;
			height: 9.90cm;
			position: relative;
			border-bottom: 1px dashed #333;
		}
		.third-receipt{
			border-bottom: none;
		}
		.third-receipt img,
		.second-receipt img,
		.first-receipt img{
			/* border: 1px solid red; */
		}
		.third-receipt .rec_number,
		.second-receipt .rec_number,
		.first-receipt .rec_number{
			position: absolute;
			top: 1.62cm;
			left: 17.1cm;
			color: red;
		}
		.third-receipt .rec_inv_id,
		.second-receipt .rec_inv_id,
		.first-receipt .rec_inv_id{
			position: absolute;
			top: 2.27cm;
			left: 17.1cm;

		}
		.third-receipt .rec_date,
		.second-receipt .rec_date,
		.first-receipt .rec_date{
			position: absolute;
			top: 2.9cm;
			left: 17.1cm;
		}
		.third-receipt .rec_company,
		.second-receipt .rec_company,
		.first-receipt .rec_company{
			position: absolute;
			top: 4.33cm;
			left: 3.6cm;
		}
		.third-receipt .rec_received_ammount,
		.second-receipt .rec_received_ammount,
		.first-receipt .rec_received_ammount{
			position: absolute;
			top: 5.57cm;
			left: 4cm;

		}
		.third-receipt .rec_description,
		.second-receipt .rec_description,
		.first-receipt .rec_description{
			position: absolute;
			top: 6.8cm;
			left: 3cm;

		}

		.second-receipt,
		.first-receipt{

		}
		@media print {

			#sidebar-left,#body-header,.btnPrint,.btnAdd,.btnBack{ display: none; padding: 0; margin: 0;}

			#main,.bg-white{ padding: 0 !important; margin: 0 !important;}

			#receipts-print{
				margin: 0;
				border: none;
			}
			.third-receipt .rec_number,
			.second-receipt .rec_number,
			.first-receipt .rec_number{
				color: red !important;
				-webkit-print-color-adjust: exact !important;
				-moz-print-color-adjust: exact !important;
				-o-print-color-adjust: exact !important;
			}

		}
	</style>
@endsection

@section('content')


	<section class="bg-white">
		<div class="row">
			<div class="col-sm-6">
				@component('comps.btnBack')
					@slot('btnBack')
						{{route('receipts.index')}}
					@endslot
				@endcomponent
			</div>
			<div class="col-sm-6">
				<div class="pull-right">
					<a target="_blank" class="btn btn-info nbr btnPrint"><i class="fa fa-print"></i> បោះពុម្ភ</a>
				</div>
			</div>
		</div>
		<?php
			// convert nomey

			function echo_money_in_letter($number){
				$no = floor($number);
				$point = round($number - $no, 2) * 100;
				$hundred = null;
				$digits_1 = strlen($no);
				$i = 0;
				$str = array();
				$words = array('0' => '', '1' => 'one', '2' => 'two',
					'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
					'7' => 'seven', '8' => 'eight', '9' => 'nine',
					'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
					'13' => 'thirteen', '14' => 'fourteen',
					'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
					'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
					'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
					'60' => 'sixty', '70' => 'seventy',
					'80' => 'eighty', '90' => 'ninety');
				$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
				while ($i < $digits_1) {
					$divider = ($i == 2) ? 10 : 100;
					$number = floor($no % $divider);
					$no = floor($no / $divider);
					$i += ($divider == 10) ? 1 : 2;
					if ($number) {
							$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
							$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
							$str [] = ($number < 21) ? $words[$number] .
									" " . $digits[$counter] . $plural . " " . $hundred
									:
									$words[floor($number / 10) * 10]
									. " " . $words[$number % 10] . " "
									. $digits[$counter] . $plural . " " . $hundred;
					} else $str[] = null;
				}
				$str = array_reverse($str);
				$result = implode('', $str);
				$point = abs($point);
				$points = ($point) ?
					" and " . $words[$point / 10] . " " . 
								$words[$point = $point % 10]." Cent " : ' ';
				echo $result . "Dollar  " . $points;
			}


		?>
		<section id="receipts-print">
			<div class="first-receipt">
				<img src="/images/receipts/1.jpg" alt="">
				<div class="rec_number">{{ $receipt->rec_number }}</div>
				<div class="rec_inv_id">{{ $receipt->invoice->inv_number }}</div>
				<div class="rec_date">{{ date('d-M-Y', strtotime($receipt->rec_date)) }}</div>
				<div class="rec_company">{{ $receipt->company->com_name_en }}</div>
				<div class="rec_received_ammount"><strong>$ {{ number_format($receipt->rec_received_ammount, 2) }}</strong> ({{ echo_money_in_letter($receipt->rec_received_ammount)}})</div>
				<div class="rec_description">{{ $receipt->rec_description }}</div>
			</div>
			<div class="second-receipt">
				<img src="/images/receipts/1.jpg" alt="">
				<div class="rec_number">{{ $receipt->rec_number }}</div>
				<div class="rec_inv_id">{{ $receipt->invoice->inv_number }}</div>
				<div class="rec_date">{{ date('d-M-Y', strtotime($receipt->rec_date)) }}</div>
				<div class="rec_company">{{ $receipt->company->com_name_en }}</div>
				<div class="rec_received_ammount"><strong>$ {{ number_format($receipt->rec_received_ammount, 2) }}</strong> ({{ echo_money_in_letter($receipt->rec_received_ammount)}})</div>
				<div class="rec_description">{{ $receipt->rec_description }}</div>
			</div>
			<div class="third-receipt">
				<img src="/images/receipts/1.jpg" alt="">
				<div class="rec_number">{{ $receipt->rec_number }}</div>
				<div class="rec_inv_id">{{ $receipt->invoice->inv_number }}</div>
				<div class="rec_date">{{ date('d-M-Y', strtotime($receipt->rec_date)) }}</div>
				<div class="rec_company">{{ $receipt->company->com_name_en }}</div>
				<div class="rec_received_ammount"><strong>$ {{ number_format($receipt->rec_received_ammount, 2) }}</strong> ({{ echo_money_in_letter($receipt->rec_received_ammount)}})</div>
				<div class="rec_description">{{ $receipt->rec_description }}</div>
			</div>
		</section>
	</section>
@endsection

@section('js')
	<script type="text/javascript">
		$('.btnPrint').click(function() {
			window.print();
		});
	</script>
@endsection
