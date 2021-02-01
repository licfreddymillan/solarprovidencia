<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\News;
use DB;

class CourseController extends Controller
{
    function index()
    {
        $cursos = Course::orderBy('title', 'ASC')->get();

        $categorias = DB::table('categories')
            ->select('id', 'title')
            ->orderBy('title', 'ASC')
            ->get();

        return view('admin.courses')->with(compact('cursos', 'categorias'));
    }

    public function store(Request $request)
    {
        $curso = new Course($request->all());
        $curso->slug = Str::slug($curso->title);
        $curso->status = 1;
        $curso->save();

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $name = $curso->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/courses', $name);
            $curso->cover = $name;
            $curso->save();
        }

        return redirect('admin/courses')->with('store-msj', '1');
    }

    public function show($slug, $id)
    {
        $curso = Course::find($id);

        $categorias = Category::withCount('courses')
            ->orderBy('title', 'ASC')
            ->get();

        $noticias = News::where('status', '=', 1)
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();

        return view('user.showCourse')->with(compact('curso', 'categorias', 'noticias'));
    }

    public function update(Request $request)
    {
        $curso = Course::find($request->course_id);
        $curso->fill($request->all());
        $curso->slug = Str::slug($curso->title);
        $curso->save();

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $name = $curso->id . "." . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/images/courses', $name);
            $curso->cover = $name;
            $curso->save();
        }
        return redirect('admin/courses')->with('update-msj', '1');
    }

    public function destroy($id)
    {
        Course::destroy($id);

        Lesson::where('course_id', '=', $id)
            ->delete();

        return redirect('admin/courses')->with('delete-msj', '1');
    }

    public function search_by_category($slug, $id)
    {
        $cursos = Course::where('category_id', '=', $id)
            ->where('status', '=', 1)
            ->orderBy('title', 'ASC')
            ->get();

        return view('user.courses')->with(compact('cursos'));
    }

    public function search(Request $request)
    {
        $cursos = Course::where('title', 'LIKE', '%' . $request->get('busqueda') . '%')
            ->where('status', '=', 1)
            ->orderBy('title', 'ASC')
            ->get();

        return view('user.courses')->with(compact('cursos'));
    }
}
