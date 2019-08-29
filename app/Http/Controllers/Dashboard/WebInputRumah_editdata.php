<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\OpenFunction\login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WebInputRumah_editdata extends Controller
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
                $data = DB::table('web_rumah_dijual')->where('id','=',$id)->first();
                return view('dashboard.web-component.input-rumah-dijual-edit-data')
                    ->with('data',$data);
                break;
        }
    }

    public function submit(Request $request) {
        $id = $request->id;
        $data = [
            'id_lister' => $request->id_lister,
            'nama_rumah' => $request->nama_rumah,
            'lokasi' => $request->lokasi,
            'detail' => $request->detail,
            'harga' => $request->harga,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'lantai' => $request->lantai,
            'kamar_tidur' => $request->kamar_tidur,
            'kamar_mandi' => $request->kamar_mandi,
            'dapur_bersih' => $request->dapur_bersih,
            'dapur_kotor' => $request->dapur_kotor,
            'taman' => $request->taman,
            'arah_rumah' => $request->arah_rumah,
            'listrik' => $request->listrik,
            'furniture' => $request->furniture,
        ];

        try {
            DB::table('web_rumah_dijual')
                ->where('id','=',$id)
                ->update($data);
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
        return 'success';
    }
}
