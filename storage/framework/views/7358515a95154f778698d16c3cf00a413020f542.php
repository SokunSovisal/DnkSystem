<?php $__env->startSection('css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<!-- Large modal -->
	<div class="modal fade modal-view-payment" tabindex="-1" role="dialog" aria-labelledby="viewReceiptModalLabel">
	  <div class="modal-dialog" role="document" style="width: 80%;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">វិក្កយបត្រ: <span class="show_bill roboto_r"></span></h4>
	      </div>
	      <div class="modal-body" style="min-height: 73vh;">
	        <input type="hidden" id="getinvoice" />
	        <div id="table_payment" class="vs-datatable">
	        	
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
	            <input type='text' class="form-control" id="monthpickerstart" placeholder="ជ្រើសរើសខែចាប់ផ្ដើម" autocomplete="off" required />
	            <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	          </div>
	        </div>
				</div>
				<div class="col-sm-4">
	        <div class="form-group">
	          <div class='input-group'>
	            <input type='text' class="form-control" id="monthpickerend" placeholder="ជ្រើសរើសខែបញ្ចប់" autocomplete="off" required />
	            <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	            </span>
	          </div>
	        </div>
				</div>
				<div class="col-sm-2">
	        <div class="form-group">
	        	<button type="button" id="search_report" class="btn-sm btn btn-success btn-block"><i class="fa fa-search"></i> &nbsp;ស្វែងរក</button>
	        </div>
				</div>
			</div>
		</div>
		<br/>
		<div id="table-section">
			<table class="table table-striped table-hover" id="dataTable_income">
				<thead>
					<tr>
						<th width="5%">N&deg;</th>
						<th width="15%">ការបរិច្ឆេទ</th>
						<th width="15%">លេខវិក្កយបត្រ</th>
						<th>ប្រាក់សរុប</th>
						<th>ប្រាក់បានបង់</th>
						<th>ប្រាក់នៅសល់</th>
						<th width="10%" class="text-center">សកម្មភាព</th>
					</tr>
				</thead>
				<tbody id="tbody">
					<?php echo $tbody; ?>

				</tbody>
				<tfoot id="tfoot">
					<?php echo $tfoot; ?>

				</tfoot>
			</table>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		$('#dataTable_income').DataTable({
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
			if ($('#monthpickerstart').val()!='' && $('#monthpickerend').val()!='') {
				var monthpickerend = $('#monthpickerend').val();
				var monthpickerstart = $('#monthpickerstart').val();
 				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "<?php echo e(route('APReport.search')); ?>",
					type: 'post',
					data: {monthpickerstart:monthpickerstart, monthpickerend:monthpickerend, _token:_token},
					success: function(dataReturn){
						$('#table-section').html(dataReturn);
						$('#dataTable_income').DataTable();
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

		function getBill(br_num, id) {
			$('.show_bill').html(br_num);
			var br_id = id;
			var _token = $('input[name="_token"]').val();
			// alert(id);
			$.ajax({
				url: "<?php echo e(route('APReport.payments')); ?>",
				type: 'post',
				data: {br_id:br_id, _token:_token},
				success: function(result){
					// alert(result);
					$('#table_payment').html(result);
					$('#dataTable_payment').DataTable({
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
		}

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>