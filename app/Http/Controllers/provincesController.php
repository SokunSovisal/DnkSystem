<?php

namespace App\Http\Controllers;

use App\Models\Provinces;
use App\Models\Users;
use Illuminate\Http\Request;
use Validator;
use DB;

class provincesController extends Controller
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
			'm'=>'manage_location',
			'sm'=>'provinces',
			'title'=>'ទីតាំងខេត្ត',
      // Notification Appointments
			'appNotify' => new Users(),
		];
	}
	
	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-location-arrow"></i> ទីតាំងខេត្ត</li>',

			// Select Data From Table
			'provinces' => Provinces::orderBy('pro_description', 'asc')->get(),
		];
		return view('provinces.index',$this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data+=[
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('provinces.index') .'"><i class="fa fa-location-arrow"></i> ទីតាំងខេត្ត</a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
		];
		return view('provinces.create',$this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $r)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'pro_name' => 'required|unique:provinces',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		// Insert to Table
		$provinces = new Provinces;
		$provinces->pro_name = $r->pro_name;
		$provinces->pro_description = $r->pro_description;
		$provinces->save();

		// Redirect
		return redirect()->route('provinces.index')
			->with('success', 'ទីតាំងខេត្តបានបញ្ចូលដោយជោគជ័យ: ' . $r->pro_name);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\provinces  $provinces
	 * @return \Illuminate\Http\Response
	 */
	public function show(provinces $provinces)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\provinces  $provinces
	 * @return \Illuminate\Http\Response
	 */
	public function edit(provinces $provinces, $id)
	{
		$this->data+=[
			'pro' => Provinces::find($id),
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('provinces.index') .'"><i class="fa fa-location-arrow"></i> ទីតាំងខេត្ត</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Provinces::find($id)->pro_name.'</li>',
		];
		return view('provinces.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\provinces  $provinces
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, provinces $provinces, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'pro_name' => 'required|unique:provinces,pro_name,'.$id,
		]);
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		// Update Item
		$provinces = Provinces::find($id);
		$provinces->pro_name = $r->pro_name;
		$provinces->pro_description = $r->pro_description;
		$provinces->save();

    // redirect
		return redirect()->route('provinces.index')
			->with('success', 'ទីតាំងខេត្តបានកែប្រែដោយជោគជ័យ៖ ' . $r->pro_name);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\provinces  $provinces
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(provinces $provinces, $id)
	{
		// delete
    $ms = Provinces::find($id);
    $pro_name = $ms->pro_name;
    $ms->delete();

    // redirect
		return redirect()->route('provinces.index')
			->with('success', 'ទីតាំងខេត្តបានលុបចោលដោយជោគជ័យ៖ '. $pro_name);
	}
}
