@extends('layouts.user.template')

@section('content')
@include('layouts.user.partials.header')
<div class="course-area pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="course-title">
                    <h3>Buscar Cursos</h3>
                </div>
                <div class="course-form">
                    <form method="GET" action="{{ route('courses.search') }}">
                        <input type="search" placeholder="Curso..." name="busqueda" />
                        <button type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($cursos as $curso)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-course mb-70">
                    <div class="course-img">
                        <a href="{{ route('courses.show', [$curso->slug, $curso->id]) }}">
                            <img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" alt="course" style="width: 100%; height: 250px;">
                            <div class="course-hover">
                                <i class="fa fa-link"></i>
                            </div>
                        </a>
                    </div>
                    <div class="course-content">
                        <h3><a href="course-details.html">{{ $curso->title }}</a></h3>
                        <p>{{ $curso->subtitle }}</p>
                        <a class="default-btn" href="{{ route('courses.show', [$curso->slug, $curso->id]) }}">Ver Más</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection