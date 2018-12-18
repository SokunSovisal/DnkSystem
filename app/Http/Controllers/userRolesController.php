<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\userRoles;
use Illuminate\Http\Request;
use DB;
use Validator;

class userRolesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	private $date;

	public function __construct()
	{
  	$today = date("Y-m-d", time());
  	$timeNow = date("h:i:s", time());

		$this->data=[
			'm'=>'manage_users',
			'sm'=>'user_roles',
			'title'=>'កំណត់ឋានៈ',
      // Notification Appointments
      'app_alert' => DB::table('appointments')
                          ->whereDate('app_datetime','<=', $today)
                          ->whereTime('app_datetime', '<=', $timeNow)
                          ->where('app_status',1)
                          ->get(),
		];
	}

	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-user-cog"></i> កំណត់ឋានៈ</li>',

			// Select Data From Table
			'users' => Users::orderBy('user_role_id', 'desc')->get(),
		];
		return view('roles.index',$this->data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\users  $users
	 * @return \Illuminate\Http\Response
	 */
	public function edit(users $users,$id)
	{
		$this->data+=[
			'user' => Users::find($id),
			'roles' => userRoles::orderBy('id', 'asc')->get(),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('roles.index') .'"><i class="fa fa-user-cog"></i> កំណត់ឋានៈ</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Users::find($id)->name.'</li>',
		];
		return view('roles.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\users  $users
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, users $users, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'user_role_id' => 'required',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		// Update Item
		$roles = Users::find($id);
		$roles->user_role_id = $r->user_role_id;
		$roles->save();

	// redirect
		return redirect()->route('roles.index')
			->with('success', 'ឋានៈបានកែប្រែដោយជោគជ័យ៖ ' . $r->name);
	}
}
