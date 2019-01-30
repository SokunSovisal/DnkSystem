@extends('layouts.app')

@section('css')
	<style type="text/css">
		#tbody:not(i){
			font-family: 'roboto_r';
		}
		#tfoot:not(i){
			font-family: 'roboto_r';
		}
		.btn:not(i){
			font-family: 'roboto_r';
		}
	</style>
@endsection

@section('content')
<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ចំណូលក្នុង <span class="show_monthly roboto_r"></span></h4>
      </div>
      <div class="modal-body">
				{{ csrf_field() }}
        <input type="hidden" id="getmonthyear" />
        <div id="invoice_table" class="vs-datatable">
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;<span class="roboto_r">CLOSE</span></button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>

<!-- Large modal -->
<div class="modal fade modal-view-receipt" tabindex="-1" role="dialog" aria-labelledby="viewReceiptModalLabel">
  <div class="modal-dialog" role="document" style="width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">វិក្កយបត្រ: <span class="show_invoice roboto_r"></span></h4>
      </div>
      <div class="modal-body" style="min-height: 73vh;">
        <input type="hidden" id="getinvoice" />
        <div id="table_receipt" class="vs-datatable">
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;<span class="roboto_r">CLOSE</span></button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>

	<section class="bg-white">
		<br/>
		<div id="search-section">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
	        <div class="form-group">
	          <div class='input-group'>
	            <input type='text' class="form-control nbr" id="monthpickerstart" placeholder="ជ្រើសរើសខែចាប់ផ្ដើម" autocomplete="off" required />
	            <span class="input-group-addon nbr">
	              <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	          </div>
	        </div>
				</div>
				<div class="col-sm-4">
	        <div class="form-group">
	          <div class='input-group'>
	            <input type='text' class="form-control nbr" id="monthpickerend" placeholder="ជ្រើសរើសខែបញ្ចប់" autocomplete="off" required />
	            <span class="input-group-addon nbr">
	              <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	          </div>
	        </div>
				</div>
				<div class="col-sm-2">
	        <div class="form-group">
	        	<button type="button" id="search_report" class="btn-sm btn btn-success btn-block nbr"><i class="fa fa-search"></i> &nbsp;ស្វែងរក</button>
	        </div>
				</div>
			</div>
		</div>
		<br/>
		<div id="table-section" class="vs-datatable">
			<table class="table table-striped table-hover" id="dataTable_income">
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
					{!! $tbody !!}
				</tbody>
				<tfoot id="tfoot">
					{!! $tfoot !!}
				</tfoot>
			</table>
		</div>
	</section>
@endsection

