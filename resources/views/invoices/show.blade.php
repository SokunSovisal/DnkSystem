@extends('layouts.app')

@section('css')
	<style type="text/css">
		table,td,th,p,li,h1,h2,h3,h4,h5,h6,div{
			font-family: 'roboto_r' !important;
			font-size: 10pt;
		}
		#invoice-print{
			border: 1px solid #ddd;
			margin: 25px auto;
			width: 21.3cm;
			height: 29.7cm;
			position: relative;
			font-family: 'roboto_r' !important;
			padding: 10px 30px;
			font-size: 10pt;
		}
		.print-header{
			padding: 22px 35px 0 38px;
		}
		.print-header .title{
			margin-bottom: 20px;
		}
		.print-header h3{
			font-size: 11pt;
			text-align: center;
		}
		.print-header h3 strong{
			font-size: 12pt;
			text-align: center;
		}
		.print-header table.num-date{
			margin: 30px 0;
		}
		.print-header table.num-date td{
			padding: 3px 6px;
		}
		.print-header table.num-date td:last-child{
			border: 1px solid #000;
		}
		.print-header table.num-date tr:last-child td:last-child{
			border-top: 3px double #000;
		}
		
		.print-header table.info{
			margin: 30px 0;
		}
		.print-header table.info td{
			padding: 3px 6px;
		}
		.print-header table.info td div{
			border-bottom: 1px dashed #000;
		}
		.print-header table.info td div .title{
			background: #fff;
			padding-bottom: 4px;
		}

		.print-body{
			padding: 0 37px 10px 37px;
		}
		.print-body .data-section{
			font-size: 12pt;
		}
		.print-body .data-section th{
			border: 1px solid #000;
			border-bottom: 3px double #000;
			text-align: center;
			padding-top: 10px;
		}
		.print-body .data-section th h4{
			font-size: 10pt;
			padding-bottom: 4px;
		}
		.print-body .data-section tbody tr td{
			border-left: 1px solid #000;
			border-right: 1px solid #000;
			border-bottom: 1px dashed #000;
			padding: 5px;
		}
		.print-body .data-section tbody tr:last-child td{
			border-bottom: 1px solid #000;
		}
		.print-body .data-section tfoot tr td{
			padding: 5px;
		}
		.print-body .data-section tfoot tr td:last-child{
			border-left: 1px solid #000;
			border-right: 1px solid #000;
			border-bottom: 1px dashed #000;
			font-weight: bold;
		}
		.print-body .data-section tfoot tr:last-child td:last-child{
			border-bottom: 1px solid #000;
		}
		.print-body .signature-section .box{
			height: 70px;
		}
		.print-body .signature-section .khmerOsmoul{
			margin: 5px 0;
		}
		.print-footer{
			max-width: 100%;
			position: absolute;
			padding: 10px 65px 22px 35px;
			bottom: 0;
		}

		@media print {

			#sidebar-left,#body-header,.btnPrint,.btnAdd,.btnBack{ display: none; padding: 0; margin: 0;}

			#main,.bg-white{ padding: 0 !important; margin: 0 !important;}

			#invoice-print{
				margin: 0;
				border: none;
				width: 100%;
				height: 29.5cm;
			}
			.print-header table.info td div .title{
				background: #fff !important;
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
						{{route('invoices.index')}}
					@endslot
				@endcomponent
			</div>
			<div class="col-sm-6">
				<div class="pull-right">
					<a target="_blank" class="btn btn-info nbr btnPrint"><i class="fa fa-print"></i> បោះពុម្ភ</a>
				</div>
			</div>
		</div>
		<section id="invoice-print">
			<header class="print-header">
				<img src="/images/invoices/1.png" alt="...">
				<br/>
				<br/>
				<div class="title">
					<h3 class="khmerOsmoul">វិក្កយបត្រ{{($invoice->inv_vat_status==2)?'អាករ':''}}</h3>
					<h3><strong>{{($invoice->inv_vat_status==2)?'TAX ':''}}INVOICE</strong></h3>
				</div>
				
				<table width="100%" class="num-date">
					<tr>
						<td width="70%" class="KHMERBTB text-right">លេខរៀងវិក្កយបត្រ/<span>Invoice N&deg; :</span></td>
						<td width="30%" class="text-center">{{$invoice->inv_number}}</td>
					</tr>
					<tr>
						<td width="70%" class="KHMERBTB text-right">កាលបរិច្ឆេទ/<span>Date :</span></td>
						<td width="30%" class="text-center">{{ date('d-M-y', strtotime($invoice->inv_date)) }}</td>
					</tr>
				</table>

				<table width="100%" class="info">
					<tr>
						<td class="KHMERBTB"><div><span class="title">ឈ្នោះក្រុមហ៊ុន : </span>&nbsp;<span class="khmerOsmoul">{{$invoice->company->com_name}}</span></div></td>
					</tr>
					<tr>
						<td class="roboto_r"><div><span class="title">Company Name : </span>&nbsp;<span class="roboto_r">{{$invoice->company->com_name_en}}</span></div></td>
					</tr>
					<tr>
						<td><div><span class="title"><span class="KHMERBTB">អាសយដ្ឋាន</span>/Address : </span>&nbsp;<span class="KHMERBTB">{{$invoice->inv_com_address}}</span></div></td>
					</tr>
					<tr>
						<td class="KHMERBTB"><div><span class="title">លេខទូរស័ព្ទ/<span class="roboto_r">Telephone</span> : </span>&nbsp;<span class="roboto_r">{{$invoice->inv_com_phone}}</span></div></td>
					</tr>
					<tr class="{{($invoice->inv_vat_status==1)?'sr-only':''}}">
						<td class="KHMERBTB"><div><span class="title">លេខអត្តសញ្ញាណកម្មអតប: </span>&nbsp;<span class="roboto_r">{{$invoice->company->com_vat_id}}</span></div></td>
					</tr>
				</table>
			</header>
			<div class="print-body">
				<table width="100%" class="data-section">
					<thead>
						<tr>
							<th width="6%">
								<h4 class="khmerOsmoul">ល.រ</h4>
								<h4>N&deg;</h4>
							</th>
							<th width="53%">
								<h4 class="khmerOsmoul">បរិយាយ</h4>
								<h4>Description</h4>
							</th>
							<th width="10%">
								<h4 class="khmerOsmoul">បរិមាណ</h4>
								<h4>Quantity</h4>
							</th>
							<th width="13%" colspan="2">
								<h4 class="khmerOsmoul">តម្លៃឯកតា</h4>
								<h4>Unit Price</h4>
							</th>
							<th width="18%">
								<h4 class="khmerOsmoul">ថ្លៃសរុប</h4>
								<h4>amount(USD)</h4>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($invoice_detail as $i => $item)
								<tr>
									<td class="text-center" valign="top">{{$i+1}}</td>
									<td>
										{{$item->service->s_name}}
										{!!$item->invd_description!!}
									</td>
									<td class="text-center" valign="top">{{$item->invd_qty}}</td>
									<td class="text-right" valign="top" colspan="2"><span class="pull-left">$</span>{{number_format($item->invd_price, 2)}}</td>
									<td class="text-right" valign="top"><span class="pull-left">$</span>{{number_format($item->invd_price, 2*$item->invd_qty)}}</td>
									<?php
										$total_amount += $item->invd_price*$item->invd_qty;
									?>
								</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
								<td colspan="4" class="text-right"><span class="khmerOsmoul">សរុប</span>/({{($invoice->inv_vat_status==2)?'Sub ':''}} Total)</td>
								<td class="text-right" colspan="2"><span class="pull-left">$</span> {{number_format($total_amount, 2)}}</td>
							</tr>
							<tr class="{{($invoice->inv_vat_status==1)?'sr-only':''}}" >
								<td colspan="4" class="text-right"><span class="khmerOsmoul">អាករលើតម្លៃបន្ថែម</span>/VAT(10%)</td>
								<td class="text-right" colspan="2"><span class="pull-left">$</span> {{number_format($total_amount*0.1, 2)}}</td>
							</tr>
							<tr class="{{($invoice->inv_vat_status==1)?'sr-only':''}}" >
								<td colspan="4" class="text-right"><span class="khmerOsmoul">សរុបរួម</span>/(Grand Total)</td>
								<td class="text-right" colspan="2"><span class="pull-left">$</span> {{number_format($total_amount*1.1, 2)}}</td>
							</tr>
					</tfoot>
				</table>
				<br/>
				<table class="signature-section">
					<tr width="40%">
						<td>
							<div class="text-center">
								<div class="box"></div>
								<div>________________________________</div>
								<h4 class="khmerOsmoul">ហត្ថលេខា និងឈ្មោះអ្នកទិញ</h4>
								<h4>Customer's Signature & Name</h4>
							</div>
						</td>
						<td width="28%"></td>
						<td width="22%">
							<div class="text-center">
								<div class="box"></div>
								<div>________________________________</div>
								<h4 class="khmerOsmoul">ហត្ថលេខា និងឈ្មោះអ្នកលក់</h4>
								<h4>Seller's Signature & Name</h4>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<footer class="print-footer">
				<img src="/images/invoices/2.png" alt="...">
			</footer>
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
