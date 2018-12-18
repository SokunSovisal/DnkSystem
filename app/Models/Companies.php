<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
  public function objective()
  {
  	return $this->belongsTo('App\Models\Objectives','com_objective_id');
  }

  public function district()
  {
  	return $this->belongsTo('App\Models\Districts','com_district_id');
  }

  public function province()
  {
  	return $this->belongsTo('App\Models\Provinces','com_province_id');
  }
}
