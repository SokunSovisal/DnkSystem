<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class AlertManagementController extends Controller
{


	private $globalNotitfy;
	private $module;

	public function __construct()
	{
		$this->globalNotitfy = new Users();
		$this->module = '19';
		// Define Upload Image Path
		$this->path=public_path().'/images/user/';
		$this->data=[
			'm'=>'manage_users',
			'sm'=>$this->module,
			'title'=>'អ្នកប្រើប្រាស់',
      // Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}


  public function index()
  {
  	echo "string";
  }
}
