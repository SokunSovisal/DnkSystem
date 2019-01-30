<?php

namespace App\Http\Controllers;

use App\Models\user_roles;
use App\Models\Users;
use App\Models\permissions;
use App\Models\modules;
use Illuminate\Http\Request;
use Validator;

class userRolesController extends Controller
{
	private $globalNotitfy;
	private $module;
	
	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '20';
		$this->data=[
			'm'=>'manage_users',
			'sm'=>$this->module,
			'title'=>'កំណត់ឋានៈ',
	  	// Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

	
	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-user-cog"></i> កំណត់ឋានៈ</li>',

			// Select Data From Table
			'roles' => user_roles::orderBy('id', 'asc')->get(),
		];
		// return view('roles.index',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('roles.index',$this->data) : view('errors.permission',$this->data) );
	}


	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('roles.index') .'"><i class="fa fa-user-cog"></i> កំណត់ឋានៈ</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
		];
		// return view('roles.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('roles.create',$this->data) : view('errors.permission',$this->data) );
	}


	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'ur_name' => 'required|unique:user_roles',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Insert to Table
			$role = new user_roles;
			$role->ur_name = $r->ur_name;
			$role->ur_description = $r->ur_description;
			$role->save();
			// echo $role->id .'<br/>';

			// $ur_id = $role->id;

			// $modules = modules::orderBy('id', 'asc')->get();
			// foreach ($modules as $key => $module) {
			// 	// $role->id
			// 	$permission = new permissions;
			// 	$permission->p_module = $module->m_url;
			// 	$permission->p_role_id = $ur_id;
			// 	$permission->save();
			// }
			// Redirect
			return redirect()->route('roles.index')
				->with('success', 'សេវាកម្មធំបានបញ្ចូលដោយជោគជ័យ: ' . $r->ur_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function show(user_roles $user_roles)
	{
		//
	}


	public function edit(user_roles $user_roles)
	{
		$this->data+=[
			'roles' => user_roles::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('roles.index') .'"><i class="fa fa-user-cog"></i> កំណត់ឋានៈ</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. user_roles::find($id)->ur_name.'</li>',
		];
		// return view('roles.create',$this->data);
		return (($this->globalNotitfy->permission($this->module)=='true')? view('roles.edit',$this->data) : view('errors.permission',$this->data) );
	}


	public function update(Request $r, user_roles $user_roles, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'ur_name' => 'required|unique:user_roles,ur_name,'.$id,
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// Update Item
			$role = user_roles::find($id);
			$role->ur_name = $r->ur_name;
			$role->ur_description = $r->ur_description;
			$role->save();
	    // redirect
			return redirect()->route('roles.index')
				->with('success', 'សេវាកម្មធំបានកែប្រែដោយជោគជ័យ៖ ' . $r->ur_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}


	public function destroy(user_roles $user_roles, $id)
	{
		if ($this->globalNotitfy->permission($this->module)=='true') {
			// delete Main service
	    $role = user_roles::find($id);
	    $ur_name = $role->ur_name;
	    $role->delete();
	    // redirect
			return redirect()->route('roles.index')
				->with('success', 'សេវាកម្មធំបានលុបចោលដោយជោគជ័យ៖ '. $ur_name);
		}else{
			return redirect(route('errors.permission'));
		}
	}
}
