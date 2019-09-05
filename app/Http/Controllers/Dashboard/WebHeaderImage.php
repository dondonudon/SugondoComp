<?php

namespace App\Http\Controllers\Dashboard;

use App\webImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class WebHeaderImage extends Controller
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
                $image = DB::table('web_image')->where('section','header-section')->first();
                $info['image'] = $image->filename;
                $data = DB::table('web_general_info')
                    ->select('area','data')
                    ->where('section','=','header-section')->get()->toArray();
                foreach ($data as $d) {
                    $info[$d->area] = $d->data;
                }
                return view('dashboard.web-component.header-section')->with('info',$info);
                break;
        }
    }

    public function editData() {
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
                $info = [];
                $data = DB::table('web_general_info')
                    ->select('area','data')
                    ->where('section','=','header-section')
                    ->get()->toArray();
                foreach ($data as $d) {
                    $info[$d->area] = $d->data;
                }
                return view('dashboard.web-component.header-section_edit-data')->with('info',$info);
                break;
        }
    }

    public function editDataSubmit(Request $request) {
        $tagline = $request->tagline;
        $deskripsi = $request->deskripsi;

        try {
            DB::table('web_general_info')
                ->where([
                    ['section','=','header-section'],
                    ['area','=','tagline'],
                ])
                ->update([
                    'data' => $tagline
                ]);
            DB::table('web_general_info')
                ->where([
                    ['section','=','header-section'],
                    ['area','=','deskripsi-singkat'],
                ])
                ->update([
                    'data' => $deskripsi
                ]);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
        return 'success';
    }

    public function editImage() {
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
                $info = [];
                $data = DB::table('web_general_info')
                    ->select('area','data')
                    ->where('section','=','header-section')
                    ->get()->toArray();
                foreach ($data as $d) {
                    $info[$d->area] = $d->data;
                }
                return view('dashboard.web-component.header-section_edit-gambar')->with('info',$info);
                break;
        }
    }

    public function editImageSubmit(Request $request) {
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            $filename = Uuid::uuid1()->toString().'.'.$extension;
            $team = DB::table('web_image')->where('section','=','header-section')->first();

            Storage::disk('public')->delete($team->filename);
            Storage::putFileAs('public',$file,$filename);

            DB::table('web_image')->where('section','=','header-section')->update(['filename' => $filename]);

        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
        return 'success';
    }
}
