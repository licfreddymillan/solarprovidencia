<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\News;
use DB;
use Auth;

class NewController extends Controller
{
    function index()
    {
        if ((Auth::guest()) || (Auth::user()->rol == 2)) {
            $noticias = News::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            return view('user.news')->with(compact('noticias'));
        } else {
            $noticias = News::orderBy('id', 'DESC')->get();
            return view('admin.news')->with(compact('noticias'));
        }
    }

    public function store(Request $request)
    {
        $noticia = new News($request->all());
        $noticia->slug = Str::slug($noticia->title);
        $noticia->status = 1;
        $noticia->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $noticia->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/news', $name);
            $noticia->image = $name;
            $noticia->save();
        }

        return redirect('admin/news')->with('store-msj', '1');
    }

    public function show($slug, $id)
    {
        $noticia = News::find($id);

        $otrasNoticias = News::where('status', '=', 1)
            ->where('id', '<>', $id)
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();

        return view('user.showNew')->with(compact('noticia', 'otrasNoticias'));
    }

    public function update(Request $request)
    {
        $noticia = News::find($request->new_id);
        $noticia->fill($request->all());
        $noticia->slug = Str::slug($noticia->title);
        $noticia->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $noticia->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/news', $name);
            $noticia->image = $name;
            $noticia->save();
        }
        return redirect('admin/news')->with('update-msj', '1');
    }

    public function destroy($id)
    {
        News::destroy($id);

        return redirect('admin/news')->with('delete-msj', '1');
    }
}
