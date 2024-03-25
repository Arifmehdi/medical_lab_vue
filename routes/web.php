<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // return view('auth.admin.login');
});

Route::get('/auth', function () {
    return view('auth.admin.login');
});

//login admin
// Route::group(['namespace'=>'Auth','prefix'=>'admin/auth','middleware'=>'AdminGuest','as'=>'admin.auth.'],function(){
// Route::group(['namespace'=>'Auth','prefix'=>'admin/auth','as'=>'admin.auth.'],function(){
//     Route::get('/login','AdminController@login')->name('login');
//     Route::post('/login','AdminController@login_submit')->name('login_submit');
// });

// //logout admin
// Route::post('admin/logout','Auth\AdminController@logout')->name('admin.logout')->middleware('Admin');

// //reset admin users password
Route::group(['namespace'=>'Auth','prefix'=>'admin/reset','as'=>'admin.reset.'],function(){
    Route::get('/mail','AdminController@mail')->name('mail');
    Route::post('/mail_submit','AdminController@mail_submit')->name('mail_submit');
    Route::get('/reset_password_form/{token}','AdminController@reset_password_form')->name('reset_password_form');
    Route::post('/reset_password_submit','AdminController@reset_password_submit')->name('reset_password_submit');
});


Route::get('/login',[AdminController::class,'login'])->name('login');
Route::post('/login',[AdminController::class,'login_submit'])->name('admin.auth.login_submit');

    //dashboard
    Route::get('/dashboard',[IndexController::class,'index'])->name('index');

        // //tests and its components
        // Route::resource('tests','TestsController');
        // Route::get('get_tests','TestsController@ajax')->name('get_tests');//datatable

        Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
            Route::resource('tests', 'TestsController');
            Route::get('get_tests', 'TestsController@ajax')->name('get_tests');
        });

        Route::get('change_locale/{lang}',[App\Http\Controllers\HomeController::class, 'change_locale'])->name('change_locale');
// Auth::routes();
// admin.auth.login_submit

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
