<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\Lesson;
use DB; use Auth;

class LessonController extends Controller
{

    public function index($course_id){
        $lecciones = Lesson::where('course_id', '=', $course_id)
                        ->orderBy('order', 'ASC')
                        ->get();

        return view('admin.lessons')->with(compact('lecciones', 'course_id'));
    }

    public function store(Request $request){
        $ultLeccion = Lesson::where('course_id', '=', $request->course_id)
                        ->orderBy('id', 'DESC')
                        ->first();
            
        $leccion = new Lesson($request->all());
        $leccion->slug = Str::slug($leccion->title);
        if (is_null($ultLeccion)){
            $leccion->order = 1;
        }else{
            $leccion->order = $ultLeccion->order+1;
        }
        $leccion->save();

        return redirect('admin/courses/lessons/'.$leccion->course_id)->with('store-msj', 'La lección ha sido creada con éxito');
    }

    public function show($id){
        $leccion = Lesson::find($id);

        return view('admin/showLesson')->with(compact('leccion'));
    }

    public function update(Request $request){
        $leccion = Lesson::find($request->lesson_id);
        $leccion->fill($request->all());
        $leccion->slug = Str::slug($leccion->title);
        $leccion->save();

        return redirect('admin/courses/lessons/'.$leccion->course_id)->with('update-msj', '1');
    }

    public function destroy($id){
        $leccion = Lesson::find($id);
        $leccion->delete();

        $leccionesRestantes = Lesson::where('course_id', '=', $leccion->course_id)
                                ->where('order', '>', $leccion->order)
                                ->get();

        foreach ($leccionesRestantes as $leccionRestante) {
            $leccionRestante->order = $leccionRestante->order-1;
            $leccionRestante->save();
        }


        return redirect('admin/courses/lessons/'.$leccion->course_id)->with('delete-msj', '1');
    }

    public function show_lesson($slug, $id){
        $leccionVista = DB::table('lessons_users')
                            ->where('user_id', '=', Auth::user()->id)
                            ->where('lesson_id', '=', $id)
                            ->first();

        if (is_null($leccionVista)){
            Auth::user()->lessons()->attach($id, ['view_at' => date('Y-m-d')]);
        }

        $leccionActual = Lesson::find($id);

        $lecciones = Lesson::with('course')
                        ->where('course_id', '=', $leccionActual->course_id)
                        ->where('status', '=', 1)
                        ->orderBy('order', 'ASC')
                        ->get();

        $cantLeccionesVistas = 0;
        foreach ($lecciones as $leccion){
            $checkLeccion = DB::table('lessons_users')
                                ->where('user_id', '=', Auth::user()->id)
                                ->where('lesson_id', '=', $leccion->id)
                                ->first();

            if (is_null($checkLeccion)){
                $leccion->vista = 0;
            }else{
                $leccion->vista = 1;
                $cantLeccionesVistas++;
            }
        }

        $cantLecciones = $lecciones->count();
        $progreso = ( ($cantLeccionesVistas*100) / $cantLecciones);

        $progresoCurso = DB::table('courses_users')
                            ->where('course_id', '=', $leccionActual->course_id)
                            ->where('user_id', '=', Auth::user()->id)
                            ->update(['progress' => $progreso]);
                              
        return view('user.showLesson')->with(compact('leccionActual', 'lecciones', 'leccionVista'));
    }
}
