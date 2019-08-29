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
        ->with('info',\App\Http\Controllers\Home\LandingPage::infoLandingPage());
});

Route::get('aktivitas-kita/{id}', 'Home\AktivitasKita@index');
Route::get('aktivitas-kita', 'Home\AktivitasKita@list');
Route::get('rumah-dijual/detail/{id}', 'Home\RumahDetail@index');
Route::get('rumah-dijual', 'Home\ListRumah@index');

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
Route::get('admin/web-component/our-team/edit/{id}', 'Dashboard\WebOurTeam_editdata@index');
Route::get('admin/web-component/our-team/edit-gambar/{id}', 'Dashboard\WebOurTeam_editgambar@index');
Route::post('admin/web-component/our-team/submit-edit-gambar', 'Dashboard\WebOurTeam_editgambar@submit');
Route::post('admin/web-component/our-team/submit-edit-data', 'Dashboard\WebOurTeam_editdata@submit');
Route::post('admin/web-component/our-team/delete', 'Dashboard\WebOurTeam@delete');

Route::get('admin/web-component/top-marketer', 'Dashboard\WebTopMarketer@index');
Route::post('admin/web-component/top-marketer/list', 'Dashboard\WebTopMarketer@list');
Route::post('admin/web-component/top-marketer/list-marketer', 'Dashboard\WebTopMarketer@listMarketer');
Route::post('admin/web-component/top-marketer/add', 'Dashboard\WebTopMarketer@add');
Route::post('admin/web-component/top-marketer/delete', 'Dashboard\WebTopMarketer@delete');

Route::get('admin/web-component/favorite-marketer', 'Dashboard\WebFavoriteMarketer@index');
Route::post('admin/web-component/favorite-marketer/list', 'Dashboard\WebFavoriteMarketer@list');
Route::post('admin/web-component/favorite-marketer/list-marketer', 'Dashboard\WebFavoriteMarketer@listMarketer');
Route::post('admin/web-component/favorite-marketer/add', 'Dashboard\WebFavoriteMarketer@add');
Route::post('admin/web-component/favorite-marketer/delete', 'Dashboard\WebFavoriteMarketer@delete');

Route::get('admin/web-component/aktivitas-kita', 'Dashboard\WebAktivitasKita@index');
Route::post('admin/web-component/aktivitas-kita/list', 'Dashboard\WebAktivitasKita@list');
Route::post('admin/web-component/aktivitas-kita/add', 'Dashboard\WebAktivitasKita@add');
Route::get('admin/web-component/aktivitas-kita/edit-data/{id}', 'Dashboard\WebAktivitasKita_editdata@index');
Route::get('admin/web-component/aktivitas-kita/edit-gambar/{id}', 'Dashboard\WebAktivitasKita_editgambar@index');
Route::post('admin/web-component/aktivitas-kita/submit-edit-data', 'Dashboard\WebAktivitasKita_editdata@submit');
Route::post('admin/web-component/aktivitas-kita/submit-edit-gambar', 'Dashboard\WebAktivitasKita_editgambar@submit');
Route::post('admin/web-component/aktivitas-kita/hide', 'Dashboard\WebAktivitasKita@hide');

Route::get('admin/web-component/contact-us', 'Dashboard\WebContactUs@index');
Route::post('admin/web-component/contact-us/list', 'Dashboard\WebContactUs@list');
Route::post('admin/web-component/contact-us/submit', 'Dashboard\WebContactUs@submit');

Route::get('admin/web-component/input-rumah-dijual', 'Dashboard\WebInputRumah@index');
Route::post('admin/web-component/input-rumah-dijual/list', 'Dashboard\WebInputRumah@list');
Route::post('admin/web-component/input-rumah-dijual/lister', 'Dashboard\WebInputRumah@lister');
Route::post('admin/web-component/input-rumah-dijual/add', 'Dashboard\WebInputRumah@add');
Route::get('admin/web-component/input-rumah-dijual/edit-data/{id}', 'Dashboard\WebInputRumah_editdata@index');
Route::get('admin/web-component/input-rumah-dijual/edit-gambar/{id}', 'Dashboard\WebInputRumah_editgambar@index');
Route::post('admin/web-component/input-rumah-dijual/submit-edit-data', 'Dashboard\WebInputRumah_editdata@submit');
Route::post('admin/web-component/input-rumah-dijual/submit-edit-gambar', 'Dashboard\WebInputRumah_editgambar@submit');
Route::post('admin/web-component/input-rumah-dijual/terjual', 'Dashboard\WebInputRumah@terjual');
