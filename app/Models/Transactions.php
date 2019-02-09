<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    public function verify_by()
    {
        return $this->belongsTo('App\Models\user','tr_verify_by');
    }

    public function created_by()
    {
    	return $this->belongsTo('App\Models\user','created_by');
    }

    public function updated_by()
    {
    	return $this->belongsTo('App\Models\user','updated_by');
    }
    
    public function service()
    {
        return $this->belongsTo('App\Models\Services','tr_service_id');
    }
    
    public function company()
    {
    	return $this->belongsTo('App\Models\Companies','tr_company_id');
    }
}
