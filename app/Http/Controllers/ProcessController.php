<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Services;
use App\Models\Users;
use Illuminate\Http\Request;
use Validator;
use Auth;

class ProcessController extends Controller
{
	
	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '26';
		$this->data=[
			'title'=>'ដំណើរការការងារ',
			'm'=>'services',
			'sm'=>$this->module,
			// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-clipboard-check"></i> ដំណើរការការងារ</li>',

			// Select Data From Table
			'processes' => Process::orderBy('pr_name', 'asc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('process.index',$this->data) : view('errors.permission',$this->data) );
	}


	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('services.index') .'"><i class="fa fa-clipboard-check"></i> ដំណើរការការងារ</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'services' => Services::orderBy('s_name', 'asc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('process.create',$this->data) : view('errors.permission',$this->data) );
	}


	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'pr_name' => 'required',
			'pr_service_id' => 'required',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$process = new Process;
			$process->pr_name = $r->pr_name;
			$process->pr_service_id = $r->pr_service_id;
			$process->pr_description = $r->pr_description;
			$process->created_by = Auth::id();
			$process->updated_by = Auth::id();
			$process->save();

			// Redirect
			return redirect()->route('process.index')
				->with('success', 'ដំណើរការការងារបានបញ្ចូលដោយជោគជ័យ: ' . $r->pr_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function show(Process $process)
	{
		//
	}


	public function edit($id)
	{
		$this->data+=[
			'process' => Process::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('process.index') .'"><i class="fa fa-clipboard-check"></i> ដំណើរការការងារ</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Process::find($id)->pr_name.'</li>',
			// Select Data From Table
			'services' => Services::orderBy('s_name', 'asc')->get(),
		];
		return (($this->globalNotitfy->permission($this->module)=='true')? view('process.edit',$this->data) : view('errors.permission',$this->data) );
	}


	public function update(Request $r, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'pr_name' => 'required',
			'pr_service_id' => 'required',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update Item
			$process = Process::find($id);
			$process->pr_name = $r->pr_name;
			$process->pr_service_id = $r->pr_service_id;
			$process->pr_description = $r->pr_description;
			$process->created_by = Auth::id();
			$process->updated_by = Auth::id();
			$process->save();

	    // redirect
			return redirect()->route('process.index')
				->with('success', 'ដំណើរការការងារបានកែប្រែដោយជោគជ័យ៖ ' . $r->pr_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
	
	public function destroy($id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete
	    $process = Process::find($id);
	    $pr_name = $process->pr_name;
	    $process->delete();
	    // redirect
			return redirect()->route('process.index')
				->with('success', 'ដំណើរការការងារបានលុបចោលដោយជោគជ័យ៖ '. $pr_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
