<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Modules;
use App\Models\RoleAccessModules;

class ModuleController extends Controller
{

    public $parentModel = Modules::class;
    public $parentRoute = 'modules';
    public $parentView = "admin.modules";

    function __construct()
    {
        // $this->middleware(function ($request, $next) {

        //     if (!Auth::user()) {
        //         return redirect('login');
        //     }
        //     $moduleId = Application_modules::where('module', 'subscription_module')->first()->id;
        //     $userRoleID = Users::with('user_roles')->whereIn('id', [Auth::id()])->first()->user_roles[0]->id;
        //     $this->userRolePermissionId = Role_access_modules::where('role_id', $userRoleID)->where('application_module_id', $moduleId)->first();
        //     return $next($request);
        // });
    }

    // show list
    public function index()
    {
        return view($this->parentView. '.index');
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
                $nestedData['module'] = $one->module;

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
                return redirect()->route('modules');
            }
        }
        return view($this->parentView.'.form',['edit' => $edit]);
    }

    // crud operation
    public function store(Request $request)
    {

        if(isset($request->type) && $request->type == "status"){
            $check = $this->parentModel::find($request->id);
            if(!empty($check)){
                $getold = $check->status;
                $check->status = $getold == "1" ? 0 : 1;
                $check->save(); 
            }
        }else{

            $request->validate([
                'module' => 'required'
            ]);

            $store = new $this->parentModel;
            $message = get_messages('Module created successfully!',1);
            if(isset($request->id) && $request->id != "" && $request->id != 0){
                $store = $this->parentModel::find($request->id);
                $message = get_messages('Module updated successfully!',1);
            }
            $store->module = $request->module;
            $store->status = $request->status;
            $store->save();

            Session::flash('message', $message);
            return redirect()->route('modules');
        }
    }

    // destory record
    public function destroy(Request $request)
    {
        $check = RoleAccessModules::where('module_id',$request->id)->count();
        if($check == 0){   
            $del = $this->parentModel::findOrFail($request->id);
            $del->delete();
            $data['status'] = "200";
        }else{
            $data['status'] = "0";
            $data['message'] = "Please remove from role";
        }
        echo json_encode($data); exit;
    }
}
