<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {
        $cursos = Course::get();

        $noticias = News::where('status', '=', 1)->orderBy('id', 'DESC')->get();

        return view('user/home')->with(compact('cursos', 'noticias'));
    }
}
