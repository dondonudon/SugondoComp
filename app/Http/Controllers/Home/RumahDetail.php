<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RumahDetail extends Controller
{
    public function index($id) {
        $rumah = DB::table('web_rumah_dijual')->where('id','=',$id)->first();
        return view('home.rumah.detail')
            ->with('content',$rumah)
            ->with('info',LandingPage::infoLandingPage());
    }
}
