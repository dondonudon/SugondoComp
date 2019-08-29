<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\OpenFunction\login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class WebOurTeam_editgambar extends Controller
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
                return view('dashboard.web-component.our-team-edit-gambar')
                    ->with('data',$data);
                break;
        }
    }

    public function submit(Request $request) {
        $id = $request->id;
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            $filename = Uuid::uuid1()->toString().'.'.$extension;
            $team = DB::table('web_our_team')->where('id','=',$id)->first();

            Storage::disk('public')->delete($team->foto);
            Storage::putFileAs('public',$file,$filename);

            DB::table('web_our_team')->where('id','=',$id)->update(['foto' => $filename]);

            return 'success';
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
    }
}
