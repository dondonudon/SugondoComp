<?php

namespace App\Http\Controllers\Dashboard;

use App\webGeneralInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class WebVisiMisi extends Controller
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
                $visiMisi = DB::table('web_general_info')
                    ->where('section','=','visi-misi')
                    ->get()->toArray();

                $result = [];
                foreach ($visiMisi as $vm) {
                    if ($vm->area == 'misi') {
                        $result[$vm->area][] = [
                            'id' => $vm->id,
                            'data' => $vm->data,
                        ];
                    } else {
                        $result[$vm->area][$vm->type] = $vm->data;
                    }
                }
                return view('dashboard.web-component.visi_misi')->with('info',$result);
                break;
        }
    }

    public function indexVisiImage() {
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
                return view('dashboard.web-component.visi_misi-visi_ganti_gambar');
                break;
        }
    }

    public function indexVisiText() {
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
                $visi = DB::table('web_general_info')
                    ->where([
                        ['section','=','visi-misi'],
                        ['area','=','visi'],
                        ['type','=','text'],
                    ])
                    ->first();
                return view('dashboard.web-component.visi_misi-visi_edit_text')->with('info',$visi);
                break;
        }
    }

    public function indexMisiText() {
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
                return view('dashboard.web-component.visi_misi-misi_add');
                break;
        }
    }

    public function visiImageUpload(Request $request) {
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            Storage::disk('public')->delete(['visi-bg.jpg','visi-bg.png']);

            $fileName = 'visi-bg.'.$extension;
            Storage::putFileAs('public', $file, $fileName);

            webGeneralInfo::updateOrCreate(
                ['section' => 'visi-misi', 'area' => 'visi', 'type' => 'image'],
                ['data' => $fileName]
            );
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }

        return 'success';
    }

    public function visiTextEdit(Request $request) {
        $visi = $request->visi;

        try {
            webGeneralInfo::updateOrCreate(
                ['section' => 'visi-misi', 'area' => 'visi', 'type' => 'text'],
                ['data' => $visi]
            );
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
        return 'success';
    }

    public function misiTextEdit(Request $request) {
        $misiData = $request->misi;

        try {
            $misi = new webGeneralInfo();
            $misi->section = 'visi-misi';
            $misi->area = 'misi';
            $misi->type = 'text';
            $misi->data = $misiData;
            $misi->save();
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
        return 'success';
    }

    public function misiTextDelete(Request $request) {
        $id = $request->id;

        try {
            DB::table('web_general_info')
                ->where('id','=',$id)
                ->delete();
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
        return 'success';
    }
}
