@extends('layouts.user.template')

@section('content')
@include('layouts.user.partials.header')
<div class="course-area pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="course-title">
                    <h3>Buscar Cursos o Eventos</h3>
                </div>
                <div class="course-form">
                    <form method="GET" action="{{ route('search') }}">
                        <input type="search" placeholder="Curso o evento..." name="busqueda" />
                        <button type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="course-title">
                    <h3>Cursos</h3>
                </div>
            </div>

            @if ($cursos->count() > 0)
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
            @else
                <div class="col-md-12 pl-40 pt-20">
                    <span style="font-size: 20px; font-weight: bold;">No hay ningún curso que coincida con la búsqueda...</span>
                </div>
            @endif

            <div class="col-xs-12 pt-30">
                <div class="course-title">
                    <h3>Eventos</h3>
                </div>
            </div>

            @if ($eventos->count() > 0)
                @foreach ($eventos as $evento)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-course mb-70">
                            <div class="course-img">
                                <a href="{{ route('events.show', [$evento->slug, $evento->id]) }}">
                                    <img src="{{ asset('uploads/images/events/'.$evento->cover) }}" alt="course" style="width: 100%; height: 250px;">
                                    <div class="course-hover">
                                        <i class="fa fa-link"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="course-content">
                                <h3><a href="course-details.html">{{ $evento->title }}</a></h3>
                                <a class="default-btn" href="{{ route('events.show', [$evento->slug, $evento->id]) }}">Ver Más</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 pl-40 pt-20">
                    <span style="font-size: 20px; font-weight: bold;">No hay ningún evento que coincida con la búsqueda...</span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection