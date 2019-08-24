<?php

namespace App\Http\Controllers\Dashboard;

use App\webRumahDijual;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class WebInputRumah extends Controller
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
                return view('dashboard.web-component.input-rumah-dijual');
                break;
        }
    }

    public function list() {
        try {
            $rumah = DB::table('web_rumah_dijual')
                ->select('web_rumah_dijual.id','ms_lister.fullname as lister','nama_rumah','lokasi','detail','harga','gambar')
                ->join('ms_lister','web_rumah_dijual.id_lister','=','ms_lister.id')
                ->where('status','=',0)
                ->get();
            return json_encode($rumah);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function lister() {
        try {
            $rumah = DB::table('ms_lister')
                ->select('id','fullname')
                ->get();

            $result = [];
            foreach ($rumah as $r) {
                $result[] = [
                    'text' => $r->fullname,
                    'value' => $r->id,
                ];
            }
            return json_encode($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function add(Request $request) {
        $gambar = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            $id = Uuid::uuid1()->toString();

            $filename = $id.'.'.$extension;
            Storage::putFileAs('public', $gambar, $filename);

            $rumah = new webRumahDijual();
            $rumah->id_lister = $request->id_lister;
            $rumah->nama_rumah = $request->nama_rumah;
            $rumah->lokasi = $request->lokasi;
            $rumah->detail = $request->detail;
            $rumah->harga = $request->harga;
            $rumah->gambar = $filename;
            $rumah->save();
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function edit() {}

    public function terjual(Request $request) {
        try {
            DB::table('web_rumah_dijual')
                ->where('id','=',$request->id)
                ->update([
                    'status' => 1
                ]);
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
