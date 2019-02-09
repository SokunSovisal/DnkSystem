<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Transaction_Process;
use App\Models\Checklist;
use App\Models\Transaction_Checklist;
use App\Models\Transactions;
use App\Models\Users;
use App\Models\Services;
use App\Models\Companies;
use App\Models\Invoice;
use App\Models\invoice_detail;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Form;

class projectProcessController extends Controller
{
	
	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '27';
		$this->data=[
			'title'=>'ដំណើរការគម្រោង',
			'm'=>'projectprocess',
			'sm'=>$this->module,
			// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}


	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-project-diagram"></i> ដំណើរការគម្រោង</li>',

			// Select Data From Table
			'transactions' => Transactions::orderBy('tr_start_date', 'desc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('projectprocess.index',$this->data) : view('errors.permission',$this->data) );
	}


	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('projectprocess.index') .'"><i class="fa fa-project-diagram"></i> ដំណើរការគម្រោង</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			'services' => Services::orderBy('s_name', 'asc')->get(),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'invoices' => Invoice::orderBy('inv_number', 'desc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('projectprocess.create',$this->data) : view('errors.permission',$this->data) );
	}


	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'tr_start_date' => 'required|date',
			'tr_date_alert' => 'required|date',
			'tr_company_id' => 'required',
			'tr_service_id' => 'required',
			'tr_date_count' => 'required',
			'tr_verify_by' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$transaction = new Transactions;
			$transaction->tr_start_date = $r->tr_start_date;
			$transaction->tr_date_count = $r->tr_date_count;
			$transaction->tr_date_alert = $r->tr_date_alert;
			$transaction->tr_company_id = $r->tr_company_id;
			$transaction->tr_service_id = $r->tr_service_id;
			$transaction->tr_verify_by = $r->tr_verify_by;
			$transaction->tr_invoice_id = $r->tr_invoice_id;
			$transaction->tr_description = $r->tr_description;
			$transaction->created_by = Auth::id();
			$transaction->updated_by = Auth::id();
			$transaction->save();
			// Redirect
			return redirect()->route('projectprocess.index')
				->with('success', 'គម្រោងបានបញ្ចូលដោយជោគជ័យ: ' . $transaction->service->s_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function show()
	{
		//
	}

	public function ajaxinvoice(Request $r)
	{
		$inv_id = $r->get('inv_id');
		$services = '<option value="">-- សូមជ្រើសរើស --</option>';
		$inv = Invoice::find($inv_id);

		@$myObj->inv_company_id = $inv->inv_company_id;

		$invoice_details = invoice_detail::where('invd_invoice_id',$inv_id)->get();
		foreach ($invoice_details as $key => $invd) {
			$services .= '<option value="'.$invd->invd_service_id.'">'.$invd->service->s_name.'</option>';
		}
		@$myObj->services = $services;

		@$output = json_encode(@$myObj);

		echo @$output;
	}

	public function ajaxfindtp(Request $r)
	{

    $tp = Transaction_Process::where('tp_transaction_id', $r->tr_id)
  														->where('tp_process_id', $r->pr_id)
                            	->first();
		@$myObj->form_tp = '<input type="hidden" name="tp_id" id="tp_id" value="'.$tp->id.'">
														<input type="hidden" name="pr_id" id="pr_id" value="'.$r->pr_id.'">
														<input type="hidden" name="tr_id" id="tr_id" value="'.$r->tr_id.'">
														<div class="row">
															<div class="col-sm-8">
																<div class="form-group">
																	<label class="control-label">ការបរិច្ឆេទ <small>*</small></label>
																	<div class="input-group date">
																		<input class="form-control nbr datepicker" type="text" name="tp_start_date" id="tp_start_date" placeholder="date record" autocomplete="off" required data-mask="9999-99-99" value="'.$tp->tp_start_date.'" />
																	  <span class="nbr input-group-addon">
																		  <span class="glyphicon glyphicon-calendar"></span>
																	  </span>
																	</div>
																</div>
															</div>
															<div class="col-sm-4">
																<div class="form-group text-center">
																	<label class="control-label">ជោគជ័យ</label>
													        <div class="togglebutton">
													          <label>
													            <input type="checkbox" id="tp_status" '.(($tp->tp_status==1)? 'checked':'').' name="tp_status" />
													            <span class="toggle toggle-active"></span>
													          </label>
													        </div>
																</div>
															</div>
															<div class="col-sm-12">
																
																<div class="form-group">
																	<label for="">ពណ៌នា</label>
																	<textarea class="form-control" name="tp_description" id="tp_description" placeholder="description">'.$tp->tp_description.'</textarea>
																</div>

															</div>
														</div>';
    if ($tp === null) {
    	@$myObj->submit_tp = '<button type="button" class="btn-sm btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;<span class="roboto_r">CLOSE</span></button>
  													<button type="button" class="btn-sm btn btn-success" id="submit_new_tp"><i class="fas fa-save"></i> &nbsp; រក្សាទុក</button>';
    }else{
    	@$myObj->submit_tp = '<button type="button" class="btn-sm btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;<span class="roboto_r">CLOSE</span></button>
  													<button type="button" class="btn-sm btn btn-success" id="submit_update_tp"><i class="fas fa-save"></i> &nbsp; កែប្រែ</button>';
    }

		@$output = json_encode(@$myObj);
		echo @$output;
	}

	public function ajaxtp(Request $r)
	{

		$transaction = Transactions::find($r->id);
		$processes = Process::where('pr_service_id', $transaction->tr_service_id)->get();
		foreach ($processes as $pr => $process) {
      $tp = Transaction_Process::where('tp_transaction_id', $transaction->id)
    														->where('tp_process_id', $process->id)
                              	->first();

			echo '<div class="timeline-content '.((isset($tp->tp_status) && $tp->tp_status=='1')? 'success' : '' ).'">
							<span onclick="getTpID(\''.$process->id.'\', \''.$transaction->id.'\', \''.$process->pr_name.'\')" class="timeline-step" data-toggle="modal" data-target=".bs-tp-model">'.++$pr.'</span>
							<input type="hidden" value="'.((isset($tp->tp_description))? $tp->tp_description : '' ).'" id="tp-description-'.((isset($tp->id))? $tp->id : '' ).'"/>
							<h3 class="mb-2">'.$process->pr_name.'</h3>
							<div class="label label-primary">'.((isset($tp->tp_start_date))? $tp->tp_start_date : '' ).'</div>
							<p class="mt-2">'.((isset($tp->tp_description))? $tp->tp_description : 'មិនទាន់បានកត់ចំណាំនៅឡើយ' ).'</p> 
						</div>';
		}
	}
	public function ajaxstoretp(Request $r)
	{
		// Insert to Table
		$tp = new Transaction_Process;
		$tp->tp_start_date = $r->tp_start_date;
		$tp->tp_description = $r->tp_description;
		$tp->tp_status = $r->tp_status;
		$tp->tp_transaction_id = $r->tr_id;
		$tp->tp_process_id = $r->pr_id;
		$tp->created_by = Auth::id();
		$tp->updated_by = Auth::id();
		$tp->save();

		echo 'ជោគជ័យ';
	}
	
	public function ajaxupdatetp(Request $r)
	{
		// echo $r->tp_id;
		// Insert to Table
		$tp = Transaction_Process::find($r->tp_id);
		$tp->tp_start_date = $r->tp_start_date;
		$tp->tp_description = $r->tp_description;
		$tp->tp_status = $r->tp_status;
		$tp->tp_transaction_id = $r->tr_id;
		$tp->tp_process_id = $r->pr_id;
		$tp->updated_by = Auth::id();
		$tp->save();

		echo 'ជោគជ័យ';
	}

	public function edit($id)
	{
		$this->data+=[
			'transaction' => Transactions::find($id),
			'services' => Services::orderBy('s_name', 'asc')->get(),
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
			'invoices' => Invoice::orderBy('inv_number', 'asc')->get(),
			'users' => Users::orderBy('name', 'asc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('receipts.index') .'"><i class="fa fa-project-diagram"></i> ដំណើរការគម្រោង</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Transactions::find($id)->service->s_name.'</li>',
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('projectprocess.edit',$this->data) : view('errors.permission',$this->data) );
	}

	public function update(Request $r, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'tr_start_date' => 'required|date',
			'tr_date_alert' => 'required|date',
			'tr_date_count' => 'required',
			'tr_company_id' => 'required',
			'tr_service_id' => 'required',
			'tr_verify_by' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$transaction = Transactions::find($id);
			$transaction->tr_start_date = $r->tr_start_date;
			$transaction->tr_date_alert = $r->tr_date_alert;
			$transaction->tr_date_count = $r->tr_date_count;
			$transaction->tr_company_id = $r->tr_company_id;
			$transaction->tr_service_id = $r->tr_service_id;
			$transaction->tr_verify_by = $r->tr_verify_by;
			$transaction->tr_invoice_id = $r->tr_invoice_id;
			$transaction->tr_description = $r->tr_description;
			$transaction->created_by = Auth::id();
			$transaction->updated_by = Auth::id();
			$transaction->save();
			// Redirect
			return redirect()->route('projectprocess.index')
				->with('success', 'គម្រោងបានកែប្រែដោយជោគជ័យ: ' . $transaction->service->s_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function destroy($id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
			$transaction = Transactions::find($id);
			$tr_start_date = $transaction->tr_start_date;
			$transaction->delete();

			// redirect
			return redirect()->route('projectprocess.index')
				->with('success', 'គម្រោងបានលុបចោលដោយជោគជ័យ៖ '. $tr_start_date);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
