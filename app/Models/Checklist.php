<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{

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
    	return $this->belongsTo('App\Models\Services','ch_service_id');
    }

}
