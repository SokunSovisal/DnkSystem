<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mainservices extends Model
{
    public function services()
    {
    	return $this->hasMany('App\Models\Services','s_ms_id');
    }
}
