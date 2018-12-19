<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\userRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;
use Auth;
use Image;
use File;

class usersController extends Controller
{

	private $date;
	private $path;

	public function __construct()
	{
		// Define Upload Image Path
		$this->path=public_path().'/images/user/';
		$this->data=[
			'm'=>'manage_users',
			'sm'=>'users',
			'title'=>'អ្នកប្រើប្រាស់',
      // Notification Appointments
			'appNotify' => new Users(),
		];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-user-friends"></i> អ្នកប្រើប្រាស់</li>',

			// Select Data From Table
			'users' => Users::orderBy('user_role_id', 'desc')->get(),
		];
		return view('users.index',$this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('users.index') .'"><i class="fa fa-user-friends"></i> អ្នកប្រើប្រាស់</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
		];
		return view('users.create',$this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $r
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
			'confirm_password' => 'required_with:password|same:password|min:6',
			'position' => 'required',
			'salary' => 'required',
			'gender' => 'required',
			'phone' => 'required',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		// Insert to Table
		$user = new users;
		$user->name = $r->name;
		$user->email = $r->email;
		$user->password = Hash::make($r->password);
		$user->position = $r->position;
		$user->salary = $r->salary;
		$user->gender = $r->gender;
		$user->phone = $r->phone;
		$user->description = $r->description;
		$user->save();

		// Redirect
		return redirect()->route('users.index')
			->with('success', 'អ្នកប្រើប្រាស់បានបញ្ចូលដោយជោគជ័យ: ' . $r->name);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Users  $users
	 * @return \Illuminate\Http\Response
	 */
	public function show(Users $users)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Users  $users
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Users $users, $id)
	{
		$this->data+=[
			'user' => Users::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('users.index') .'"><i class="fa fa-user-friends"></i> អ្នកប្រើប្រាស់</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Users::find($id)->name.'</li>',
		];
		return view('users.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $r
	 * @param  \App\Models\Users  $users
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, Users $users, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'name' => 'required',
			'phone' => 'required',
			'gender' => 'required',
			'position' => 'required',
			'salary' => 'required',
			'email' => 'required|email',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Update Item
		$user = Users::find($id);
		$user->name = $r->name;
		$user->email = $r->email;
		$user->salary = $r->salary;
		$user->gender = $r->gender;
		$user->position = $r->position;
		$user->phone = $r->phone;
		$user->description = $r->description;
		$user->save();
		// redirect
		return redirect()->route('users.index')
			->with('success', 'អ្នកប្រើប្រាស់បានកែប្រែដោយជោគជ័យ៖ ' . $r->name);
	}

	public function image(Users $users, $id)
	{
    $this->data+=[
			// Select Data From Table
      'user' => Users::find($id),
      'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('users.index') .'"><i class="fa fa-user-friends"></i> អ្នកប្រើប្រាស់</a></li><li class="active"><i class="fa fa-image"></i> កែប្រែរូបភាព៖ '. Users::find($id)->name.'</li>',
    ];
    return view('users.image',$this->data);
	}

	public function image_update(Request $r, Users $users, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'user_image' => 'required|image|max:2048',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// $user_image;
		$image = $r->file('user_image');
		if ($image->extension()=='png') {
			$user_image=time().'_'.$id.'.png';
			Image::make($image->getRealPath())->save($this->path.$user_image);
		}else{
			$user_image=time().'_'.$id.'.jpg';
			Image::make($image->getRealPath())->save($this->path.$user_image);
		}
		// Update Item
		$user = Users::find($id);
		$old_user_image = $user->image;
		$user->image = $user_image;
		$user->save();

		if ($old_user_image!='default_user.png') {
			File::delete($this->path.$old_user_image);
		}
		// redirect
		return redirect()->route('users.index')
			->with('success', 'អ្នកប្រើប្រាស់បានកែប្រែដោយជោគជ័យ៖ ' . $r->name);
	}

	public function password(Users $users, $id)
	{
		$this->data+=[
			'user' => Users::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('users.index') .'"><i class="fa fa-user-friends"></i> អ្នកប្រើប្រាស់</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Users::find($id)->name.'</li>',
		];
		return view('users.password',$this->data);
	}

	public function password_update(Request $r, Users $users, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'password' => 'required|min:6',
			'confirm_password' => 'required_with:password|same:password|min:6',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Update Item
		$user = Users::find($id);
		$user->password = Hash::make($r->password);
		$user->save();
		// redirect
		return redirect()->route('users.index')
			->with('success', 'អ្នកប្រើប្រាស់បានកែប្រែដោយជោគជ័យ៖ ' . $r->name);
	}

	public function status(Request $r, Users $users, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'status' => 'required',
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Update Item
		$user = Users::find($id);
		$name = $user->name;
		$user->status = $r->status;
		$user->save();
		// redirect
		return redirect()->route('users.index')
			->with('success', 'ដំណើរការគណនីបានកែប្រែដោយជោគជ័យ៖ ' . $name);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Users  $users
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Users $users, $id)
	{
		// delete
		$user = Users::find($id);
		$name = $user->name;
		$image = $user->image;
		$user->delete();
		if ($image!='default_user.png') {
			File::delete($this->path.$image);
		}
		// redirect
		return redirect()->route('users.index')
			->with('success', 'អ្នកប្រើប្រាស់បានលុបចោលដោយជោគជ័យ៖ '. $name);
	}
}
