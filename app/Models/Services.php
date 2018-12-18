<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public function mainservice()
    {
    	return $this->belongsTo('App\Models\Mainservices','s_ms_id');
    }

    public function createdBy()
    {
    	return $this->belongsTo('App\Models\Users','s_created_by');
    }
}
