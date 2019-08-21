<?php

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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.layout');
});

Route::get('admin', 'Dashboard\overview@index');

Route::get('admin/login', 'Dashboard\login@index');
Route::post('admin/login/submit', 'Dashboard\login@submit');

Route::get('admin/system-utility/menu-group', 'Dashboard\SysMenuGroupController@index');
Route::post('admin/system-utility/menu-group/list', 'Dashboard\SysMenuGroupController@list');
Route::post('admin/system-utility/menu-group/add', 'Dashboard\SysMenuGroupController@add');
Route::post('admin/system-utility/menu-group/edit', 'Dashboard\SysMenuGroupController@edit');

Route::get('admin/system-utility/menu', 'Dashboard\SysMenuController@index');
Route::post('admin/system-utility/menu/list', 'Dashboard\SysMenuController@list');
Route::post('admin/system-utility/menu/group', 'Dashboard\SysMenuController@group');
Route::post('admin/system-utility/menu/add', 'Dashboard\SysMenuController@add');
Route::post('admin/system-utility/menu/edit', 'Dashboard\SysMenuController@edit');
Route::post('admin/system-utility/menu/delete', 'Dashboard\SysMenuController@delete');

Route::get('admin/master-data/user-management', 'Dashboard\MsUserManagementController@index');
Route::post('admin/master-data/user-management/list', 'Dashboard\MsUserManagementController@list');
Route::post('admin/master-data/user-management/add', 'Dashboard\MsUserManagementController@add');
Route::post('admin/master-data/user-management/edit', 'Dashboard\MsUserManagementController@edit');
Route::post('admin/master-data/user-management/reset', 'Dashboard\MsUserManagementController@reset');
Route::post('admin/master-data/user-management/user-permission', 'Dashboard\MsUserManagementController@userPermission');

Route::get('admin/user-profile/edit', 'Dashboard\UserprofileEditController@index');
Route::post('admin/user-profile/edit/list', 'Dashboard\UserprofileEditController@list');
Route::post('admin/user-profile/edit/edit', 'Dashboard\UserprofileEditController@edit');

Route::get('admin/web-component/about-us', 'Dashboard\WebAboutUsController@index');
Route::post('admin/web-component/about-us/save', 'Dashboard\WebAboutUsController@save');
Route::post('admin/web-component/about-us/list', 'Dashboard\WebAboutUsController@list');
Route::post('admin/web-component/about-us/editor', 'Dashboard\WebAboutUsController@editorData');
Route::post('admin/web-component/about-us/upload', 'Dashboard\WebAboutUsController@upload');