@section('js')
	<script type="text/javascript">

    $('#dataTable_income').DataTable( {
	    "fnDrawCallback": function( oSettings ) {
				$('input[type="search"]').keyup( total_tfoot );
	    },
      "language": {
		    "decimal":        "",
		    "emptyTable":     "ពុំមានទិន្នន័យឡើយ",
		    "info":           "បង្ហាញ _START_ ដល់ _END_ នៃ _TOTAL_ ជួរ",
		    "infoEmpty":      "បង្ហាញ 0 ដល់ 0 នៃ 0 ជួរ",
		    "infoFiltered":   "(filtered ពី _MAX_ សរុប ជួរ)",
		    "infoPostFix":    "",
		    "thousands":      ",",
		    "lengthMenu":     "បង្ហាញ _MENU_ ជួរ",
		    "loadingRecords": "កំពុងដំណើរការ...",
		    "processing":     "កំពុងដំណើរការ...",
		    "search":         "ស្វែងរក:",
		    "zeroRecords":    "ពុំមានទិន្នន័យឡើយ",
		    "paginate": {
		        "first":      "ដំបូង",
		        "last":       "ចុងក្រោយ",
		        "next":       "បន្ទាប់",
		        "previous":   "ថយ"
		        }
    	}
	  });

		function total_tfoot() {
    	if ($('#tbody > tr > td.dataTables_empty').length > 0) {
				// console.log('No');
				var inv_ytotal = 0;
				var rec_received_total = 0;
				var balance_total = 0;
				$('#tfoot > tr > td#inv_ytotal span.value').html(numberWithCommas(parseFloat(inv_ytotal).toFixed(2)));
				$('#tfoot > tr > td#rec_received_total span.value').html(numberWithCommas(parseFloat(rec_received_total).toFixed(2)));
				$('#tfoot > tr > td#balance_total span.value').html(numberWithCommas(parseFloat(balance_total).toFixed(2)));
    	}else{
				var inv_ytotal = 0;
				var rec_received_total = 0;
				var balance_total = 0;
    		var searchbox = $('input[type="search"]').val();
	    	for (var i = 1; i <= $('#tbody > tr').length; i++) {
	    		inv_ytotal += parseFloat($('#tbody > tr:nth-child('+i+')').find('td:nth-child(4)').data('value'));
	    		rec_received_total += parseFloat($('#tbody > tr:nth-child('+i+')').find('td:nth-child(5)').data('value'));
	    		balance_total += parseFloat($('#tbody > tr:nth-child('+i+')').find('td:nth-child(6)').data('value'));
	    	}
	    	if(searchbox==''){
	    		inv_ytotal = parseFloat($('#tfoot > tr > td#inv_ytotal').data('value'));
	    		rec_received_total = parseFloat($('#tfoot > tr > td#rec_received_total').data('value'));
	    		balance_total = parseFloat($('#tfoot > tr > td#balance_total').data('value'));
	    	}
				// console.log(inv_ytotal);
				$('#tfoot > tr > td#inv_ytotal span.value').html(numberWithCommas(parseFloat(inv_ytotal).toFixed(2)));
				$('#tfoot > tr > td#rec_received_total span.value').html(numberWithCommas(parseFloat(rec_received_total).toFixed(2)));
				$('#tfoot > tr > td#balance_total span.value').html(numberWithCommas(parseFloat(balance_total).toFixed(2)));
    	}
    }

    $('#monthpickerstart').datetimepicker({
        format: 'YYYY-MM'
    });
    $('#monthpickerend').datetimepicker({
        format: 'YYYY-MM',
        useCurrent: false
    });
    $("#monthpickerstart").on("dp.change", function (e) {
        $('#monthpickerend').data("DateTimePicker").minDate(e.date);
    });
    $("#monthpickerend").on("dp.change", function (e) {
        $('#monthpickerstart').data("DateTimePicker").maxDate(e.date);
    });

		function getMonth(month) {
			$('#getmonthyear').val(month);
			$('.show_monthly').html(month);
			if ($('#getmonthyear').val()!='') {
				var monthyear = $('#getmonthyear').val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('incomereport.invoices')}}",
					type: 'post',
					data: {monthyear:monthyear, _token:_token},
					success: function(result){
						$('#invoice_table').html(result);
 						$('#dataTable_invoice').DataTable();
					}
				});
			}
		}

		$('#search_report').click(function () {
			if ($('#monthpickerstart').val()!='' && $('#monthpickerend').val()!='') {
				var monthpickerend = $('#monthpickerend').val();
				var monthpickerstart = $('#monthpickerstart').val();
 				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{route('incomereport.search')}}",
					type: 'post',
					data: {monthpickerstart:monthpickerstart, monthpickerend:monthpickerend, _token:_token},
					success: function(dataReturn){
						$('#table-section').html(dataReturn);
				    $('#dataTable_income').DataTable( {
					    "fnDrawCallback": function( oSettings ) {
								$('input[type="search"]').keyup( total_tfoot );
					    },
				      "language": {
						    "decimal":        "",
						    "emptyTable":     "ពុំមានទិន្នន័យឡើយ",
						    "info":           "បង្ហាញ _START_ ដល់ _END_ នៃ _TOTAL_ ជួរ",
						    "infoEmpty":      "បង្ហាញ 0 ដល់ 0 នៃ 0 ជួរ",
						    "infoFiltered":   "(filtered ពី _MAX_ សរុប ជួរ)",
						    "infoPostFix":    "",
						    "thousands":      ",",
						    "lengthMenu":     "បង្ហាញ _MENU_ ជួរ",
						    "loadingRecords": "កំពុងដំណើរការ...",
						    "processing":     "កំពុងដំណើរការ...",
						    "search":         "ស្វែងរក:",
						    "zeroRecords":    "ពុំមានទិន្នន័យឡើយ",
						    "paginate": {
						        "first":      "ដំបូង",
						        "last":       "ចុងក្រោយ",
						        "next":       "បន្ទាប់",
						        "previous":   "ថយ"
						        }
				    	}
					  });
					}
				});
			}else{
				swal({
		      title: 'ពុំទាន់អាចស្វែករកបានឡើយ!',
		      text: 'សូមបញ្ចូលខែឆ្នាំជាមុនសិន',
		      type: "warning",
		      showConfirmButton: false,
				  timer: 2200,
				  onOpen: () => { timerInterval = setInterval(() => { }, 100)},
				  onClose: () => {clearInterval(timerInterval)}
				})
			}
		});

		function getInvoice(inv_num, id) {
			// $('#getmonthyear').val(inv_num);
			$('.show_invoice').html(inv_num);
			var inv_id = id;
			var _token = $('input[name="_token"]').val();
			// alert(id);
			$.ajax({
				url: "{{route('incomereport.receipts')}}",
				type: 'post',
				data: {inv_id:inv_id, _token:_token},
				success: function(result){
					// alert(result);
					$('#table_receipt').html(result);
					$('#dataTable_receipt').DataTable();
				}
			});
		}
    // $('input[type="search"]').keyup( total_tfoot );
	</script>
@endsection
