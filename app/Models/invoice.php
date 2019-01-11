<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    
	public function company()
	{
		return $this->belongsTo('App\Models\Companies','inv_company_id');
	}

	public function serviceprice()
	{
		return $this->hasMany('App\Models\invoice_detail','invd_invoice_id');
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
