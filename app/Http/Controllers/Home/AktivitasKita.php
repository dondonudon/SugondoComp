<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AktivitasKita extends Controller
{
    public function index($id) {
        $result = [];
        $generalInfo = DB::table('web_general_info')
            ->select('web_general_info.section', 'web_general_info.area', 'web_general_info.type', 'web_general_info.data', 'web_image.filename')
            ->leftJoin('web_image','web_general_info.section','=','web_image.section')
            ->where('web_general_info.section','=','contact-us')
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
        $activity = DB::table('web_aktivitas_kita')->where('id','=',$id)->first();
        return view('home.blog.detail')
            ->with('content',$activity)
            ->with('info',$result);
    }

    public function list() {
        $result = [];
        $generalInfo = DB::table('web_general_info')
            ->select('web_general_info.section', 'web_general_info.area', 'web_general_info.type', 'web_general_info.data', 'web_image.filename')
            ->leftJoin('web_image','web_general_info.section','=','web_image.section')
            ->where('web_general_info.section','=','contact-us')
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
        $activity = DB::table('web_aktivitas_kita')->orderBy('created_at','desc')->get();
        return view('home.blog.show-all')
            ->with('aktivitas_kita',$activity)
            ->with('info',$result);
    }
}
