<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Modules;

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
                $action .= '<a href="'.route('modules.form',['id'=>base64UrlEncode($one->id)]).'" class=" btn btn-info btn-sm btn-rounded waves-effect waves-light" ><i class="fas fa-edit" title="edit"></i></a>';
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
        $store->save();

        Session::flash('message', $message);
        return redirect()->route('modules');
    }

    // destory record
    public function destroy($id)
    {
        $moduleDetails = $this->parentModel::findOrFail($id);
        $moduleDetails->delete();
        $message = get_messages('Module deleted successfully!',1);
        Session::flash('message', $message);
        return redirect()->route('modules.index');
    }
}
