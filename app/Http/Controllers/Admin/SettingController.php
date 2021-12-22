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
        $setting = $this->parentModel::first();
        if (empty($setting)) {
            $setting = new $this->parentModel;
        }

        //general tab
        $setting->system_name = $request->system_name;
        $setting->system_mail = $request->system_mail;
        $setting->system_phone = $request->system_phone;
        $setting->date_format = $request->date_format;
        $setting->address_1 = $request->address_1;
        $setting->address_2 = $request->address_2;
        if ($request->hasFile('large_logo')) {
            $large_logo = $request->large_logo;
            $temporaryName = time() . $large_logo->getClientOriginalName();
            $large_logo->move(public_path('/upload/settings/'), $temporaryName);
            $setting->large_logo = 'upload/large_logo/' . $temporaryName;
        }
        if ($request->hasFile('small_logo')) {
            $small_logo = $request->small_logo;
            $temporaryName = time() . $small_logo->getClientOriginalName();
            $small_logo->move(public_path('/upload/settings/'), $temporaryName);
            $setting->small_logo = 'upload/small_logo/' . $temporaryName;
        }

        //smtp tab
        $setting->mail_driver = $request->mail_driver;
        $setting->mail_host = $request->mail_host;
        $setting->mail_port = $request->mail_port;
        $setting->mail_username = $request->mail_username;
        $setting->mail_password = $request->mail_password;
        $setting->mail_encryption = $request->mail_encryption;

        $setting->save();
        $message = get_messages('Settings updated successfully!',1);
        Session::flash('message', $message);
        return redirect()->back();
    }

    // destory record
    public function destroy($id)
    {
    }

}
