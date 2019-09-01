<?php

namespace App\Http\Controllers\Home;

use App\webRumahDijual;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListRumah extends Controller
{
    public function index() {
        $generalInfo = DB::table('web_general_info')
            ->select('web_general_info.section', 'web_general_info.area', 'web_general_info.type', 'web_general_info.data', 'web_image.filename')
            ->leftJoin('web_image','web_general_info.section','=','web_image.section')
            ->get();
        foreach ($generalInfo as $c) {
            if ($c->section == 'contact-us') {
                $result['contact-us'][$c->area] = $c->data;
            } else {
                $result[$c->section] = [
                    'area' => $c->area,
                    'type' => $c->type,
                    'data' => $c->data,
                    'filename' => $c->filename,
                ];
            }
        }

        $result['rumah-dijual'] = DB::table('web_rumah_dijual')
            ->where('status','=',0)
            ->orderBy('created_at','desc')
            ->get()->toArray();

        $rumah = webRumahDijual::all();
        return view('home.rumah.list')
            ->with('info',$result);
    }
}
