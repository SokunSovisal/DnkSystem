<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Companies;
use App\Models\Services;
use App\Models\Users;
use App\Models\User;
use DB;


class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	private $date;

	public function __construct()
	{
		$this->middleware('auth');
		$this->data=[
			'breadcrumb'=>'<li class="active"><i class="fa fa-home"></i> ផ្ទាំងដើម</li>',
			'title'=>'Welcome',
			'm'=>'home',
			'sm'=>'home',
			// Notification Appointments
			'appNotify' => new Users(),

			// Select Data From Table
			'companies' => Companies::all(),
			'services' => Services::all(),
			'users' => User::all(),
		];
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('dashboard',$this->data);
	}


	public function dashboard()
	{
		return view('dashboard',$this->data);
	}
}
