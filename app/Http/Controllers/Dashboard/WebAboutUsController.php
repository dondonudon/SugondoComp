<?php

namespace App\Http\Controllers\Dashboard;

use App\webGeneralInfo;
use App\webImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WebAboutUsController extends Controller
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
                return view('dashboard.web-component.about-us');
                break;
        }
    }

    public function list() {
        $result = [];
        try {
            $info = DB::table('web_general_info')->where('section','=','about-us')->get()->toArray();

            foreach ($info as $i) {
                $result[$i->area] = [
                    'type' => $i->type,
                    'data' => $i->data,
                ];
            }
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
        return json_encode($result);
    }

    public function editorData() {
        try {
            $info = DB::table('web_general_info')->where('section','=','about-us')->first();
            return $info->data;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function upload(Request $request) {
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            $fileName = 'about-us.'.$extension;
            Storage::disk('public')->delete(['about-us.jpg','about-us.png']);

            Storage::putFileAs('public', $file, $fileName);

            webGeneralInfo::updateOrCreate(
                ['section' => 'about-us', 'area' => 'image', 'type' => 'image'],
                ['data' => $fileName]
            );
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }

        return 'success';
    }

    public function save(Request $request) {
        $editor = $request->editor;

        try {
            webGeneralInfo::updateOrCreate(
                ['section' => 'about-us', 'area' => 'text', 'type' => 'text'],
                ['data' => $editor]
            );
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }

        return 'success';
    }
}
