<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class SettingController extends Controller
{
    public $parentModel = Settings::class;
    public $parentRoute = 'settings';
    public $parentView = "admin.settings";

    public function __construct()
    {

    }

    public function index()
    {
        $edit = Settings::first();
        return view($this->parentView.'.index',['edit' => $edit]);
    }

    // get listing record in datatable
    public function list(Request $request)
    {
    }

    // create and edit form
    public function form(Request $request)
    {
    }

    // crud operation
    public function store(Request $request)
    {
        //general tab
        if(isset($request->type) && $request->type == "general")
        {
            $get = getGeneralSetting();

            $update = $this->parentModel::where('name', 'GENERAL')->first();
            if(empty($update)){
                $update = new $this->parentModel;
                $update->name = 'GENERAL';
            }
            if ($request->hasFile('large_logo')) {
                $large_logo = $request->large_logo;
                $temporaryName = time() . $large_logo->getClientOriginalName();
                $large_logo->move(public_path('/upload/settings/'), $temporaryName);
                $large_logo_name = 'upload/settings/' . $temporaryName;
            }else{ 
                $large_logo_name = isset($get['large_logo']) ? $get['large_logo'] : '';
            }
            if ($request->hasFile('small_logo')) {
                $small_logo = $request->small_logo;
                $temporaryName = time() . $small_logo->getClientOriginalName();
                $small_logo->move(public_path('/upload/settings/'), $temporaryName);
                $small_logo_name = 'upload/settings/' . $temporaryName;
            }else{
                $small_logo_name = isset($get['small_logo']) ? $get['small_logo'] : '';
            }
            $data = array(
                'system_name' => $request->system_name,
                'system_mail' => $request->system_mail,
                'system_phone' => $request->system_phone,
                'date_format' => $request->date_format,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'large_logo' => isset($large_logo_name) ? $large_logo_name : '',
                'small_logo' => isset($small_logo_name) ? $small_logo_name : ''
            );
            $update->content = json_encode($data);
            $update->save();
        }

        //smtp tab
        if(isset($request->type) && $request->type == "smtp")
        {
            $update = $this->parentModel::where('name', 'SMTP')->first();
            if(empty($update)){
                $update = new $this->parentModel;
                $update->name = 'SMTP';
            }
            $data = array(
                'mail_driver' => $request->mail_driver,
                'mail_host' => $request->mail_host,
                'mail_port' => $request->mail_port,
                'mail_username' => $request->mail_username,
                'mail_password' => $request->mail_password,
                'mail_encryption' => $request->mail_encryption
            );
            $update->content = json_encode($data);
            $update->save();
        }

        $message = get_messages('Settings updated successfully!',1);
        Session::flash('message', $message);
        return redirect()->back();
    }

    // destory record
    public function destroy($id)
    {
    }

}
