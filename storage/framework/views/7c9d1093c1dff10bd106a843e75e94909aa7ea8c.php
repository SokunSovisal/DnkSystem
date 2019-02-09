<?php $__env->startSection('css'); ?>
<style type="text/css">
  td{ font-family: 'roboto_r'!important;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	

  <!-- Modal -->
  <div class="modal fade" id="invd" tabindex="-1" role="dialog" aria-labelledby="invdLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="invdLabel">បញ្ចូលសេវាកម្មទៅក្នុងវិក្កយបត្រ៖ <?php echo e($invoices->inv_number); ?></h4>
          <input type="hidden" name="invd_invoice_id" id="invd_invoice_id" value="<?php echo e($invoices->id); ?>"/>
        </div>
        <div class="modal-body">
          <input type="hidden" name="invd_id" id="invd_id" />
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label">រើសពីសម្រង់តម្លៃ</label>
                <select class="form-control nbr dynamic_select" id="quotations">
                  <option value="">-- ជ្រើសរើសសម្រង់តម្លៃ --</option>
                  <?php $__currentLoopData = $quotations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($quote->id); ?>" <?php echo e(($quote->id==$invoices->inv_quote_refer)?'selected':''); ?>><?php echo e($quote->quote_number); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label">សេវាកម្ម <small>*</small></label>
                <select name="invd_service_id" class="form-control nbr select2" id="invd_service_id" required>
                  <option value="">-- ជ្រើសរើសសេវាកម្ម --</option>
                  <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($service->id); ?>"><?php echo e($service->s_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">តម្លៃដើម</label>
                <input class="form-control nbr" type="text" id='invd_origin_price' placeholder="origin price" value="0" autocomplete="off" disabled="" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">កែប្រែតម្លៃ <small>*</small></label>
                <input class="form-control nbr" type="text" id='invd_price' placeholder="update price" value="0" autocomplete="off" required/>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label">ចំនួន <small>*</small></label>
                <input class="form-control nbr" type="text" id='invd_qty' placeholder="quantity" value="1" autocomplete="off" required/>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label">ព័ត៌មានលម្អិត</label>
                <textarea class="form-control nbr" type="text" id='invd_description' placeholder="service detail" autocomplete="off"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger nbr" data-dismiss="modal"><i class="fa fa-times"></i> បិទចោល</button>
          <button type="button" id="addService" class="btn btn-success nbr"><i class="fa fa-save"></i> រក្សាទុក</button>
          <button type="button" id="updateService" class="btn btn-success nbr sr-only"><i class="fa fa-save"></i> រក្សាទុក</button>
        </div>
      </div>
    </div>
  </div>
  <?php echo e(csrf_field()); ?>




	<section class="bg-white">
		<!-- Add Button & Error Message -->
    <?php $__env->startComponent('comps.btnBack'); ?>
      <?php $__env->slot('btnBack'); ?>
        <?php echo e(route('invoices.index')); ?>

      <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    &nbsp;
    <button type="button" class="btn btn-success nbr" data-toggle="modal" data-target="#invd"><i class="fa fa-plus"></i> បន្ថែមថ្មី</button>
    <br/>
    <br/>
    <table class="table table-striped table-hover" id="dataTable">
      <thead>
        <tr>
          <th width="5%">N&deg;</th>
          <th>សេវាកម្ម</th>
          <th>ពណ៌នា</th>
          <th width="10%">សកម្មភាព</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $invoice_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $invd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($i+1); ?></td>
            <td><?php echo e($invd->service->s_name); ?></td>
            <td>
              <?php echo $invd->invd_description; ?>

            </td>
            <td class="action">
              <span data-toggle="modal" data-target="#invd" style="cursor: pointer;" title="Edit" class="btn btn-sm btn-success edit" data-invdid="<?php echo e($invd->id); ?>"><i class="fa fa-pencil-alt"></i></span>
              <?php echo e(Form::open(['url'=>route('invoicedetail.destroy',$invd->id)])); ?>

                <?php echo e(Form::hidden('_method','DELETE')); ?>

                <button type="button" title="លុបសេវាកម្មពីក្នុងសម្រង់តម្លៃ" class="btn btn-sm btn-danger delete" data-text="តើអ្នកសម្រេចចិត្តច្បាស់ថាចង់លុបសេវាកម្មពីក្នុងសម្រង់តម្លៃនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="សេវាកម្មពីក្នុងសម្រង់តម្លៃត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
                </button>
                <button type="submit" class="sub_delete sr-only"></button>
              <?php echo e(Form::close()); ?>

            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script type="text/javascript">

    // CKEDITOR myEditor
    CKEDITOR.replace( 'invd_description', {
      toolbar: [
        { name: 'document', items: [ 'Source' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Undo', 'Redo' ] },
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
      ],
      height: '200'
    });
    
    // Alert Delete
    $("button.delete").click(alertYesNo);

    $(document).ready(function() {

      // Reload page After Close Modal
      $('#invd').on('hidden.bs.modal', function () {
          location.reload();
      });

      // Dynamic Select From quote
      var all_services = $('#invd_service_id').html();
      $('.dynamic_select').change(function(){
        if ($(this).val()!='') {
          var quote_id =$(this).val();
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url: "<?php echo e(route('ajax.quotationservices')); ?>",
            type: 'post',
            data: {id:quote_id, _token:_token},
            success: function(result){
              $('#invd_service_id').html(result);
            }
          });
        }else{
          $('#invd_service_id').html(all_services);
        }
      });

      // Dynamic Select From Service
      $('#invd_service_id').change(function(){
        if ($(this).val()!='') {
          var id = $(this).val();
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url: "<?php echo e(route('ajax.servicePrice')); ?>",
            type: 'post',
            data: {id:id, _token:_token},
            success: function(result){
              $('#invd_origin_price').val(result);
              $('#invd_price').val(result);
            }
          });
        }
      });

      // Ajax store Service Detail
      $('#addService').click(function(){
        if ($('#invd_service_id').val()!='' && $('#invd_qty').val()!='' && $('#invd_price').val()!='') {
          var invd_service_id = $('#invd_service_id').val();
          var invd_invoice_id = $('#invd_invoice_id').val();
          var invd_qty = $('#invd_qty').val();
          var invd_price = $('#invd_price').val();
          var invd_description = CKEDITOR.instances['invd_description'].getData();
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url: "<?php echo e(route('invoicedetail.store')); ?>",
            type: 'post',
            data: {invd_service_id:invd_service_id, invd_qty:invd_qty, invd_price:invd_price, invd_invoice_id:invd_invoice_id, invd_description:invd_description, _token:_token},
            success: function(dataReturn){

              // alert(dataReturn); 
              swal({
                title: 'បានជោគជ័យ',
                text: dataReturn,
                type: "success",
                showConfirmButton: false,
                timer: 1200,
                onOpen: () => {
                  timerInterval = setInterval(() => {
                  }, 100)
                },
                onClose: () => {
                  clearInterval(timerInterval)
                }
              })
              $('#invd_service_id').val('').trigger('change.select2');
              $('#quotations').val('');
              CKEDITOR.instances['invd_description'].setData('');
              $('#invd_qty').val('1');
              $('#invd_price').val('0');
              $('#invd_origin_price').val('0');
            }
          });
        }else{
          swal({
            title: 'ពុំទាន់អាចរក្សាទុក!',
            text: 'សូមបញ្ចូលទិន្នន័យជាមុនសិន',
            type: "warning",
            showConfirmButton: false,
            timer: 2200,
            onOpen: () => { timerInterval = setInterval(() => { }, 100)},
            onClose: () => {clearInterval(timerInterval)}
          })
        }
      });

      // Ajax Edit Service Detail
      $('.edit').click(function(){

          $('#addService').addClass('sr-only');
          $('#updateService').removeClass('sr-only');

          var invd_id = $(this).data('invdid');
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url: "/invoicedetail/"+invd_id+"/edit",
            type: 'get',
            data: {_token:_token},
            success: function(dataReturn){
              var data = dataReturn.split(";:;");
              $('#invd_service_id').val(data[0]).trigger('change.select2');
              CKEDITOR.instances['invd_description'].setData(data[1]);
              $('#invd_id').val(data[2]);
              $('#invd_price').val(data[3]);
              $('#invd_qty').val(data[4]);
            }
          });
      });

      // Ajax Update Service Detail
      $('#updateService').click(function(){
        if ($('#invd_service_id').val()!='') {
          var id = $('#invd_id').val();
          var invd_qty = $('#invd_qty').val();
          var invd_service_id = $('#invd_service_id').val();
          var invd_price = $('#invd_price').val();
          var invd_description = CKEDITOR.instances['invd_description'].getData();
          var _token = $('input[name="_token"]').val();
          var _method = 'PUT';
          $.ajax({
            url: "/invoicedetail/"+id,
            type: 'PATCH',
            data: {invd_price:invd_price, invd_qty:invd_qty, invd_service_id:invd_service_id, id:id, invd_description:invd_description, _method:_method, _token:_token},
            success: function(dataReturn){
              swal({
                title: 'បានជោគជ័យ',
                text: dataReturn,
                type: "success",
                showConfirmButton: false,
                timer: 1200,
                onOpen: () => {
                  timerInterval = setInterval(() => {
                  }, 100)
                },
                onClose: () => {
                  clearInterval(timerInterval)
                }
              })
            }
          });
        }else{
          swal({
            title: 'ពុំទាន់មានសេវាកម្ម',
            text: 'សូមបញ្ចូលសេវាកម្មជាមុនសិន',
            type: "warning",
            showConfirmButton: false,
            timer: 2200,
            onOpen: () => {
              timerInterval = setInterval(() => {
              }, 100)
            },
            onClose: () => {
              clearInterval(timerInterval)
            }
          })
        }
      });
    });

  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>