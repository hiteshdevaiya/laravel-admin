<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', function () {
    return redirect('admin/dashboard');
});

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
	// Route::group(['namespace' => 'Admin'], function () {
        Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('profile', [App\Http\Controllers\Admin\UserController::class, 'profile'])->name('admin.profile');
       
        $paths = array(
            'modules'         => App\Http\Controllers\Admin\ModuleController::class,
            'roles'           => App\Http\Controllers\Admin\RoleController::class,
            'users'           => App\Http\Controllers\Admin\UserController::class,
            'settings'        => App\Http\Controllers\Admin\SettingController::class,
        );
        
        foreach($paths as $slug => $controller)
        {
            Route::get('/'.$slug, [$controller, 'index'])->name($slug);
            Route::post('/'.$slug.'/list', [$controller, 'list'])->name($slug.'.list');
            Route::delete('/'.$slug.'/delete/', [$controller, 'destroy'])->name($slug.'.delete');
            Route::get('/'.$slug.'/form', [$controller, 'form'])->name($slug.'.form');
            Route::post('/'.$slug.'/store/', [$controller, 'store'])->name($slug.'.store');
        }
    // });
});