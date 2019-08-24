<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebTopMarketer extends Controller
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
                return view('dashboard.web-component.top-marketer');
                break;
        }
    }

    public function list() {
        try {
            $result = DB::table('web_top_marketer')
                ->select('web_top_marketer.id','web_top_marketer.id_marketer','ms_marketer.fullname')
                ->join('ms_marketer','ms_marketer.id','=','web_top_marketer.id_marketer')
                ->get();
            return json_encode($result);
        } catch (\Exception $ex) {
            dd('Exception Block', $ex);
        }
    }

    public function listMarketer() {
        $result = [];
        try {
            $marketer = DB::table('ms_marketer')
                ->whereNotIn('id',function ($query) {
                    $query->select('id_marketer')
                        ->from('web_top_marketer');
                })
                ->get();
            foreach ($marketer as $m) {
                $result[] = [
                    'value' => $m->id,
                    'text' => $m->fullname,
                ];
            }
        } catch (\Exception $ex) {
            dd('Exception Block', $ex);
        }
        return json_encode($result);
    }

    public function add(Request $request) {
        try {
            \App\webTopMarketer::create([
                'id_marketer' => $request->id
            ]);
        } catch (\Exception $ex) {
            return json_encode($ex);
        }
        return 'success';
    }

    public function delete(Request $request) {
        $id = $request->id;
        try {
            DB::table('web_top_marketer')->where('id_marketer','=',$id)->delete();
        } catch (\Exception $ex) {
            dd('Exception Block', $ex);
        }
        return 'success';
    }
}
