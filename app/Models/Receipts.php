<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\invoice;
use App\Models\companies;


class Receipts extends Model
{

	public function invoice()
	{
		return $this->belongsTo('App\Models\invoice','rec_inv_id');
	}
    
}