<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quotation_services extends Model
{

    public function service()
    {
    	return $this->belongsTo('App\Models\Services','qs_service_id');
    }
}
