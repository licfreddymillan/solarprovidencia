<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id){
        $lecciones = Lesson::where('course_id', '=', $course_id)
                        ->orderBy('order', 'ASC')
                        ->get();

        return view('admin.lessons')->with(compact('lecciones', 'course_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $leccion = Lesson::find($id);

        return view('admin/showLesson')->with(compact('leccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $leccion = Lesson::find($request->lesson_id);
        $leccion->fill($request->all());
        $leccion->slug = Str::slug($leccion->title);
        $leccion->save();

        return redirect('admin/courses/lessons/'.$leccion->course_id)->with('update-msj', '1');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
