<?php

namespace App\Http\Controllers\Home;

use App\webRumahDijual;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListRumah extends Controller
{
    public function index() {
        $rumah = webRumahDijual::all();
        return view('home.rumah.list');
    }
}