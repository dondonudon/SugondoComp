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
    return view('home.layout')
        ->with('about_us',\App\Http\Controllers\Home\LandingPage::aboutUs())
        ->with('quote',\App\Http\Controllers\Home\LandingPage::quote())
        ->with('ourteam',\App\Http\Controllers\Home\LandingPage::ourteam());
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

Route::get('admin/master-data/lister', 'Dashboard\MsLister@index');
Route::post('admin/master-data/lister/list', 'Dashboard\MsLister@list');
Route::post('admin/master-data/lister/submit', 'Dashboard\MsLister@submit');
Route::post('admin/master-data/lister/delete', 'Dashboard\MsLister@delete');

Route::get('admin/master-data/marketer', 'Dashboard\MsMarketer@index');
Route::post('admin/master-data/marketer/list', 'Dashboard\MsMarketer@list');
Route::post('admin/master-data/marketer/submit', 'Dashboard\MsMarketer@submit');
Route::post('admin/master-data/marketer/delete', 'Dashboard\MsMarketer@delete');

Route::get('admin/user-profile/edit', 'Dashboard\UserprofileEditController@index');
Route::post('admin/user-profile/edit/list', 'Dashboard\UserprofileEditController@list');
Route::post('admin/user-profile/edit/edit', 'Dashboard\UserprofileEditController@edit');

Route::get('admin/web-component/about-us', 'Dashboard\WebAboutUsController@index');
Route::post('admin/web-component/about-us/save', 'Dashboard\WebAboutUsController@save');
Route::post('admin/web-component/about-us/list', 'Dashboard\WebAboutUsController@list');
Route::post('admin/web-component/about-us/editor', 'Dashboard\WebAboutUsController@editorData');
Route::post('admin/web-component/about-us/upload', 'Dashboard\WebAboutUsController@upload');

Route::get('admin/web-component/quote-of-the-day', 'Dashboard\WebQuote@index');
Route::post('admin/web-component/quote-of-the-day/list', 'Dashboard\WebQuote@list');
Route::post('admin/web-component/quote-of-the-day/save', 'Dashboard\WebQuote@save');

Route::get('admin/web-component/image-slider', 'Dashboard\WebImageSlider@index');
Route::post('admin/web-component/image-slider/list', 'Dashboard\WebImageSlider@list');
Route::post('admin/web-component/image-slider/upload', 'Dashboard\WebImageSlider@upload');
Route::post('admin/web-component/image-slider/delete', 'Dashboard\WebImageSlider@delete');

Route::get('admin/web-component/our-team', 'Dashboard\WebOurTeam@index');
Route::post('admin/web-component/our-team/list', 'Dashboard\WebOurTeam@list');
Route::post('admin/web-component/our-team/submit', 'Dashboard\WebOurTeam@submit');
Route::post('admin/web-component/our-team/edit', 'Dashboard\WebOurTeam@edit');
Route::post('admin/web-component/our-team/delete', 'Dashboard\WebOurTeam@delete');

Route::get('admin/web-component/contact-us', 'Dashboard\WebContactUs@index');
Route::post('admin/web-component/contact-us/list', 'Dashboard\WebContactUs@list');
Route::post('admin/web-component/contact-us/submit', 'Dashboard\WebContactUs@submit');
