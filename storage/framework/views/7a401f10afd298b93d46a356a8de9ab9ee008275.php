<?php $__env->startSection('css'); ?>
	<style type="text/css">

	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ចំណូលក្នុង <span class="show_monthly roboto_r"></span></h4>
      </div>
      <div class="modal-body">
				<?php echo e(csrf_field()); ?>

        <input type="hidden" id="getmonthyear" />
        <div id="table">
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-sm btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;<span class="roboto_r">CLOSE</span></button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>

	<section class="bg-white">
		<div id="search-section" class="mt-3 mb-1">
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
	        	<button type="button" id="search_report" class="btn btn-success btn-block nbr"><i class="fa fa-search"></i> &nbsp;ស្វែងរក</button>
	        </div>
				</div>
			</div>
		</div>
		<div id="table-section">
			<table class="table table-striped table-hover" id="dataTable_pl">
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
					<?php echo $tbody; ?>

				</tbody>
				<tfoot class="roboto_r" id="tfoot">
					<?php echo $tfoot; ?>

				</tfoot>
			</table>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">

		function total_tfoot() {
    	if ($('#tbody > tr > td.dataTables_empty').length > 0) {
				console.log('No');
				var total_income = 0;
				var total_expense = 0;
				var total_profitloss = 0;
				var total_rec_balance = 0;
				var total_pt_amount = 0;
				$('#tfoot > tr > td#total_income span.value').html(numberWithCommas(parseFloat(total_income).toFixed(2)));
				$('#tfoot > tr > td#total_expense span.value').html(numberWithCommas(parseFloat(total_expense).toFixed(2)));
				$('#tfoot > tr > td#total_profitloss span.value').html(numberWithCommas(parseFloat(total_profitloss).toFixed(2)));
				$('#tfoot > tr > td#total_rec_balance span.value').html(numberWithCommas(parseFloat(total_rec_balance).toFixed(2)));
				$('#tfoot > tr > td#total_pt_amount span.value').html(numberWithCommas(parseFloat(total_pt_amount).toFixed(2)));
    	}else{
				console.log('Hello');
				var total_income = 0;
				var total_expense = 0;
				var total_profitloss = 0;
				var total_rec_balance = 0;
				var total_pt_amount = 0;
	    	for (var i = 1; i <= $('#tbody > tr').length; i++) {
	    		total_income += parseFloat($('#tbody > tr:nth-child('+i+')').find('td:nth-child(4)').data('value'));
	    		total_expense += parseFloat($('#tbody > tr:nth-child('+i+')').find('td:nth-child(5)').data('value'));
	    		total_profitloss += parseFloat($('#tbody > tr:nth-child('+i+')').find('td:nth-child(6)').data('value'));
	    		total_rec_balance += parseFloat($('#tbody > tr:nth-child('+i+')').find('td:nth-child(7)').data('value'));
	    		total_pt_amount += parseFloat($('#tbody > tr:nth-child('+i+')').find('td:nth-child(8)').data('value'));
	    	}
				$('#tfoot > tr > td#total_income span.value').html(numberWithCommas(parseFloat(total_income).toFixed(2)));
				$('#tfoot > tr > td#total_expense span.value').html(numberWithCommas(parseFloat(total_expense).toFixed(2)));
				$('#tfoot > tr > td#total_profitloss span.value').html(numberWithCommas(parseFloat(total_profitloss).toFixed(2)));
				$('#tfoot > tr > td#total_rec_balance span.value').html(numberWithCommas(parseFloat(total_rec_balance).toFixed(2)));
				$('#tfoot > tr > td#total_pt_amount span.value').html(numberWithCommas(parseFloat(total_pt_amount).toFixed(2)));
    	}
    }

    $('#dataTable_pl').DataTable( {
        "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
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
    } );



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

		$('#search_report').click(function () {
			// alert('asdf');
			if ($('#monthpickerstart').val()!='' && $('#monthpickerend').val()!='') {
				var monthpickerend = $('#monthpickerend').val();
				var monthpickerstart = $('#monthpickerstart').val();
 				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "<?php echo e(route('profitloss.search')); ?>",
					type: 'post',
					data: {monthpickerstart:monthpickerstart, monthpickerend:monthpickerend, _token:_token},
					success: function(dataReturn){
						$('#table-section').html(dataReturn);
				    $('#dataTable_pl').DataTable( {
				        "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
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
    				$('input[type="search"]').keyup(total_tfoot);
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

    $('input[type="search"]').keyup(total_tfoot);


	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>