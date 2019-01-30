<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
  public function module()
  {
  	return $this->belongsTo('App\Models\modules','p_module');
  }
}
