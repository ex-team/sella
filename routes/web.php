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


Route::pattern('slug', '[a-z0-9- _]+');

//Route::group([ 'namespace'=>'Admin'], function () {

// Lock screen
Route::get('{id}/lockscreen', 'UsersController@lockscreen')->name('lockscreen');
Route::post('{id}/lockscreen', 'UsersController@postLockscreen')->name('lockscreen');
// All basic routes defined here
Route::get('login', 'AuthController@getSignin')->name('login');
Route::get('signin', 'AuthController@getSignin')->name('signin');
Route::post('signin', 'AuthController@postSignin')->name('postSignin');
Route::post('signup', 'AuthController@postSignup')->name('signup');
Route::post('forgot-password', 'AuthController@postForgotPassword')->name('signup');


// Forgot Password Confirmation
Route::get('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm')->name('forgot-password-confirm');
Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm');

// Logout
Route::get('logout', 'AuthController@getLogout')->name('logout');

// Account Activation
Route::get('activate/{userId}/{activationCode}', 'AuthController@getActivate')->name('activate');
//});


Route::group(['middleware' => 'admin'], function () {

        //  Dashboard / Index
        Route::get('/', 'JoshController@showHome')->name('dashboard');

        //  User Management
        Route::group(['prefix' => 'users'], function () {
                Route::get('data', 'UsersController@data')->name('users.data');
                Route::get('{user}/delete', 'UsersController@destroy')->name('users.delete');
                Route::get('{user}/confirm-delete', 'UsersController@getModalDelete')->name('users.confirm-delete');
                Route::get('{user}/restore', 'UsersController@getRestore')->name('restore.user');
                Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
            }
        );
        Route::resource('users', 'UsersController');
        Route::get('deleted_users', ['before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'])->name('deleted_users');

        // Role Management
        Route::group(
            ['prefix' => 'roles'], function () {
                Route::get('{role}/delete', 'RolesController@destroy')->name('roles.delete');
                Route::get('{role}/confirm-delete', 'RolesController@getModalDelete')->name('roles.confirm-delete');
                Route::get('{role}/restore', 'RolesController@getRestore')->name('roles.restore');
            }
        );
        Route::resource('roles', 'RolesController');

        // Pegawai Management
        Route::get('pegawais', 'PegawaiController@index')->name('pegawais.index');
        Route::post('pegawais', 'PegawaiController@store')->name('pegawais.store');
        Route::get('pegawais/create', 'PegawaiController@create')->name('pegawais.create');
        Route::put('pegawais/{pegawais}', 'PegawaiController@update')->name('pegawais.update');
        Route::patch('pegawais/{pegawais}',  'PegawaiController@update')->name('pegawais.update');
        Route::get('pegawais/{id}/delete',  'PegawaiController@getDelete')->name('pegawais.delete');
        Route::get('pegawais/{id}/confirm-delete','PegawaiController@getModalDelete')->name('pegawais.confirm-delete');
        Route::get('pegawais/{pegawais}', 'PegawaiController@show')->name('pegawais.show');
        Route::get('pegawais/{pegawais}/edit','PegawaiController@edit')->name('pegawais.edit');

        // import & export data pegawai
        Route::post('pegawais/file-import', 'PegawaiController@importPegawai')->name('pegawais.import');
        Route::get('pegawais/file-export', 'PegawaiController@exportPegawai')->name('pegawais.export');
        Route::get('pegawais/pdf-export', 'PegawaiController@exportPDF')->name('pegawais.pdf');
        Route::get('pegawais/download/{type}', 'PegawaiController@downloadExcel')->name('pegawais.template');


        // Perangkat Management
        Route::get('perangkats', 'PerangkatController@index')->name('perangkats.index');
        Route::post('perangkats', 'PerangkatController@store')->name('perangkats.store');
        Route::get('perangkats/create', 'PerangkatController@create')->name('perangkats.create');
        Route::put('perangkats/{perangkats}', 'PerangkatController@update')->name('perangkats.update');
        Route::patch('perangkats/{perangkats}',  'PerangkatController@update')->name('perangkats.update');
        Route::get('perangkats/{id}/delete',  'PerangkatController@getDelete')->name('perangkats.delete');
        Route::get('perangkats/{id}/confirm-delete','PerangkatController@getModalDelete')->name('perangkats.confirm-delete');
        Route::get('perangkats/{perangkats}', 'PerangkatController@show')->name('perangkats.show');
        Route::get('perangkats/{perangkats}/edit','PerangkatController@edit')->name('perangkats.edit');

        // import & export data perangkat
        Route::post('perangkats/file-import', 'PerangkatController@importPerangkat')->name('perangkats.import');
        Route::get('perangkats/file-export', 'PerangkatController@exportPerangkat')->name('perangkats.export');
        Route::get('perangkats/pdf-export', 'PerangkatController@exportPDF')->name('perangkats.pdf');
        Route::get('perangkats/download/{type}', 'PerangkatController@downloadExcel')->name('perangkats.template');


        // Peminjaman Management
        Route::get('peminjaman', 'PeminjamanController@index')->name('peminjaman.index');
        Route::post('peminjaman', 'PeminjamanController@store')->name('peminjaman.store');
        Route::get('peminjaman/create', 'PeminjamanController@create')->name('peminjaman.create');
        Route::put('peminjaman/{peminjaman}', 'PeminjamanController@update')->name('peminjaman.update');
        Route::patch('peminjaman/{peminjaman}',  'PeminjamanController@update')->name('peminjaman.update');
        Route::get('peminjaman/{id}/delete',  'PeminjamanController@getDelete')->name('peminjaman.delete');
        Route::get('peminjaman/{id}/confirm-delete','PeminjamanController@getModalDelete')->name('peminjaman.confirm-delete');
        Route::get('peminjaman/{peminjaman}', 'PeminjamanController@show')->name('peminjaman.show');
        Route::get('peminjaman/{peminjaman}/edit','PeminjamanController@edit')->name('peminjaman.edit');


        Route::get('{name?}', 'JoshController@showView');

    }
);

// Remaining pages will be called from below controller method
// in real world scenario, you may be required to define all routes manually

Route::get('activate/{userId}/{activationCode}', 'FrontEndController@getActivate')->name('activate');
Route::get('forgot-password', 'FrontEndController@getForgotPassword')->name('forgot-password');
Route::post('forgot-password', 'FrontEndController@postForgotPassword');

// Forgot Password Confirmation
Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
Route::get('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@getForgotPasswordConfirm')->name('forgot-password-confirm');
