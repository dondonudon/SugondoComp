<?php

namespace App\Http\Controllers\Home;

use App\webGeneralInfo;
use App\webImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LandingPage extends Controller
{
    public static function aboutUs() {
        try {
            $image = DB::table('web_image')->where('section','=','about-us')->first();
            $text = DB::table('web_general_info')->where('section','=','about-us')->first();

            $result = [
                'image' => $image->filename,
                'text' => $text->data,
            ];

            return $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public static function quote() {
        try {
            $text = DB::table('web_general_info')->where('section','=','quote-of-the-day')->first();

            $result = [
                'text' => isset($text->data)?$text->data:'',
            ];

            return $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public static function ourteam() {
        try {
            $text = DB::table('web_our_team')->get();

            return $text;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
