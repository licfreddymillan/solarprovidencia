@extends('layouts.user.template')

@section('content')
@include('layouts.user.partials.header')
<div class="courses-details-area blog-area pb-140">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="courses-details">
                    <div class="courses-details-img">
                        <img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" alt="courses-details">
                    </div>
                    <div class="course-details-content">
                        <h2>{{ $curso->title }}</h2>
                        <p>{{ $curso->subtitle }}</p>
                        <div class="course-details-left">
                            <div class="single-course-left">
                                <h3>Descripción del Curso</h3>
                                <p>{{ $curso->description }}</p>
                            </div>
                        </div>
                        <div class="course-details-right">
                            <h3>DETALLES DEL CURSO</h3>
                            <ul>
                                <li>Duración <span>{{ $curso->duration }}</span></li>
                                <li>Nivel <span>{{ $curso->level }}</span></li>
                                <li>Idioma <span>{{ $curso->language }}</span></li>
                                <li>Estudiantes <span>420</span></li>
                            </ul>
                            <h3 class="red">Precio: ${{ $curso->price }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-sidebar right">
                    <div class="single-blog-widget mb-50">
                        <h3>Buscar</h3>
                        <div class="blog-search">
                            <form method="GET" action="{{ route('courses.search') }}">
                                <input type="search" placeholder="Curso..." name="busqueda" />
                                <button type="submit">
                                    <span><i class="fa fa-search"></i></span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="single-blog-widget mb-50">
                        <h3>Categorías</h3>
                        <ul>
                            @foreach ($categorias as $categoria)
                            <li><a href="{{ route('courses.search-by-category', [$categoria->slug, $categoria->id]) }}">{{ $categoria->title }} ({{ $categoria->courses_count }})</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="single-blog-widget mb-50">
                        <h3>Últimas Noticias</h3>
                        @foreach ($noticias as $noticia)
                        <div class="single-post mb-30">
                            <div class="single-post-img">
                                <a href="{{ route('news.show', [$noticia->slug, $noticia->id]) }}"><img src="{{ asset('uploads/images/news/'.$noticia->image) }}">
                                    <div class="blog-hover">
                                        <i class="fa fa-link"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="single-post-content">
                                <h4><a href="{{ route('news.show', [$noticia->slug, $noticia->id]) }}">{{ $noticia->title }}</a></h4>
                                <p>{{ date('d-m-Y', strtotime($noticia->created_at)) }}</p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection