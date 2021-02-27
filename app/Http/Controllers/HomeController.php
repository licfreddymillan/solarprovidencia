<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\News;
use App\Models\Event;
use Auth;

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
        if((!Auth::guest()) and (Auth::user()->rol==1)){
            return redirect('admin/courses');
        }else{
            $cursos = Course::get();
            $noticias = News::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $eventos = Event::where('status', '=', 1)
                            ->where('date', '>=', date('Y-m-d'))
                            ->take(8)
                            ->get();

            foreach ($eventos as $evento){
                $evento->mes = $this->getMonth(date('m', strtotime($evento->date)));
            }

            return view('user/home')->with(compact('cursos', 'noticias', 'eventos'));              
        }   
    }

    public function getMonth($month){
        switch ($month) {
            case 1:
                $mes = 'Enero';
            break;
            case 2:
                $mes = 'Febrero';
            break;
            case 3:
                $mes = 'Marzo';
            break;
            case 4:
                $mes = 'Abril';
            break;
            case 5:
                $mes = 'Mayo';
            break;
            case 6:
                $mes = 'Junio';
            break;
            case 7:
                $mes = 'Julio';
            break;
            case 8:
                $mes = 'Agosto';
            break;
            case 9:
                $mes = 'Septiembre';
            break;
            case 10:
                $mes = 'Octubre';
            break;
            case 11:
                $mes = 'Noviembre';
            break;
            case 12:
                $mes = 'Diciembre';
            break;
        }

        return $mes;
    }

    public function search(Request $request)
    {
        $cursos = Course::where('title', 'LIKE', '%' . $request->get('busqueda') . '%')
            ->where('status', '=', 1)
            ->orderBy('title', 'ASC')
            ->get();

        $eventos = Event::where('title', 'LIKE', '%' . $request->get('busqueda') . '%')
                    ->where('status', '>', 0)
                    ->orderBy('date', 'ASC')
                    ->get();

        return view('user.search')->with(compact('cursos', 'eventos'));
    }
}
