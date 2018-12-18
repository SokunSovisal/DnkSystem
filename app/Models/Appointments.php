<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\Models\user','app_created_by');
    }

    public function company()
    {
    	return $this->belongsTo('App\Models\Companies','app_company_id');
    }

    public function services()
    {
    	return $this->belongsTo('App\Models\Services','app_services_id');
    }
}
