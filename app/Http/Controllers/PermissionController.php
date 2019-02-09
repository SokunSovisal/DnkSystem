<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Modules;
use App\Models\user_roles;
use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    private $globalNotitfy;
    private $module;

    public function __construct()
    {   
        $this->globalNotitfy = new Users();
        $this->module = '21';
        $this->data=[
            'm'=>'manage_users',
            'sm'=>$this->module,
            'title'=>'ការទូរទាត់',
        // Notification Appointments
            'appNotify' => $this->globalNotitfy->appointNotify(),
        ];
    }
    

    public function index()
    {
        $this->data +=[
            'breadcrumb'=>'<li><a href="'. route('home') .'"><i class="fa fa-home"></i> ផ្ទាំងដើម</a></li><li class="active"><i class="fa fa-file-invoice-dollar"></i> ការទូរទាត់</li>',
            // Select Data From Table
            'roles' => user_roles::orderBy('ur_name', 'asc')->get(),
            'modules' => Modules::all(),
        ];
        return (($this->globalNotitfy->permission($this->module)=='true')? view('permissions.index',$this->data) : view('errors.permission',$this->data) );
    }

    public function set_permission(Request $r)
    {
        $m_id = $r->m_id;
        $ur_id = $r->ur_id;
        $tbody = '';
        if ($m_id=='all') {
            $modules = Modules::all();
            foreach ($modules as $key => $module) {
                $permission = permissions::where('p_module_id', $module->id)
                                                                    ->where('p_role_id', $ur_id)
                                                                    ->first();
                // $tbody .= '<tr><td>asdf</td></tr>';
                $tbody .= '<tr>
                                        <td>'.++$key.'</td>
                                        <td width="30%"><b>'.$module->m_name.'</b></td>
                                        <td class="text-center"><div class="togglebutton"><label> <input data-ptype="p_view" '.((isset($permission->p_view) && $permission->p_view=='1')? 'checked' : '' ).' data-mid='.$module->id.' type="checkbox"> <span class="toggle toggle-active"></span> </label></div></td>
                                        <td class="text-center"><div class="togglebutton"><label> <input data-ptype="p_create" '.((isset($permission->p_create) && $permission->p_create=='1')? 'checked' : '' ).' data-mid='.$module->id.' type="checkbox"> <span class="toggle toggle-active"></span> </label></div></td>
                                        <td class="text-center"><div class="togglebutton"><label> <input data-ptype="p_edit" '.((isset($permission->p_edit) && $permission->p_edit=='1')? 'checked' : '' ).' data-mid='.$module->id.' type="checkbox"> <span class="toggle toggle-active"></span> </label></div></td>
                                        <td class="text-center"><div class="togglebutton"><label> <input data-ptype="p_delete" '.((isset($permission->p_delete) && $permission->p_delete=='1')? 'checked' : '' ).' data-mid='.$module->id.' type="checkbox"> <span class="toggle toggle-active"></span> </label></div></td>
                                    </tr>';
            }
        }else{
            $module = Modules::find($m_id);
            $permission = permissions::where('p_module_id', $m_id)
                                                                ->where('p_role_id', $ur_id)
                                                                ->first();
            $tbody .= '<tr>
                                    <td>1</td>
                                    <td width="30%"><b>'.$module->m_name.'</b></td>
                                    <td class="text-center"><div class="togglebutton"><label> <input data-ptype="p_view" '.((isset($permission->p_view) && $permission->p_view=='1')? 'checked' : '' ).' data-mid='.$module->id.' type="checkbox"> <span class="toggle toggle-active"></span> </label></div></td>
                                    <td class="text-center"><div class="togglebutton"><label> <input data-ptype="p_create" '.((isset($permission->p_create) && $permission->p_create=='1')? 'checked' : '' ).' data-mid='.$module->id.' type="checkbox"> <span class="toggle toggle-active"></span> </label></div></td>
                                    <td class="text-center"><div class="togglebutton"><label> <input data-ptype="p_edit" '.((isset($permission->p_edit) && $permission->p_edit=='1')? 'checked' : '' ).' data-mid='.$module->id.' type="checkbox"> <span class="toggle toggle-active"></span> </label></div></td>
                                    <td class="text-center"><div class="togglebutton"><label> <input data-ptype="p_delete" '.((isset($permission->p_delete) && $permission->p_delete=='1')? 'checked' : '' ).' data-mid='.$module->id.' type="checkbox"> <span class="toggle toggle-active"></span> </label></div></td>
                                </tr>';
        }

        echo '<table class="datatable table table-striped table-hover" id="per_dataTable">
                        <thead>
                            <tr>
                                <th width="5%">N&deg;</th>
                                <th>មេនុយ</th>
                                <th>បង្ហាញ</th>
                                <th>បន្ថែម</th>
                                <th>កែប្រែ</th>
                                <th>លុប</th>
                            </tr>
                        </thead>
                        <tbody>
                        '.$tbody.'
                        </tbody>
                    </table>';
    }

    public function update_permission(Request $r)
    {
        $m_id = $r->m_id;
        $ur_id = $r->ur_id;
        $p_type = $r->p_type;

        $permission = permissions::where('p_module_id', $m_id)
                                    ->where('p_role_id', $ur_id)
                                    ->first();
        if ($permission != null) {
            $p_id = $permission->id;

            $per = permissions::find($p_id);
            $per->$p_type = (($permission->$p_type=='0')? '1':'0' );
            $per->save();
        }else{
            $per = new permissions;
            $per->p_module_id = $m_id;
            $per->p_role_id = $ur_id;
            $per->$p_type = '1';
            $per->save();
        }
        echo "success";
        // echo $ur_id."::".$m_id."::".$p_type;
    }
}
