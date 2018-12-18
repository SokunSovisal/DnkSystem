<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objectives extends Model
{
  public function createBy()
  {
  	return $this->belongsTo('App\Models\User','obj_created_by');
  }
}
