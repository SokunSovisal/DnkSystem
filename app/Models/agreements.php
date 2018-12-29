<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agreements extends Model
{
    public function company()
    {
    	return $this->belongsTo('App\Models\Companies','agr_company_id');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\user','agr_created_by');
    }

}
