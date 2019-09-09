<?php

namespace App\Http\Controllers\Home;

use App\webGeneralInfo;
use App\webImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LandingPage extends Controller
{
    public static function infoLandingPage() {
        $result = [];

        try {
            $generalInfo = DB::table('web_general_info')
                ->select('section', 'area', 'type', 'data')
                ->get();
            foreach ($generalInfo as $c) {
                $result[$c->section][$c->area][] = [
                    'type' => $c->type,
                    'data' => $c->data,
                ];
            }

            return $result;
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
    }
}
