<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\OpenFunction\login;
use App\webGeneralInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebQuote extends Controller
{
    public function index() {
        $segment = \request()->segment(3);
        $permit = login::permission($segment);

        switch ($permit) {
            case 'login':
                return redirect('admin/login');
                break;

            case 'not available':
                return redirect('admin');
                break;

            default:
                return view('dashboard.web-component.quote-of-the-day');
                break;
        }
    }

    public function list() {
        try {
            $result = DB::table('web_general_info')
                ->where('section','=','quote-of-the-day')
                ->first();
            return $result->data;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function save(Request $request) {
        try {
            DB::table('web_general_info')->where('section','=','quote-of-the-day')->delete();

            $data = new webGeneralInfo();
            $data->section = 'quote-of-the-day';
            $data->area = '';
            $data->type = '';
            $data->data = $request->editor;
            $data->save();

            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
