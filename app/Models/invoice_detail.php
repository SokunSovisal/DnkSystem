<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invoice_detail extends Model
{
    
	public function service()
	{
		return $this->belongsTo('App\Models\Services','invd_service_id');
	}
    
}
