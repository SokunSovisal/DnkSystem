<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bills extends Model
{
	public function company()
	{
		return $this->belongsTo('App\Models\Companies','br_company_id');
	}

	public function payment()
	{
		return $this->hasMany('App\Models\payment_transitions','pt_bill_id');
	}
	
}
