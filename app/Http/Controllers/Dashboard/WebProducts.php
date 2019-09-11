<?php

namespace App\Http\Controllers\Dashboard;

use App\m_WebProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WebProducts extends Controller
{
    public function index()
    {
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
                $product = m_WebProduct::all();
                return view('dashboard.web-component.products')->with('info',$product);
                break;
        }
    }

    public function add() {
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
                return view('dashboard.web-component.products-add');
                break;
        }
    }

    public function editContent($id) {
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
                $data = DB::table('web_products')->where('id','=',$id)->first();
                return view('dashboard.web-component.products-edit')->with('info',$data);
                break;
        }
    }

    public function addSubmit(Request $request) {
        $gambar = $request->file('filepond');
        $extension = $gambar->getClientOriginalExtension();
        $judul = $request->judul;
        $url = $request->url;
        $content = $request->productContent;

        try {
            $filename = $url.'.'.$extension;
            Storage::putFileAs('public',$gambar,$filename);

            $product = new m_WebProduct();
            $product->judul = $judul;
            $product->gambar = $filename;
            $product->url = $url;
            $product->content = $content;
            $product->save();
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }

        return 'success';
    }

    public function editSubmit(Request $request) {
        $id = $request->id;
        $judul = $request->judul;
        $url = $request->url;
        $content = $request->productContent;

        try {
            DB::table('web_products')
                ->where('id','=',$id)
                ->update([
                    'judul' => $judul,
                    'url' => $url,
                    'content' => $content,
                ]);
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }

        return 'success';
    }

    public function gantiGambar($id) {
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
                $data = DB::table('web_products')->where('id','=',$id)->first();
                return view('dashboard.web-component.products-edit-gambar')->with('info',$data);
                break;
        }
    }

    public function gantiGambarSubmit(Request $request) {
        $id = $request->id;
        $gambar = $request->file('filepond');
        $extension = $gambar->getClientOriginalExtension();

        $product = DB::table('web_products')->where('id','=',$id)->first();

        try {
            $filename = $product->url.'.'.$extension;
            Storage::disk('public')->delete($product->gambar);
            Storage::putFileAs('public',$gambar,$filename);

            DB::table('web_products')
                ->where('id','=',$id)
                ->update([
                    'gambar' => $filename,
                ]);
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }

        return 'success';
    }

    public function delete(Request $request) {
        $id = $request->id;

        try {
            DB::table('web_products')->where('id','=',$id)->delete();
        } catch (\Exception $ex) {
            dd('Exception Block',$ex);
        }
        return 'success';
    }
}
