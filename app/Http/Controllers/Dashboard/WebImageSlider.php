<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\OpenFunction\login;
use App\webImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class WebImageSlider extends Controller
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
                return view('dashboard.web-component.image-slider');
                break;
        }
    }

    public function list() {
        try {
            $images = DB::table('web_image')
                ->select('id','filename')
                ->where('section','=','image-slider')
                ->orderBy('created_at','asc')
                ->get();
            return json_encode($images);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function upload(Request $request) {
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            $id = Uuid::uuid1()->toString();
            $fileName = $id.'.'.$extension;

            Storage::putFileAs('public', $file, $fileName);

            $image = new webImages();
            $image->section = 'image-slider';
            $image->area = '';
            $image->filename = $fileName;
            $image->info = '';
            $image->save();
        } catch (\Exception $ex) {
            return response()->json($ex);
        }

        return 'success';
    }

    public function delete(Request $request) {
        try {
            $image = DB::table('web_image')->where('id','=',$request->id)->first();
            Storage::disk('public')->delete($image->filename);
            DB::table('web_image')->where('id','=',$request->id)->delete();
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
