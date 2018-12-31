<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Users extends Model
{
    public function userrole()
    {
    	return $this->belongsTo('App\Models\userRoles','user_role_id');
    }

		public function appointNotify()
		{
			$today = date("Y-m-d", time());
			$app_alert  = DB::table('appointments')
								  ->whereDate('app_datetime','<=', $today)
									->where('app_status',1)
								  ->get();
								  
			return $app_alert->count();
		}
}
