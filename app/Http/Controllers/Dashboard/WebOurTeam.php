<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\OpenFunction\login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class WebOurTeam extends Controller
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
                return view('dashboard.web-component.our-team');
                break;
        }
    }

    public function list() {
        try {
            $result['data'] = \App\webOurTeam::all();
            return json_encode($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function submit(Request $request) {
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            $id = Uuid::uuid1()->toString();
            $filename = $id.'.'.$extension;

            Storage::putFileAs('public',$file,$filename);

            $team = new \App\webOurTeam();
            $team->fullname = $request->fullname;
            $team->jabatan = $request->jabatan;
            $team->foto = $filename;
            $team->save();

            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function edit(Request $request) {
        $id = $request->id;
        $fullname = $request->fullname;
        $jabatan = $request->jabatan;

        try {
            DB::table('web_our_team')->where('id','=',$id)
                ->update([
                    'fullname' => $fullname,
                    'jabatan' => $jabatan,
                ]);
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function editGambar(Request $request) {
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();
    }

    public function delete(Request $request) {
        $id = $request->id;

        try {
            $team = DB::table('web_our_team')->where('id','=',$id)->first();
            Storage::disk('public')->delete($team->foto);
            DB::table('web_our_team')->where('id','=',$id)->delete();
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
