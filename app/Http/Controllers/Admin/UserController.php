<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Roles;
use App\Models\Modules;
use App\Models\RoleAccessModules;
use App\Models\UserAccessModules;

class UserController extends Controller
{
    public $parentModel = User::class;
    public $parentRoute = 'users';
    public $parentView = "admin.users";
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
                $nestedData['name'] = '<a href="'.route($this->parentRoute.'.form',['id'=>base64UrlEncode($one->id),'type'=>"permission"]).'">'.$one->name.'</a>';
                $nestedData['email'] = $one->email;
                $nestedData['role'] = $one->email;
                $nestedData['status'] = $one->status;
                $action .= '<a href="'.route($this->parentRoute.'.form',['id'=>base64UrlEncode($one->id)]).'" class=" btn btn-info btn-sm btn-rounded waves-effect waves-light" ><i class="fas fa-edit" title="edit"></i></a>';
                if($one->role_id == 1)
                { 
                //$nestedData['status'] =  '<div class="square-switch mt-2"><input type="checkbox" id="square-access-'.$one->id. '" value="'.$one->status.'"  switch="bool" '.$status.'  onclick="updateActiveStatus()"/><label for="square-access-'.$one->id.'" data-on-label="YES" data-off-label="NO"></label></div>';
                }
                $action .=  '<button id="button" type="submit" class=" btn btn-danger btn-sm btn-rounded waves-effect  waves-light sa-remove " data-id='.$one->id.'><i class="fas fa-trash-alt"></i></button>';
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
            $role = Roles::where('status',1)->get();
            return view($this->parentView.'.form',['edit' => $edit,'role'=>$role]);
        }
    }

    // crud operation
    public function store(Request $request)
    {
        if(isset($request->type) && $request->type == "permission"){
            $check = UserAccessModules::where(array('user_id' => $request->userId,'module_id' => $request->moduleId))->first();
            $action = $request->action;
            if(!empty($check)){
                $getold = $check->$action;
                $check->$action = $getold == "1" ? 0 : 1;
                $check->save(); 
            }else{
                $new = new UserAccessModules;
                $new->user_id = $request->userId;
                $new->module_id = $request->moduleId;
                $new->$action = 1;
                $new->save();
            }
        }else{   
            //echo '<pre>'; print_r($request->all()); die;

            $request->validate([
                'role_id' => 'required'
            ]);

            $store = new $this->parentModel;
            $message = get_messages('Module created successfully!',1);
            if(isset($request->id) && $request->id != "" && $request->id != 0){
                $store = $this->parentModel::find($request->id);
                $message = get_messages('Module updated successfully!',1);
            }
            $store->name = $request->name;
            $store->email = $request->email;
            $store->password = $request->password;
            $store->role_id = $request->role_id;
            $store->save();

            $roledata = RoleAccessModules::where('role_id',$request->role_id)->get();
            $makedata = [];

            if(count($roledata)>0){
                foreach($roledata as $onerole){
                    array_push($makedata, array ("user_id" => $store->id, "module_id" => $onerole->module_id, "access" => $onerole->access, "create" => $onerole->create, "edit" => $onerole->edit, "delete" => $onerole->delete, "view" => $onerole->view));   
                }
            }
            $new = UserAccessModules::insert($makedata);

            Session::flash('message', $message);
            return redirect()->route($this->parentRoute);
        }
    }

    // destory record
    public function destroy($id)
    {
        $moduleDetails = $this->parentModel::findOrFail($id);
        $moduleDetails->delete();
        $message = get_messages('Module deleted successfully!',1);
        Session::flash('message', $message);
        return redirect()->route($this->parentRoute);
    }
}