<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Userdetails;
use App\Models\Userrole;
use App\Models\User_assigned_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Application_modules;
use App\Models\Role_access_modules;
use App\Models\User_access_modules;
use PHPUnit\Framework\StaticAnalysis\HappyPath\AssertNotInstanceOf\A;
use App\Services\UrlService;

class UserController extends Controller
{


    Protected $userRolePermissionId;

    function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (!Auth::user()) {
                return redirect('login');
            }
            $moduleId = Application_modules::where('module', 'user_module')->first()->id;
            $userRoleID = Users::with('user_roles')->whereIn('id', [Auth::id()])->first()->user_roles[0]->id;
            $this->userRolePermissionId = Role_access_modules::where('role_id', $userRoleID)->where('application_module_id', $moduleId)->first();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $admindata = array();
        $memberdata = array();
        $affiliatedata = array();

        $get_checks = get_access('user_module','view');
        $get_user_access = get_user_check_access('user_module','view');
        if ($get_checks == 1) {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        } else {
                if ($get_user_access == 0) {
                    $message = get_messages("Don't have Access Rights for this Functionality", 0);
                    Session::flash('message', $message);
                    return redirect('/index');
                }
        }
        $auth_Id = Auth::id();
        if ($this->userRolePermissionId->role_id == 1 || $this->userRolePermissionId->role_id == 2) {
            $data = Users::with('userdetails', 'user_assigned_role', 'user_roles')->whereIn('parent_id', [0, 1, $auth_Id])->whereNotIn('id', [1, $auth_Id])->get()->toArray();
            $admindata = Users::with('userdetails', 'user_assigned_role','user_roles')->whereIn('parent_id', [0, 1, $auth_Id])->whereHas(
                'user_roles', function($q){$q->where('role', 'admin');})->get()->toArray();
            $affiliatedata = Users::with('userdetails', 'user_assigned_role','user_roles')->whereIn('parent_id', [0, 1, $auth_Id])->whereHas(
                'user_roles', function($q){$q->where('role', 'Affiliate');})->get()->toArray();
            $memberdata = Users::with('userdetails', 'user_assigned_role','user_roles')->whereIn('parent_id', [0, 1, $auth_Id])->whereHas(
                'user_roles', function($q){$q->where('role', 'member');})->get()->toArray();


        } else {
            $data = Users::with('userdetails', 'user_assigned_role', 'user_roles')->whereIn('parent_id', [$auth_Id])->get()->toArray();
        }  
        return view('users.index', [
                'users_details' => $data,
                'adminusers_details'=>$admindata,
                'memberusers_details'=>$memberdata,
                'affiliateusers_details'=>$affiliatedata,
                'create_access' => $this->userRolePermissionId->create,
                'edit_access' => $this->userRolePermissionId->edit,
                'delete_access' => $this->userRolePermissionId->delete,
                'user_access_create_details' => get_user_check_access('user_module','create'),
                'user_access_edit_details' => get_user_check_access('user_module','edit'),
                'user_access_delete_details' => get_user_check_access('user_module','delete'),
            ]
        );
    }


    public function create()
    {
        $get_user_access = get_user_check_access('user_module','create');
        if (Gate::allows('create', $this->userRolePermissionId)) {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        } else {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        }
            $resultUserRole = Userrole::where(array(['id','!=','5']))->get()->toArray();
            return view('users.create-user', [
                    'resultUserRole' => $resultUserRole
                ]
            );
    }


    public function store(Request $request)
    {
        if($request->request_type == 'admin_users_list'){
        $auth_Id = Auth::id();
        if($this->userRolePermissionId->role_id == 1 || $this->userRolePermissionId->role_id == 2) {

            $admindata = Users::with('userdetails', 'user_assigned_role','user_roles')->whereIn('parent_id', [0, 1, $auth_Id])->whereHas(
                'user_roles', function($q){$q->where('role', 'admin');})->get()->toArray();  
          $users_data = array();
         if(!empty($admindata))
            {
                 foreach ($admindata as $key => $post)
                {
                    $status='';
                    $status =($post['active']==1) ? 'checked' : '0'; 
                    $action = '' ;
                    $urlId = UrlService::base64UrlEncode($post['id']);
                    $nestedData['name'] = '<a href=" '.url('display_access/'.$urlId).'" role="button"> '.$post['name'].'</a>';
                    $nestedData['email'] =  $post['email'];
                     $nestedData['role'] =  $post['user_roles'][0]['role'];
                     $nestedData['commission'] =  $post['commission'] ? $post['commission'] : "-" ;
                    if($this->userRolePermissionId->role_id == 1)
                    { 
                    $nestedData['active'] =  '<div class="square-switch mt-2"><input type="checkbox" id="square-access-'.$post['id']. '" value="'.$post['active'].'"  switch="bool" '.$status.'  onclick="updateActiveStatus( '.$post['active'].', '.$post['id'].')"/><label for="square-access-'.$post['id'].'" data-on-label="YES" data-off-label="NO"></label></div>';

                    }
                    
                    $action .= '<a href="'.route('users.edit',$urlId).'"  class=" btn btn-info btn-sm btn-rounded waves-effect waves-light" role="button"><i class="fas fa-edit" ></i></a>';
                    $action .=  '<button id="button" type="submit" class=" btn btn-danger btn-sm btn-rounded waves-effect  waves-light sa-remove " data-id='.$post['id'].'><i class="fas fa-trash-alt"></i></button>';

                    $nestedData['action'] =  $action ;
                    $users_data[] = $nestedData;               
                }    
             }
                
           echo json_encode($users_data); exit;
        }
    }
 else if($request->request_type == 'member_users_list'){
        $auth_Id = Auth::id();
        if($this->userRolePermissionId->role_id == 1 || $this->userRolePermissionId->role_id == 2) {

            $memberdata = Users::with('userdetails', 'user_assigned_role','user_roles')->whereIn('parent_id', [0, 1, $auth_Id])->whereHas(
                'user_roles', function($q){$q->where('role', 'member');})->get()->toArray();
       //  echo "<pre>";   print_r($admindata); exit;
        
          $users_data = array();
         if(!empty($memberdata))
            {
                 foreach ($memberdata as $key => $post)
                {
                    $status='';
                    $status =($post['active']==1) ? 'checked' : '0'; 
                    $action = '' ;
                    $nestedData[''] = '<a href="javascript:void(0);" id="row_'.$post["id"].'" data-val="'.$post["id"].'" class="view_media view_medias_'.$post["id"].'btn btn-sm btn-icon btn-circle btn-default"><i class="success-icon" ></i></a>';
                    $urlId = UrlService::base64UrlEncode($post['id']);
                    $nestedData['name'] = '<a href=" '.url('display_access/'.$urlId).'" role="button"> '.$post['name'].'</a>';
                    $nestedData['email'] =  $post['email'];
                     $nestedData['role'] =  $post['user_roles'][0]['role'];
                     $nestedData['commission'] =  $post['commission'] ? $post['commission'] : "-";
                    if($this->userRolePermissionId->role_id == 1)
                    { 
                    $nestedData['active'] =  '<div class="square-switch mt-2"><input type="checkbox" id="square-access-'.$post['id']. '" value="'.$post['active'].'"  switch="bool" '.$status.'  onclick="updateActiveStatus( '.$post['active'].', '.$post['id'].')"/><label for="square-access-'.$post['id'].'" data-on-label="YES" data-off-label="NO"></label></div>';

                    }

                    $action .= '<a href="'.route('users.edit',$urlId).'"  class=" btn btn-info btn-sm btn-rounded waves-effect waves-light" role="button"><i class="fas fa-edit" ></i></a>';
                    $action .=  '<button id="button" type="submit" class=" btn btn-danger btn-sm btn-rounded waves-effect  waves-light sa-remove " data-id='.$post['id'].'><i class="fas fa-trash-alt"></i></button>';
                    $action .= '<button type="button" class=" btn btn-primary btn-sm btn-rounded waves-effect  waves-light sa-remove " onClick="Cmodel('.$post['id'].','.$post['commission'].');" title="Apply Commission"><i class="fa fa-percent"></i></button>';
                    $nestedData['action'] =  $action ;
                    $users_data[] = $nestedData;               
                }    
             }
                
           echo json_encode($users_data); exit;
        }
    }
    else if($request->request_type == 'affiliate_users_list'){
        $auth_Id = Auth::id();
        if($this->userRolePermissionId->role_id == 1 || $this->userRolePermissionId->role_id == 2) {

            $affiliatedata = Users::with('userdetails', 'user_assigned_role','user_roles')->whereIn('parent_id', [0, 1, $auth_Id])->whereHas(
                'user_roles', function($q){$q->where('role', 'Affiliate');})->get()->toArray();
       //  echo "<pre>";   print_r($admindata); exit;
        
          $users_data = array();
         if(!empty($affiliatedata))
            {
                 foreach ($affiliatedata as $key => $post)
                {
                    $status='';
                    $status =($post['active']==1) ? 'checked' : '0'; 
                    $action = '' ;
                    $urlId = UrlService::base64UrlEncode($post['id']);
                    $nestedData['name'] = '<a href=" '.url('display_access/'. $urlId).'" role="button"> '.$post['name'].'</a>';
                    $nestedData['email'] =  $post['email'];
                    $nestedData['role'] =  $post['user_roles'][0]['role'];
                    $nestedData['commission'] =  $post['commission'] ? $post['commission'] : "-";
                    if($this->userRolePermissionId->role_id == 1)
                    { 
                    $nestedData['active'] =  '<div class="square-switch mt-2"><input type="checkbox" id="square-access-'.$post['id']. '" value="'.$post['active'].'"  switch="bool" '.$status.'  onclick="updateActiveStatus( '.$post['active'].', '.$post['id'].')"/><label for="square-access-'.$post['id'].'" data-on-label="YES" data-off-label="NO"></label></div>';

                    }
                    
                    $action .= '<a href="'.route('users.edit',$urlId).'"  class=" btn btn-info btn-sm btn-rounded waves-effect waves-light" role="button"><i class="fas fa-edit" ></i></a>';
                    $action .=  '<button id="button" type="submit" class=" btn btn-danger btn-sm btn-rounded waves-effect  waves-light sa-remove " data-id='.$post['id'].'><i class="fas fa-trash-alt"></i></button>';
                    $action .= '<button type="button" class=" btn btn-primary btn-sm btn-rounded waves-effect  waves-light sa-remove " onClick="Cmodel('.$post['id'].','.$post['commission'].');" title="Apply Commission"><i class="fa fa-percent"></i></button>';
                    $nestedData['action'] =  $action ;
                    $users_data[] = $nestedData;               
                }    
             }
                
           echo json_encode($users_data); exit;
        }
    }
    else if($request->request_type == 'users_list'){
        $auth_Id = Auth::id();    
     if($this->userRolePermissionId->role_id == 3) {   
        $data = Users::with('userdetails', 'user_assigned_role', 'user_roles')->whereIn('parent_id', [$auth_Id])->get()->toArray();
          $users_data = array();
         if(!empty($data))
            {
                 foreach ($data as $key => $post)
                {
                    $status='';
                    $status =($post['active']==1) ? 'checked' : '0'; 
                    $action = '' ;
                    $urlId = UrlService::base64UrlEncode($post['id']);
                    $nestedData['name'] = '<a href=" '.url('display_access/'.$urlId).'" role="button"> '.$post['name'].'</a>';
                    $nestedData['email'] =  $post['email'];
                    $nestedData['role'] =  $post['user_roles'][0]['role'];
                    if($this->userRolePermissionId->role_id == 3)
                    { 
                    $nestedData['active'] =  '<div class="square-switch mt-2"><input type="checkbox" id="square-access-'.$post['id']. '" value="'.$post['active'].'"  switch="bool" '.$status.'  onclick="updateActiveStatus( '.$post['active'].', '.$post['id'].')"/><label for="square-access-'.$post['id'].'" data-on-label="YES" data-off-label="NO"></label></div>';

                    }
                    
                    $action .= '<a href="'.route('users.edit',$urlId).'"  class=" btn btn-info btn-sm btn-rounded waves-effect waves-light" role="button"><i class="fas fa-edit" ></i></a>';
                    $action .=  '<button id="button" type="submit" class=" btn btn-danger btn-sm btn-rounded waves-effect  waves-light sa-remove " data-id='.$post['id'].' ><i class="fas fa-trash-alt"></i></button>';
                    $nestedData['action'] =  $action ;
                    $users_data[] = $nestedData;               
                }    
             }
                
           echo json_encode($users_data); exit;
        }
    }
    
    if($request->insert_type == 'commission_update'){
        $inputs = $request->all();
        $updatec = Users::findOrFail($inputs['user_id']);
        
        

        if(empty($updatec->commission)) {
            $updatec->commission = $inputs['commission'];
            $updatec->save();
            $res['error'] = 0;
            $res['message'] = get_messages('Commission applied succesfully', 1);
        }
        else if(!empty($updatec->commission)) {
            $updatec->commission = $inputs['commission'];
            $updatec->save();
            $res['error'] = 0;
            $res['message'] = get_messages('Commision updated succesfully', 1);
        }
        else{
            $res['error'] = 0;
            $res['message'] = get_messages('Failed to Commision update ',0);
        }    
        return response()->json($res);
    }    
      
        if(isset($request->user_type) && $request->user_type == 'updatestatus'){
            $input = $request->all();
            
            $userDetails = Users::where(['id' => $input['id']])->get()->first();
            if ($input['active_status'] == 0) {
                $update['active'] = 1;
            } else if ($input['active_status'] == 1) {
                $update['active'] = 0;
            }
            $data=$userDetails->update($update);
            return response()->json(array('sucess' => 'sucess')
            );
        }else if(isset($request->user_type) && $request->user_type == 'show_sub_members'){
            $auth_Id = Auth::id();
            $userid = $request->news_id;
            $data = Users::with(['userdetails', 'user_assigned_role', 'user_roles'])->where('parent_id', $userid)->get()->toArray();
            $view = View::make('users.get_sub_users', [
                'user_data' => $data,
                'main_parent_id' => $userid,
                'create_access' => $this->userRolePermissionId->create,
                'edit_access' => $this->userRolePermissionId->edit,
                'delete_access' => $this->userRolePermissionId->delete,
            ]);
            $html = $view->render();
            $res['error'] = 0;
            $res['view'] = $html;
            return response()->json($res);
        }else {
            $get_user_access = get_user_check_access('user_module', 'create');
            if (Gate::allows('create', $this->userRolePermissionId)) {
                if ($get_user_access == 0) {
                    $message = get_messages("Don't have Access Rights for this Functionality", 0);
                    Session::flash('message', $message);
                    return redirect()->back();
                }
            } else {
                if ($get_user_access == 0) {
                    $message = get_messages("Don't have Access Rights for this Functionality", 0);
                    Session::flash('message', $message);
                    return redirect()->back();
                }
            }
            $auth_Id = Auth::id();
            $request->validate([
                'user_role_id' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
                'company' => ['required', 'string']
            ]);

            $input = $request->all();
            $activate_code = md5(rand(1,(int) 10000000000) . "skote" . rand(1, (int) 100000));
            $settings = get_settings();
            $parent_id = $this->userRolePermissionId->role_id == 3 ? Auth::id() : $input['main_parent_id'];
            if (!empty($settings['email_settings']) && $settings['email_settings'] == 1) {
                $userData = [
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'activation_code' => $activate_code,
                    'active' => 0,
                    'password' => Hash::make($input['password']),
                    'created_by' => $input['main_parent_id'] != '' ? $input['main_parent_id'] : Auth::id(),
                    'parent_id' => $parent_id != '' ? $parent_id : 0,
                ];
            } else {
                $userData = [
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'active' => 1,
                    'password' => Hash::make($input['password']),
                    'created_by' => $input['main_parent_id'] != '' ? $input['main_parent_id'] : Auth::id(),
                    'parent_id' => $parent_id != '' ? $parent_id : 0,
                ];
            }
            $user = Users::create($userData);
            $userLastInsertId = $user->toArray();
            // add Userdetails
            $input['user_id'] = $userLastInsertId['id'];

            $userdetails = Userdetails::create($input);

            // add assigned role
            $assignedRole['user_id'] = $userLastInsertId['id'];
            $assignedRole['user_role_id'] = $input['user_role_id'];
            User_assigned_role::create($assignedRole);

            $get_application_module = Application_modules::get()->toArray();
            if (!empty($get_application_module)) {
                foreach ($get_application_module as $module) {
                    $check_application_check = Role_access_modules::where(array('role_id' => $assignedRole['user_role_id'], 'application_module_id' => $module['id']))->first();
                    $modue['role_id'] = $input['user_role_id'];
                    $modue['user_id'] = $userLastInsertId['id'];
                    $modue['application_module_id'] = $module['id'];
                    if (!empty($check_application_check)) {
                        $modue['create'] = $check_application_check->create;
                        $modue['edit'] = $check_application_check->edit;
                        $modue['delete'] = $check_application_check->delete;
                        $modue['view'] = $check_application_check->view;
                        $modue['access'] = $check_application_check->access;
                    } else {
                        $modue['create'] = 0;
                        $modue['edit'] = 0;
                        $modue['delete'] = 0;
                        $modue['view'] = 0;
                        $modue['access'] = 0;
                    }
                    User_access_modules::create($modue);
                }
            }

            $settings = get_settings();
            if (!empty($settings['email_settings']) && $settings['email_settings'] == 1) {
                $userData['confirmation_code'] = $activate_code;
                $userData['user_email'] = $input['email'];
                $userData['user_password'] = $input['password'];
                Mail::send('emailtemplate.registereduser', $userData, function ($message) use ($userData) {
                    $message->to($userData['email'], $userData['name'])
                        ->subject('Verify your email address');
                });
            }
            $message = get_messages('User created successfully!', 1);
            Session::flash('message', $message);
            return redirect()->route('users.index');
        }
    }

    public function show($id)
    {
        $urlId = UrlService::base64UrlDecode($id);
        $authId = Auth::id();
        $userDetails = Users::with(['userdetails', 'user_assigned_role','user_roles'])->where(array('id' => $urlId))->first();

        // echo "<pre>"; print_r($userDetails); exit;

        if($authId == $urlId){
            $resultUserRole = Userrole::where(array(['id','!=','5']))->get()->toArray();
            return view('users.edit-userprofile', [
                    'userDetails' => $userDetails,
                    'resultUserRole' => $resultUserRole,
                    'authId' => $authId,
                ]
            );
        }else{
            $message = get_messages("Don't have Access Rights for this Functionality", 0);
            Session::flash('message', $message);
            return redirect('/index');
        }
    }

    public function edit($id)
    {
        $get_user_access = get_user_check_access('user_module','edit');
        if (Gate::allows('edit', $this->userRolePermissionId)) {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        } else {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        }

        $id = UrlService::base64UrlDecode($id);


        $authId = Auth::id();
        $userDetails = Users::with(['userdetails', 'user_assigned_role'])->where(array('id' => $id))->first();    
        $resultUserRole = Userrole::where(array(['id','!=','5']))->get()->toArray();
        if(!empty($userDetails) && !empty($authId) && !empty($resultUserRole)) {
            return view('users.edit-user', [
                    'userDetails' => $userDetails,
                    'resultUserRole' => $resultUserRole,
                    'authId' => $authId
                ]
            );
        }
        else {
            $message = get_messages("Seems like user not exists in our system. ", 0);
            Session::flash('message', $message);
            return redirect()->route('users.index');
        }
    }

    public function update(Request $request, $id)
    {
        if($request->UserProfile != 'UserProfile') {
            $get_user_access = get_user_check_access('user_module', 'edit');
            if (Gate::allows('edit', $this->userRolePermissionId)) {
                if ($get_user_access == 0) {
                    $message = get_messages("Don't have Access Rights for this Functionality", 0);
                    Session::flash('message', $message);
                    return redirect('/index');
                }
            } else {
                if ($get_user_access == 0) {
                    $message = get_messages("Don't have Access Rights for this Functionality", 0);
                    Session::flash('message', $message);
                    return redirect('/index');
                }
            }
        }
        
        $request->validate([
            'user_role_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',\Illuminate\Validation\Rule::unique('users')->ignore($id)],
            'company' => ['required', 'string']
        ]);

        $input = $request->all();
        //$check_role = User_assigned_role::where(array('user_id' => $id))->get()->first();
        if(isset($input['parent_id']) && $input['parent_id'] != "0" && $input['get_user_role'] == "3"){
            if(Auth::id() != $input['parent_id']){
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        }else if(isset($input['parent_id']) && ($input['parent_id'] == "0") && ($input['get_user_role'] == "3")){
            
            if(Auth::id() != $id){
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
               
            }else if(Auth::id() != $id){
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index'); 
            }
        }

        // update user
        $getOldPassword = Users::findOrFail($id)->first()->toArray();
        $activate_code = md5(rand(1, (int)10000000000) . "skote" . rand(1, (int)100000));
        $update = [
            'name' => $input['name'],
            'email' => $input['email'],
            'activation_code' => $activate_code,
            'password' => (!empty($input['password']) ? Hash::make($input['password']) : $getOldPassword['password']),
        ];
        $users = Users::findOrFail($id);
        $data=$users->update($update);
       
        // update Userdetails
        $userDetails = Userdetails::where(array('user_id' => $id))->get()->first();
        $userDetails->update($input);

        // update assigned role
        $assignedRole = User_assigned_role::where(array('user_id' => $id))->get()->first();
        $assignedRole->update($input);

        if($request->UserProfile != 'UserProfile') {
            $message = get_messages("User updated successfully!", 1);
            Session::flash('message', $message);
            return redirect()->route('users.index');
        }else{
            $message = get_messages("Profile updated successfully!", 1);
            Session::flash('message', $message);
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $get_user_access = get_user_check_access('user_module','delete');
        if (Gate::allows('delete', $this->userRolePermissionId)) {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        } else {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        }
        $userDetails = Users::findOrFail($id);
        $userDetails->delete();
        return json_encode(array('statusCode'=>200));
    }

    function sub_user_create($id)
    {
        $get_user_access = get_user_check_access('user_module','create');
        if (Gate::allows('create', $this->userRolePermissionId)) {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        } else {
            if ($get_user_access == 0) {
                $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
            }
        }
        $resultUserRole = Userrole::where(array(['id','!=','5']))->get()->toArray();
        return view('users.create-user', [
                'resultUserRole' => $resultUserRole,
                'main_parent_id' => $id
            ]
        );
    }

    function display_sub_user($userid)
    {
        $auth_Id = Auth::id();
        $data = Users::with(['userdetails', 'user_assigned_role', 'user_roles'])->where('parent_id', $userid)->get()->toArray();
        $view = View::make('users.get_sub_users', [
            'user_data' => $data,
            'main_parent_id' => $userid,
            'create_access' => $this->userRolePermissionId->create,
            'edit_access' => $this->userRolePermissionId->edit,
            'delete_access' => $this->userRolePermissionId->delete,
        ]);
        $html = $view->render();
        $res['error'] = 0;
        $res['view'] = $html;
        return response()->json($res);

    }

    public function updateActiveStatus(Request $request)
    {
        $input = $request->all();
        $userDetails = Users::where(['id' => $input['id']])->get()->first();
        if ($input['active_status'] == 0) {
            $update['active'] = 1;
        } else if ($input['active_status'] == 1) {
            $update['active'] = 0;
        }
        $data=$userDetails->update($update);
        return response()->json(array('sucess' => 'sucess')
        );
    }

    function display_access($user_id)
    {
        $user_id = UrlService::base64UrlDecode($user_id);
        $getParent = Users::select("parent_id")->where("id",$user_id)->first();
        if($this->userRolePermissionId->role_id == 3 && isset($getParent->parent_id) && Auth::id() == $getParent->parent_id) {            

            $application_module = User_access_modules::with(['application_modules'])->where(array('user_id' => $user_id))->get()->toArray();
            $get_user_role = User_assigned_role::where(array('user_id'=>$user_id))->first();
            if(!empty($application_module) && !empty($get_user_role)) {
            $resultRolesName = Userrole::where(['id' => $get_user_role->user_role_id])->first();

                if(empty($application_module)){
                    $get_application_module = Application_modules::get()->toArray();
                    if (!empty($get_application_module)) {
                        foreach ($get_application_module as $module) {
                            $check_application_check = Role_access_modules::where(array('role_id' => $get_user_role->user_role_id, 'application_module_id' => $module['id']))->first();
                            $modue['role_id'] = $get_user_role->user_role_id;
                            $modue['user_id'] = $user_id;
                            $modue['application_module_id'] = $module['id'];
                            if (!empty($check_application_check)) {
                                $modue['create'] = $check_application_check->create;
                                $modue['edit'] = $check_application_check->edit;
                                $modue['delete'] = $check_application_check->delete;
                                $modue['view'] = $check_application_check->view;
                                $modue['access'] = $check_application_check->access;
                            } else {
                                $modue['create'] = 0;
                                $modue['edit'] = 0;
                                $modue['delete'] = 0;
                                $modue['view'] = 0;
                                $modue['access'] = 0;
                            }
                            User_access_modules::create($modue);
                        }
                        $application_module = User_access_modules::with(['application_modules'])->where(array('user_id' => $user_id))->get()->toArray();
                    }
                }
                return view('users.modules-list', [
                        'module_details' => $application_module,
                        'rolesName' => $resultRolesName['role'],
                        'roleid' => $get_user_role->user_role_id,
                    ]
                );
            }    
            else {
                $message = get_messages("Seems like user not exists in our system. ", 0);
                Session::flash('message', $message);
                return redirect()->route('users.index');
            }
        }else if((isset($getParent->parent_id)) && $getParent->parent_id == "0" && $this->userRolePermissionId->role_id == 1 || $this->userRolePermissionId->role_id == 2){
             $application_module = User_access_modules::with(['application_modules'])->where(array('user_id' => $user_id))->get()->toArray();
            $get_user_role = User_assigned_role::where(array('user_id'=>$user_id))->first();
            if(!empty($application_module) && !empty($get_user_role)) {
            $resultRolesName = Userrole::where(['id' => $get_user_role->user_role_id])->first();

                if(empty($application_module)){
                    $get_application_module = Application_modules::get()->toArray();
                    if (!empty($get_application_module)) {
                        foreach ($get_application_module as $module) {
                            $check_application_check = Role_access_modules::where(array('role_id' => $get_user_role->user_role_id, 'application_module_id' => $module['id']))->first();
                            $modue['role_id'] = $get_user_role->user_role_id;
                            $modue['user_id'] = $user_id;
                            $modue['application_module_id'] = $module['id'];
                            if (!empty($check_application_check)) {
                                $modue['create'] = $check_application_check->create;
                                $modue['edit'] = $check_application_check->edit;
                                $modue['delete'] = $check_application_check->delete;
                                $modue['view'] = $check_application_check->view;
                                $modue['access'] = $check_application_check->access;
                            } else {
                                $modue['create'] = 0;
                                $modue['edit'] = 0;
                                $modue['delete'] = 0;
                                $modue['view'] = 0;
                                $modue['access'] = 0;
                            }
                            User_access_modules::create($modue);
                        }
                        $application_module = User_access_modules::with(['application_modules'])->where(array('user_id' => $user_id))->get()->toArray();
                    }
                }
                return view('users.modules-list', [
                        'module_details' => $application_module,
                        'rolesName' => $resultRolesName['role'],
                        'roleid' => $get_user_role->user_role_id,
                    ]
                );
            }    
            else {
                $message = get_messages("Seems like user not exists in our system. ", 0);
                Session::flash('message', $message);
                return redirect()->route('users.index');
            }
        } else {     
        $message = get_messages("Don't have Access Rights for this Functionality", 0);
                Session::flash('message', $message);
                return redirect('/index');
        }    
    }
}