<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\News;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Event;
use DB; use Auth;

class CourseController extends Controller
{
    function index(){
        if ((Auth::guest()) || (Auth::user()->rol == 2)) {
            $cursos = Course::where('status', '=', 1)
                        ->orderBy('title', 'ASC')
                        ->get();

            return view('user.courses')->with(compact('cursos'));
        }else{
            $cursos = Course::withCount('users')
                    ->orderBy('title', 'ASC')
                    ->get();

            $categorias = DB::table('categories')
                ->select('id', 'title')
                ->orderBy('title', 'ASC')
                ->get();

            return view('admin.courses')->with(compact('cursos', 'categorias'));
        }
        
    }

    public function store(Request $request){
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

    public function show($slug, $id){
        $transferenciaPendiente = NULL;
        if ( (!Auth::guest()) && (Auth::user()->rol == 2) ){ 
            $agregado = Auth::user()->courses()->where('course_id', '=', $id)->count();

            if ($agregado == 1){
               return redirect('user/course-resume/'.$slug.'/'.$id);
            } 

            $transferenciaPendiente = DB::table('bank_transfers')
                                    ->where('user_id', '=', Auth::user()->id)
                                    ->where('course_id', '=', $id)
                                    ->where('status', '=', 0)
                                    ->first();
        }

        $curso = Course::where('id', '=', $id)
                    ->withCount('users')
                    ->first();

        $categorias = Category::withCount('courses')
            ->orderBy('title', 'ASC')
            ->get();

        $noticias = News::where('status', '=', 1)
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();

        return view('user.showCourse')->with(compact('curso', 'categorias', 'noticias', 'transferenciaPendiente'));
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

    public function my_courses(){
        $cursos = Auth::user()->courses;

        $cursosPendientes = Transfer::with('course')
                                ->where('course_id', '<>', NULL)
                                ->where('user_id', '=', Auth::user()->id)
                                ->where('status', '=', 0)
                                ->orderBy('id', 'DESC')
                                ->get();

        return view('user.myCourses')->with(compact('cursos', 'cursosPendientes'));
    }

    public function resume($slug, $id){
        $curso = Course::where('id', '=', $id)
                    ->with(['lessons' => function ($query){
                            $query->where('status', '=', 1);}
                           ])->first();

        foreach ($curso->lessons as $leccion){
            $checkLeccion = DB::table('lessons_users')
                                ->where('user_id', '=', Auth::user()->id)
                                ->where('lesson_id', '=', $leccion->id)
                                ->first();

            if (is_null($checkLeccion)){
                $leccion->vista = 0;
            }else{
                $leccion->vista = 1;
            }
        }

        $datosProgreso = DB::table('courses_users') 
                            ->where('course_id', '=', $id)
                            ->where('user_id', '=', Auth::user()->id)
                            ->first();

        $categorias = Category::withCount('courses')
            ->orderBy('title', 'ASC')
            ->get();

        $noticias = News::where('status', '=', 1)
            ->orderBy('id', 'DESC')
            ->take(4)
            ->get();

        return view('user.resumeCourse')->with(compact('curso', 'datosProgreso', 'categorias', 'noticias'));
    }

    public function request_online_class(Request $request){
        DB::table('courses_users')
            ->where('user_id', '=', Auth::user()->id)
            ->where('course_id', '=', $request->course_id)
            ->update(['finish' => 1, 'online_class' => 1, 'ending_date' => date('Y-m-d')]);

            return redirect('user/course-resume/'.$request->course_slug.'/'.$request->course_id)->with('msj-exitoso', 'La clase online ha sido solicitada con éxito.');
    }

    public function pending_class(){
        $clasesPendientes = DB::table('courses_users')
                                ->where('finish', '=', 1)
                                ->where('online_class', '=', 1)
                                ->get();
        foreach ($clasesPendientes as $clase){
            $clase->user = User::find($clase->user_id);
            $clase->course = Course::find($clase->course_id);
        }

        return view('admin.pendingClass')->with(compact('clasesPendientes'));
    }

    public function add_course($course_slug, $course_id){
        Auth::user()->courses()->attach($course_id, ['start_date' => date('Y-m-d')]);

        return redirect('user/course-resume/'.$course_slug.'/'.$course_id)->with('msj-exitoso', '¡Felicidades! Has agregado el curso con éxito. ¡Disfrútalo!');
    }

    //**** Genera el PDF del certificado ***//
    public function get_certificate($curso_id){
        $datosCurso = Course::where('id', '=', $curso_id)
                        ->first();
        
        $datosProgreso = DB::table('courses_users')
                            ->where('user_id', '=', Auth::user()->id)
                            ->where('course_id', '=', $curso_id)
                            ->first();

        $partesFecha = explode("-", $datosProgreso->ending_date);

        switch ($partesFecha[1]) {
            case '01':
                $mes = 'Enero';
            break;
            case '02':
                $mes = 'Febrero';
            break;
            case '03':
                $mes = 'Marzo';
            break;
            case '04':
                $mes = 'Abril';
            break;
            case '05':
                $mes = 'Mayo';
            break;
            case '06':
                $mes = 'Junio';
            break;
            case '07':
                $mes = 'Julio';
            break;
            case '08':
                $mes = 'Agosto';
            break;
            case '09':
                $mes = 'Septiembre';
            break;
            case '10':
                $mes = 'Octubre';
            break;
            case '11':
                $mes = 'Noviembre';
            break;
            case '12':
                $mes = 'Diciembre';
            break;
        }

        $fecha_fin = $partesFecha[2]." de ".$mes." de ".$partesFecha[0];

        $pdf = \App::make('dompdf.wrapper');
        //return view('user.certificate')->with(compact('datosCurso', 'fecha_fin'));
        $pdf->loadView('user.certificate', compact('datosCurso', 'fecha_fin'))->setPaper('a4', 'landscape');
        //$output = $pdf->output();
        /*$path = "certificates/courses/".$usuario_id."-".$curso_id.".pdf"; 
        file_put_contents($path, $output);*/
        return $pdf->stream();
    }

    public function users_list($id){
        $curso = Course::where('id', '=', $id)
                    ->with('users')
                    ->first();
        
        $usuarios= $curso->users;
        
        return view('admin.usersList')->with(compact('usuarios', 'curso'));
    }
}
