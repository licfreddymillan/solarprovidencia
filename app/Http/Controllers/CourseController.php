<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Models\Course;
use App\Models\Lesson;
use DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $cursos = Course::orderBy('title', 'ASC')->get();

        $categorias = DB::table('categories')
                        ->select('id', 'title')
                        ->orderBy('title', 'ASC')
                        ->get();

        return view('admin.courses')->with(compact('cursos', 'categorias'));
    }

    public function store(Request $request){
        $curso = new Course($request->all());
        $curso->slug = Str::slug($curso->title);
        $curso->status = 1;
        $curso->save();

        if ($request->hasFile('cover')){
            $file = $request->file('cover');
            $name = $curso->id.".".$file->getClientOriginalExtension();
            $file->move(public_path().'/uploads/images/courses', $name);
            $curso->cover = $name;
            $curso->save();
        }

        return redirect('admin/courses')->with('store-msj', '1');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $curso = Course::find($request->course_id);
            $curso->fill($request->all());
            $curso->slug = Str::slug($curso->title);
            $curso->save();
    
            if ($request->hasFile('cover')){
                $file = $request->file('cover');
                $name = $curso->id.".".$file->getClientOriginalExtension();
                $file->move(public_path().'/uploads/images/courses', $name);
                $curso->cover = $name;
                $curso->save();
            }
            return redirect('admin/courses')->with('update-msj', '1');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::destroy($id);

        Lesson::where('course_id', '=', $id)
                    ->delete();

        return redirect('admin/courses')->with('delete-msj', '1');
    }
}
