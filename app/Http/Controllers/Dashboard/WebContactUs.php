<?php

namespace App\Http\Controllers\Dashboard;

use App\webGeneralInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebContactUs extends Controller
{
    public function index() {
        $segment = \request()->segment(3);
        $permit = \App\Http\Controllers\OpenFunction\login::permission($segment);

        switch ($permit) {
            case 'login':
                return redirect('admin/login');
                break;

            case 'not available':
                return redirect('admin');
                break;

            default:
                return view('dashboard.web-component.contact-us');
                break;
        }
    }

    public function list() {
        try {
            $about = DB::table('web_general_info')
                ->where('section','=','contact-us')
                ->orderBy('created_at','asc')
                ->get();
            $result = [];
            foreach ($about as $a) {
                $result[$a->area] = $a->data;
            }
            return json_encode($result);
//            return $about->toJson();
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function submit(Request $request) {
        $data = [
            'info_perusahaan' => $request->info_perusahaan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
        ];
        try {
            foreach ($data as $i => $v) {
                webGeneralInfo::updateOrCreate(
                    ['section' => 'contact-us', 'area' => $i, 'type' => ''],
                    [ 'data' => $v]
                );
            }
            return 'success';
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
    }
}
