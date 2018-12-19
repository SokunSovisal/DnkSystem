<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quotations extends Model
{
	public function user()
	{
		return $this->belongsTo('App\Models\user','quote_created_by');
	}

	public function company()
	{
		return $this->belongsTo('App\Models\Companies','quote_company_id');
	}

	public function services()
	{
		return $this->belongsTo('App\Models\Services','quote_services_id');
	}
	
	public function is_en($str)
	{
		if (strlen($str) != strlen(utf8_decode($str))) {
			echo "KHMERBTB";
		} else {
			echo "time_new";
		}
	}

	

}
