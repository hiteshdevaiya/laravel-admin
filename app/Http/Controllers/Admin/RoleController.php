<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use App\Models\Modules;
use App\Models\RoleAccessModules;
use App\Models\User;

class RoleController extends Controller
{
    public $parentModel = Roles::class;
    public $parentRoute = 'roles';
    public $parentView = "admin.roles";
    // Protected $userRolePermissionId;

    // function __construct()
    // {
    //     $this->middleware(function ($request, $next) {

    //         $moduleId = Application_modules::where('module', 'role_module')->first()->id;
    //         $userRoleID = Users::with('user_roles')->whereIn('id', [Auth::id()])->first()->user_roles[0]->id;
    //         $this->userRolePermissionId = Role_access_modules::where('role_id', $userRoleID)->where('application_module_id', $moduleId)->first();
    //         return $next($request);
    //     });
    // }

    // show list
    public function index()
    {
        return view($this->parentView.'.index');
    }

    // get listing record in datatable
    public function list(Request $request)
    {
        $list = $this->parentModel::get();
        $data = array();
        if(count($list)>0)
        {
            foreach ($list as $key => $one)
            {
                $action = '' ;
                $nestedData['module'] = '<a href="'.route($this->parentRoute.'.form',['id'=>base64UrlEncode($one->id),'type'=>"permission"]).'">'.$one->role.'</a>';
                
                $nestedData['status'] = '<div class="square-switch">';
                $nestedData['status'] .= '<input type="checkbox" id="square-access-'.$one->id.'" value="'.$one->status.'" switch="bool"';  
                if($one->status == 1){ $nestedData['status'] .= 'checked'; } 
                $nestedData['status'] .= ' onclick="updateStatus('.$one->id.')"/>';
                $nestedData['status'] .= '<label for="square-access-'.$one->id.'" data-on-label="Yes" data-off-label="No"></label>';
                $nestedData['status'] .= '</div>';

                $action .= '<a href="'.route($this->parentRoute.'.form',['id'=>base64UrlEncode($one->id)]).'" class=" btn btn-info btn-sm btn-rounded waves-effect waves-light" ><i class="fas fa-edit" title="edit"></i></a>';
                $action .=  '<button id="button" type="submit" class=" btn btn-danger btn-sm btn-rounded waves-effect  waves-light sa-remove " data-route="'.route($this->parentRoute.'.delete').'" data-id='.$one->id.'><i class="fas fa-trash-alt"></i></button>';
                $nestedData['action'] =  $action;
                $data[] = $nestedData;               
            }    
        }   
        echo json_encode($data); exit;
    }

    // create and edit form
    public function form(Request $request)
    {
        $edit = [];
        if(isset($request->id) && $request->id != ""){
            $id = base64UrlDecode($request->id);
            if((int)$id == true){
                $edit = $this->parentModel::find($id);
            }else{
                $message = get_messages('Record not Exists',0);
                Session::flash('message', $message);
                return redirect()->route($this->parentRoute);
            }
        }

        if(isset($request->type) && $request->type == "permission"){
            $data = Modules::get();
            return view($this->parentView.'.permission',['edit' => $edit,'data'=>$data]);
        }else{
            return view($this->parentView.'.form',['edit' => $edit]);
        }
    }

    // crud operation
    public function store(Request $request)
    {
        if(isset($request->type) && $request->type == "permission"){
            $check = RoleAccessModules::where(array('role_id' => $request->roleId,'module_id' => $request->moduleId))->first();
            $action = $request->action;
            if(!empty($check)){
                $getold = $check->$action;
                $check->$action = $getold == "1" ? 0 : 1;
                $check->save(); 
            }else{
                $new = new RoleAccessModules;
                $new->role_id = $request->roleId;
                $new->module_id = $request->moduleId;
                $new->$action = 1;
                $new->save();
            }
        }elseif(isset($request->type) && $request->type == "status"){
            $check = $this->parentModel::find($request->id);
            if(!empty($check)){
                $getold = $check->status;
                $check->status = $getold == "1" ? 0 : 1;
                $check->save(); 
            }
        }else{   

            $request->validate([
                'role' => 'required'
            ]);

            $store = new $this->parentModel;
            $message = get_messages('Role created successfully!',1);
            if(isset($request->id) && $request->id != "" && $request->id != 0){
                $store = $this->parentModel::find($request->id);
                $message = get_messages('Role updated successfully!',1);
            }
            $store->role = $request->role;
            $store->status = $request->status;
            $store->save();

            Session::flash('message', $message);
            return redirect()->route($this->parentRoute);
        }
    }

    // destory record
    public function destroy(Request $request)
    {
        $check = User::where('role_id',$request->id)->count();
        if($check == 0){   
            $del = $this->parentModel::findOrFail($request->id);
            $del->delete();
            $data['status'] = "200";
        }else{
            $data['status'] = "0";
            $data['message'] = "Please remove from user";
        }
        echo json_encode($data); exit;
    }
}