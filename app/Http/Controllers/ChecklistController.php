<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Users;
use App\Models\Services;
use Illuminate\Http\Request;
use Validator;
use Auth;

class ChecklistController extends Controller
{
	
	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '25';
		$this->data=[
			'title'=>'ឯកសារតម្រូវ',
			'm'=>'services',
			'sm'=>$this->module,
			// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-clipboard-check"></i> ឯកសារតម្រូវ</li>',

			// Select Data From Table
			'checklists' => Checklist::orderBy('ch_name', 'asc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('checklist.index',$this->data) : view('errors.permission',$this->data) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('services.index') .'"><i class="fa fa-clipboard-check"></i> ឯកសារតម្រូវ</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'services' => Services::orderBy('s_name', 'asc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('checklist.create',$this->data) : view('errors.permission',$this->data) );
	}


	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'ch_name' => 'required',
			'ch_service_id' => 'required',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$checklist = new Checklist;
			$checklist->ch_name = $r->ch_name;
			$checklist->ch_service_id = $r->ch_service_id;
			$checklist->ch_description = $r->ch_description;
			$checklist->created_by = Auth::id();
			$checklist->updated_by = Auth::id();
			$checklist->save();

			// Redirect
			return redirect()->route('checklist.index')
				->with('success', 'ឯកសារតម្រូវបានបញ្ចូលដោយជោគជ័យ: ' . $r->ch_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function show(Checklist $checklist)
	{
		//
	}


	public function edit($id)
	{
		$this->data+=[
			'checklist' => Checklist::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('checklist.index') .'"><i class="fa fa-clipboard-check"></i> ឯកសារតម្រូវ</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Checklist::find($id)->ch_name.'</li>',
			// Select Data From Table
			'services' => Services::orderBy('s_name', 'asc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('checklist.edit',$this->data) : view('errors.permission',$this->data) );
	}


	public function update(Request $r, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'ch_name' => 'required',
			'ch_service_id' => 'required',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update Item
			$checklist = Checklist::find($id);
			$checklist->ch_name = $r->ch_name;
			$checklist->ch_service_id = $r->ch_service_id;
			$checklist->ch_description = $r->ch_description;
			$checklist->created_by = Auth::id();
			$checklist->updated_by = Auth::id();
			$checklist->save();

	    // redirect
			return redirect()->route('checklist.index')
				->with('success', 'ឯកសារតម្រូវបានកែប្រែដោយជោគជ័យ៖ ' . $r->ch_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function destroy($id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
	    $checklist = Checklist::find($id);
	    $ch_name = $checklist->ch_name;
	    $checklist->delete();
	    // redirect
			return redirect()->route('checklist.index')
				->with('success', 'ឯកសារតម្រូវបានលុបចោលដោយជោគជ័យ៖ '. $ch_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
