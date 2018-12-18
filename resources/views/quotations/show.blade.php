@extends('layouts.app')

@section('css')
	<style type="text/css">
		table,td,th,p,li,h1,h2,h3,h4,h5,h6,div{
			font-family: 'Times New Roman' !important;
		}
		#quotation-print{
			border: 1px solid #ddd;
			margin: 25px auto;
			width: 21cm;
			height: 29.7cm;
			position: relative;
			font-family: 'Times New Roman' !important;
			padding: 15px 35px;
		}
		.print-header{
			padding: 22px 35px 0 38px;
		}
		.print-header table tr td:nth-child(2),
		.print-header table tr td:nth-child(5){
			border-bottom: 1px dashed #ddd;
		}
		.print-header .table-header{
			padding-left: 10px;
			margin-top: 12px;
		}
		.print-header table tr td{
			padding-top: 6px;
		}
		.print-header h2{
			text-align: center;
			padding: 10px 0 5px 0;
		}
		.print-header h2 strong{
			border-bottom: 2px solid #333;
		}

		.print-body{
			padding: 0 35px 10px 35px;
		}
		.print-body table.table-purpose tr td{
			padding: 10px 0;
		}
		.print-body table.table-body tr th{
			text-align: center;
			padding: 7px 0;
			border: 1px solid #000;
		}
		.print-body table.table-body tbody tr{
			border-left: 1px solid #000;
			border-right: 1px solid #000;
		}
		.print-body table.table-body tbody tr:last-child{
			border-bottom: 1px solid #000;
			border-top: 1px solid #000;
		}
		.print-body table.table-body tbody tr td{
			padding: 5px 8px;
			border-left: 1px solid #000;
			border-right: 1px solid #000;
		}
		.print-body table.table-body tbody tr:last-child td:last-child{
			border: 1px solid #000;
		}
		.print-body .block-signature{
			text-align: center;
		}
		.print-body .block-signature .box{
			height: 1.2cm;
		}
		.print-footer{
			max-width: 100%;
			position: absolute;
			padding: 10px 70px 22px 35px;
			bottom: 0;
		}
		.text-red{ color: red; }
		tr > td.description{
			padding-left: 15px;
			padding-right: 15px;
		}
		tr > td.price{ padding-right: 5px; }
		td.nb{ border: none !important; }
		td.description small{ color: #666;}
		td ul{
		 	padding-left: 25px;
		 }


		@media print {

			#sidebar-left,#body-header,.btnPrint,.btnAdd,.btnBack{ display: none; padding: 0; margin: 0;}

			#main,.bg-white{ padding: 0 !important; margin: 0 !important;}

			#quotation-print{
				margin: 0;
				margin-left: 2px;
				width: 100%;
				height: 30.2cm;
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
						{{route('quotations.index')}}
					@endslot
				@endcomponent
			</div>
			<div class="col-sm-6">
				<div class="pull-right">
					<a target="_blank" class="btn btn-info nbr btnPrint"><i class="fa fa-print"></i> បោះពុម្ភ</a>
				</div>
			</div>
		</div>
		<section id="quotation-print">
			<header class="print-header">
				<img src="/images/quotations/1.png" alt="...">
				<div class="table-header">
					
					<table width="100%">
						<tr>
							<td width="10%"><strong>To</strong></td>
							<td width="46%">{{$quote->company->com_name}}</td>
							<td width="8%"></td>
							<td width="14%"><strong>Quote N&deg;</strong></td>
							<td width="22%"><span class="text-red">{{$quote->quote_number}}</span></td>
						</tr>
						<tr>
							<td width="10%"><strong>Attend</strong></td>
							<td width="46%">{{$quote->quote_cp_name}}</td>
							<td width="8%"></td>
							<td width="14%"><strong>Date</strong></td>
							<td width="22%">{{$quote->quote_date}}</td>
						</tr>
						<tr>
							<td width="10%"><strong>Phone</strong></td>
							<td width="46%">{{$quote->quote_cp_phone}}</td>
							<td width="8%"></td>
							<td width="14%"></td>
							<td width="22%" class="nb"></td>
						</tr>
						<tr>
							<td width="10%"><strong>E-mail</strong></td>
							<td width="46%">{{$quote->quote_cp_email}}</td>
							<td width="8%"></td>
							<td width="14%"></td>
							<td width="22%" class="nb"></td>
						</tr>
					</table>
				</div>
				<h2><strong>Quotation</strong></h2>
			</header>
			<div class="print-body">
				<table width="100%" class="table-purpose">
					<tr>
						<td valign="top" width="60px"><strong>Purpose: </strong></td>
						<td><strong>{{$quote->quote_purpose}}</strong></td>
					</tr>
				</table>

				<table width="100%" class="table-body">
					<thead>
						<tr>
							<th width="5%">N&deg;</th>
							<th width="57%">Description</th>
							<th width="10%">Unit</th>
							<th width="14%">Unit Price</th>
							<th width="14%">Ammount</th>
						</tr>
					</thead>
					<tbody>
						@foreach($quotationservices as $i => $qs)
							<tr>
								<td align="center" valign="top">{{$i+1}}</td>
								<td class="description">
									<strong>{{$qs->service->s_name}}</strong>
									<br/>
									{!! $qs->qs_description !!}
								</td>
								<td align="center" valign="top">{{$qs->qs_qty}}</td>
								<td align="right" valign="top" class="price"><span class="pull-left">$</span>  {{number_format($qs->qs_price, 2)}}</td>
								<td align="right" valign="top" class="price"><span class="pull-left">$</span> {{number_format($qs->qs_price * $qs->qs_qty, 2)}}</td>
								<?php $total_amount += ($qs->qs_price * $qs->qs_qty) ?>
							</tr>
						@endforeach
							<tr>
								<td align="right" class="price" colspan="4"><strong>Total (not include VAT)=</strong></td>
								<td align="right" class="price"><span class="pull-left">$</span> <strong>{{number_format($total_amount, 2)}}</strong></td>
							</tr>
					</tbody>
				</table>
				<div class="quote_term">{!!$quote->quote_term!!}</div>
				<table>
					<tr width="30%">
						<td>
							<div class="block-signature">
								<div class="box"></div>
								<div>___________________________</div>
								<div>Customer's Stamp or Signature</div>
							</div>
						</td>
						<td width="31%"></td>
						<td width="30%">
							<div class="block-signature">
								<div class="box"></div>
								<div>___________________________</div>
								<div>Authorize's Signaturee</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<footer class="print-footer">
				<img src="/images/quotations/2.png" alt="...">
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
