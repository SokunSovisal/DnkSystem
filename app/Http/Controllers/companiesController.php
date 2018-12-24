<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Objectives;
use App\Models\Provinces;
use App\Models\Districts;
use App\Models\Users;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Image;
use File;

class companiesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */


	private $date;
	private $path;

	public function __construct()
	{  	
		// Define Upload Image Path
		$this->path=public_path().'/images/companies/';

		$this->data=[
			'm'=>'manage_companies',
			'sm'=>'companies',
			'title'=>'ក្រុមហ៊ុន',
      // Notification Appointments
			'appNotify' => new Users(),
		];
	}

	public function index()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="far fa-building"></i> ក្រុមហ៊ុន</li>',

			// Select Data From Table
			'companies' => Companies::orderBy('com_name', 'asc')->get(),
		];
		return view('companies.index',$this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->data += [
			'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('services.index') .'"><i class="far fa-building"></i> ក្រុមហ៊ុន</li></a></li><li class="active"><i class="fa fa-plus"></i> បន្ថែមថ្មី</li>',
			// Select Data From Table
			'objectives' => Objectives::orderBy('obj_name', 'asc')->get(),
			'provinces' => Provinces::orderBy('pro_description', 'asc')->get(),
			'districts' => Districts::orderBy('dist_province_id', 'asc')->get(),
		];
		return view('companies.create',$this->data);
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
			'com_name' => 'required|unique:companies',
			'com_tax_size' => 'required',
			'com_objective_id' => 'required',
			'com_province_id' => 'required',
			'com_district_id' => 'required',
			'com_cp_name' => 'required',
			'com_cp_gender' => 'required',
			'com_cp_phone' => 'required',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		// Insert to Table
		$companies = new companies;
		$companies->com_name = $r->com_name;
		$companies->com_phone = $r->com_phone;
		$companies->com_email = $r->com_email;
		$companies->com_vat_id = $r->com_vat_id;
		$companies->com_tax_size = $r->com_tax_size;
		$companies->com_addr_map = $r->com_addr_map;
		$companies->com_addr_house = $r->com_addr_house;
		$companies->com_addr_street = $r->com_addr_street;
		$companies->com_addr_group = $r->com_addr_group;
		$companies->com_addr_village = $r->com_addr_village;
		$companies->com_addr_commune = $r->com_addr_commune;
		$companies->com_description = $r->com_description;
		$companies->com_objective_id = $r->com_objective_id;
		$companies->com_province_id = $r->com_province_id;
		$companies->com_district_id = $r->com_district_id;

		$companies->com_cp_name = $r->com_cp_name;
		$companies->com_cp_gender = $r->com_cp_gender;
		$companies->com_cp_phone = $r->com_cp_phone;
		$companies->com_cp_email = $r->com_cp_email;
		$companies->com_cp_description = $r->com_cp_description;
		$companies->com_created_by = Auth::id();
		$companies->com_updated_by = Auth::id();
		$companies->save();

		// Redirect
		return redirect()->route('companies.index')
			->with('success', 'ក្រុមហ៊ុនបានបញ្ចូលដោយជោគជ័យ: ' . $r->com_name);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Companies  $companies
	 * @return \Illuminate\Http\Response
	 */
	public function show(Companies $companies)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Companies  $companies
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Companies $companies, $id)
	{
    $this->data+=[
			// Select Data From Table
      'company' => Companies::find($id),
			'objectives' => Objectives::orderBy('obj_name', 'asc')->get(),
			'provinces' => Provinces::orderBy('pro_description', 'asc')->get(),
			'districts' => Districts::orderBy('dist_province_id', 'asc')->get(),
      'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('companies.index') .'"><i class="fa fa-heart"></i> ក្រុមហ៊ុន</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែ៖ '. Companies::find($id)->com_name.'</li>',
    ];
    return view('companies.edit',$this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Companies  $companies
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, Companies $companies, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'com_name' => 'required|unique:companies,com_name,'.$id,
			'com_tax_size' => 'required',
			'com_objective_id' => 'required',
			'com_province_id' => 'required',
			'com_district_id' => 'required',
			'com_cp_name' => 'required',
			'com_cp_gender' => 'required',
			'com_cp_phone' => 'required',
		]);
		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// Update Item
		$companies = Companies::find($id);
		$companies->com_name = $r->com_name;
		$companies->com_phone = $r->com_phone;
		$companies->com_email = $r->com_email;
		$companies->com_vat_id = $r->com_vat_id;
		$companies->com_tax_size = $r->com_tax_size;
		$companies->com_addr_map = $r->com_addr_map;
		$companies->com_addr_house = $r->com_addr_house;
		$companies->com_addr_street = $r->com_addr_street;
		$companies->com_addr_group = $r->com_addr_group;
		$companies->com_addr_village = $r->com_addr_village;
		$companies->com_addr_commune = $r->com_addr_commune;
		$companies->com_description = $r->com_description;
		$companies->com_objective_id = $r->com_objective_id;
		$companies->com_province_id = $r->com_province_id;
		$companies->com_district_id = $r->com_district_id;

		$companies->com_cp_name = $r->com_cp_name;
		$companies->com_cp_gender = $r->com_cp_gender;
		$companies->com_cp_phone = $r->com_cp_phone;
		$companies->com_cp_email = $r->com_cp_email;
		$companies->com_cp_description = $r->com_cp_description;
		$companies->com_updated_by = Auth::id();
		$companies->save();

		// redirect
		return redirect()->route('companies.index')
			->with('success', 'ក្រុមហ៊ុនបានកែប្រែដោយជោគជ័យ៖ ' . $r->dist_name);
	}

	public function image(Companies $companies, $id)
	{
    $this->data+=[
			// Select Data From Table
      'company' => Companies::find($id),
      'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li><a href="'. route('companies.index') .'"><i class="fa fa-heart"></i> ក្រុមហ៊ុន</a></li><li class="active"><i class="fa fa-pencil"></i> កែប្រែរូបភាព៖ '. Companies::find($id)->com_name.'</li>',
    ];
    return view('companies.image',$this->data);
	}

	public function image_update(Request $r, Companies $companies, $id)
	{
		// Validate Post Data
		$validator = Validator::make($r->all(), [
			'com_logo' => 'required|image|max:2048',
		]);

		// if Validate Errors
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		// $com_logo;
		$image = $r->file('com_logo');
		if ($image->extension()=='png') {
			$com_logo=time().'_'.$id.'.png';
			Image::make($image->getRealPath())->save($this->path.$com_logo);
		}else{
			$com_logo=time().'_'.$id.'.jpg';
			Image::make($image->getRealPath())->save($this->path.$com_logo);
		}
		// Update Item
		$companies = Companies::find($id);
		$old_com_logo = $companies->com_logo;
		$companies->com_logo = $com_logo;
		$companies->com_updated_by = Auth::id();
		$companies->save();

		if ($old_com_logo!='default_company.png') {
			File::delete($this->path.$old_com_logo);
		}

		// redirect
		return redirect()->route('companies.index')
			->with('success', 'ក្រុមហ៊ុនបានកែប្រែដោយជោគជ័យ៖ ' . $r->dist_name);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Companies  $companies
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Companies $companies, $id)
	{
		// delete
		$com = Companies::find($id);
		$com_name = $com->com_name;
		$com_logo = $com->com_logo;
		$com->delete();
		if ($com_logo!='default_company.png') {
			File::delete($this->path.$com_logo);
		}
		// redirect
		return redirect()->route('companies.index')
			->with('success', 'ក្រុមហ៊ុនបានលុបចោលដោយជោគជ័យ៖ '. $com_name);
	}

}
