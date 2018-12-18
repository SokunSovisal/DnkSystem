<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Companies;
use App\Models\Services;
use App\Models\Appointments;
use DB;

class ajaxController extends Controller
{

	public function index()
	{
		# code...
	}

	
  public function lselect(Request $r)
  {
     $field = $r->get('field');
     $value = $r->get('value');
     $chtable = $r->get('chtable');
     $name = $r->get('name');
     $text = $r->get('text');
     $data_fetch = DB::table($chtable)
       ->where($field, $value)
       ->get();
     $output = '<option value="">-- ជ្រើសរើស'. $text.' --</option>';
     foreach($data_fetch as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->$name.'</option>';
     }
     echo $output;
  }

  public function servicePrice(Request $r)
  {
    $id = $r->get('id');
    $service = Services::find($id);
    $output = $service->s_price;
    echo $output;
  }

  public function quoteCompany(Request $r)
  {
    $id = $r->get('id');
    $com = Companies::find($id);
    $output = $com->com_cp_name.':'.$com->com_cp_phone.':'.$com->com_cp_email;
    echo $output;
  }

	public function appointmentServices(Request $r)
  {
    $app_id = $r->get('app_id');
    $app = Appointments::find($app_id);
    $services = Services::orderBy('s_name', 'asc')->get();
    $output ='<option value="">-- ជ្រើសរើសសេវាកម្ម --</option>';
    foreach (unserialize($app->app_services_id) as $serv) {
      foreach ($services as $i => $s) {
        if ($s->id==$serv) {
          $output .='<option value="'.$s->id.'">'.$s->s_name.'</option>';
        }
      }
    }
    echo $output;
	}
}
