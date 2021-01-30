@extends('layouts.admin')

@section('content')
    <div class="text-center pb-2" style="font-size: 20px; font-weight: bold; ">
       <strong>{{ $leccion->title }}</strong>
    </div>
    <iframe src="{{ $leccion->video }}" width="100%" height="500" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>

    <div class="text-center pb-2" style="font-size: 20px; font-weight: bold; ">
        <a href="{{route('admin.courses.lessons', $leccion->course_id)}}">Volver a Lecciones</a>
    </div>
@endsection