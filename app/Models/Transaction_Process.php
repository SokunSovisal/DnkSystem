<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_Process extends Model
{
    protected $table = 'transaction_process';
    public function created_by()
    {
    	return $this->belongsTo('App\Models\user','created_by');
    }

    public function updated_by()
    {
    	return $this->belongsTo('App\Models\user','updated_by');
    }
    
    public function services()
    {
    	return $this->belongsTo('App\Models\Services','ch_services_id');
    }
}
