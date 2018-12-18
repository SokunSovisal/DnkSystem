<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public function userrole()
    {
    	return $this->belongsTo('App\Models\userRoles','user_role_id');
    }

    // public function company()
    // {
    // 	return $this->hasMany('App\Models\Companies','com_created_by');
    // }

    // public function objective()
    // {
    // 	return $this->hasMany('App\Models\Objectives','obj_created_by');
    // }
}
