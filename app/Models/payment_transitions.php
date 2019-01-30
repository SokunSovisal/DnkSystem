<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment_transitions extends Model
{
	public function bill()
	{
		return $this->belongsTo('App\Models\bills','pt_bill_id');
	}
}
