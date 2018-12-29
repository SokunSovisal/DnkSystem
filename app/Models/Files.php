<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
	public function user()
	{
		return $this->belongsTo('App\Models\user','f_created_by');
	}

	public function company()
	{
		return $this->belongsTo('App\Models\Companies','f_company_id');
	}

	public function filecategory()
	{
		return $this->belongsTo('App\Models\file_categories','f_fc_id');
	}
}
