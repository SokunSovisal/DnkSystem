<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Route;
use Auth;

class Users extends Model
{
    public function userrole()
    {
    	return $this->belongsTo('App\Models\user_roles','user_role_id');
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

		public function permission($module)
		{
			$routename = Route::currentRouteName();
			$permissions  = DB::table('permissions')
									->where('p_role_id', Auth::user()->user_role_id)
									->where('p_module_id', $module)
								  ->get();

			foreach ($permissions as $key => $per) {
				$p_create = $per->p_create;
				$p_edit = $per->p_edit;
				$p_delete = $per->p_delete;
				$p_view = $per->p_view;
				if(substr($routename, strpos($routename, ".") + 1)=='create'){
					return (($p_create==1)?'true':'false') ;
				}else if(substr($routename, strpos($routename, ".") + 1)=='store'){
					return (($p_create==1)?'true':'false');

				}else if(substr($routename, strpos($routename, ".") + 1)=='edit'){
					return (($p_edit==1)?'true':'false');
				}else if(substr($routename, strpos($routename, ".") + 1)=='update'){
					return (($p_edit==1)?'true':'false');
				}else if(substr($routename, strpos($routename, ".") + 1)=='image'){
					return (($p_edit==1)?'true':'false');
				}else if(substr($routename, strpos($routename, ".") + 1)=='update_image'){
					return (($p_edit==1)?'true':'false');
				}else if(substr($routename, strpos($routename, ".") + 1)=='image_update'){
					return (($p_edit==1)?'true':'false');
				}else if(substr($routename, strpos($routename, ".") + 1)=='password'){
					return (($p_edit==1)?'true':'false');
				}else if(substr($routename, strpos($routename, ".") + 1)=='service'){
					return (($p_edit==1)?'true':'false');
					
				}else if(substr($routename, strpos($routename, ".") + 1)=='destroy'){
					return (($p_delete==1)?'true':'false');

				}else if(substr($routename, strpos($routename, ".") + 1)=='show'){
					return (($p_view==1)?'true':'false');
				}else{
					return (($p_view==1)? 'true' : 'false');
				}
			}

		}
}
