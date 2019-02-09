<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = 'process';

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
    	return $this->belongsTo('App\Models\Services','pr_service_id');
    }
}
