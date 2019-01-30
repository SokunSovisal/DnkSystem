<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_roles extends Model
{
	public function users()
	{
		return $this->hasMany('App\Models\Users','user_role_id');
	}
}
