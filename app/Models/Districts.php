<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class districts extends Model
{
  public function province()
  {
  	return $this->belongsTo('App\Models\Provinces','dist_province_id');
  }
}
