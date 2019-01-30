<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class ErrorController extends Controller
{
	
	private $globalNotitfy;
	

	public function __construct()
	{

		$this->globalNotitfy = new Users();

		// Define Upload Image Path
		$this->path=public_path().'/images/user/';
		$this->data=[
			'm'=>'',
			'sm'=>'',
			'title'=>'ពុំមានសិទ្ធិគ្រប់គ្រាន់ឡើយ',
      // Notification Appointments
			'appNotify' => $this->globalNotitfy->appointNotify(),
		];
	}

   public function permission()
   {
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-exclamation-triangle"></i> ពុំមានសិទ្ធិគ្រប់គ្រាន់ឡើយ</li>',
		];
		return view('errors.permission',$this->data);
   }
}
