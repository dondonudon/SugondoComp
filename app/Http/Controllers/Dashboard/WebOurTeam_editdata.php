<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\OpenFunction\login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebOurTeam_editdata extends Controller
{
    public function index($id) {
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
                $data = DB::table('web_our_team')->where('id','=',$id)->first();
                return view('dashboard.web-component.our-team-edit-data')
                    ->with('data',$data);
                break;
        }
    }

    public function submit(Request $request) {
        $id = $request->id;
        $fullname = $request->fullname;
        $jabatan = $request->jabatan;

        try {
            DB::table('web_our_team')
                ->where('id','=',$id)
                ->update([
                    'fullname' => $fullname,
                    'jabatan' => $jabatan,
                ]);
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
