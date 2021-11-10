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

Route::get('/', function () {
    return redirect('/admin');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {
	// Route::group(['namespace' => 'Admin'], function () {
        Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
       
        $paths = array(
            'modules'         => App\Http\Controllers\Admin\ModuleController::class,
            'roles'           => App\Http\Controllers\Admin\RoleController::class,
            'users'           => App\Http\Controllers\Admin\UserController::class,
        );
        
        foreach($paths as $slug => $controller)
        {
            Route::get('/'.$slug, [$controller, 'index'])->name($slug);
            Route::post('/'.$slug.'/list', [$controller, 'list'])->name($slug.'.list');
            Route::delete('/'.$slug.'/delete/{id}', [$controller, 'destroy'])->name($slug.'.delete');
            Route::get('/'.$slug.'/form', [$controller, 'form'])->name($slug.'.form');
            Route::post('/'.$slug.'/store/', [$controller, 'store'])->name($slug.'.store');
            Route::post('/'.$slug.'/alldeletes', [$controller, 'alldeletes'])->name($slug.'.alldeletes');
        }

    // });
});