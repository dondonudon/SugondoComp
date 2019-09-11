<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Product extends Controller
{
    public function index($url) {
        $result = [];

        try {
            $product = DB::table('web_products')->where('url','=',$url)->first();

            $generalInfo = DB::table('web_general_info')
                ->select('section', 'area', 'type', 'data')
                ->get();
            foreach ($generalInfo as $c) {
                $result[$c->section][$c->area][] = [
                    'type' => $c->type,
                    'data' => $c->data,
                ];
            }
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }

        return view('home.produk.single')->with('prod',$product)->with('info',$result);
    }
}
