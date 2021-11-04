@extends('layouts.user.template')

@section('content')
    @include('layouts.user.partials.header')
    <div class="courses-details-area blog-area pb-140">
        <div class="container">
             @if (Session::has('msj-exitoso'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <strong>{{ Session::get('msj-exitoso') }}</strong>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-8">
                    <div class="courses-details">
                        <div class="courses-details-img">
                            <img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" alt="courses-details">
                        </div>
                        <div class="course-details-content">
                            <h2>{{ $curso->title }}</h2>
                            <p>{{ $curso->subtitle }}</p>
                            <p>{!! $curso->description !!}</p>
                            
                            @if ($curso->lessons->count() )
                                <div>
                                    <div class="course-title pb-20">
                                        <h3>Lecciones</h3>
                                    </div>
                                    @foreach ($curso->lessons as $leccion)
                                        <div class="panel" style="border: solid 1px #2C2B5E;">
                                            <div class="panel-heading"style="background-color: #2C2B5E;">
                                                <div class="row">
                                                    <div class="col-md-6 text-left">
                                                        <a href="#" style="font-size: 18px; color: white; font-weight: bold;"><i class="fa fa-play-circle"></i> {{ $leccion->title }}</a>
                                                    </div>
                                                    <!--<div class="col-md-6 text-right" style="font-size: 14px; color: white; font-weight: bold;">
                                                        @if ($leccion->vista == 1)
                                                            <i class="fa fa-check-circle"></i> Vista
                                                        @else
                                                            <i class="fa fa-eye"></i> Pendiente
                                                        @endif
                                                    </div>-->
                                                </div>
                                                
                                            </div>
                                            <div class="panel-body">
                                                {{ $leccion->description }}
                                            </div>
                                        </div>
                                    @endforeach
    
                                    <div class="text-center">
                                        @if ($datosProgreso->progress == 100)
                                            @if ($datosProgreso->finish == 0)
                                                <button type="button" class="default-btn" data-toggle="modal" data-target="#modal-clase">Solicitar clase en vivo</button>
                                            @else
                                                @if ($datosProgreso->online_class == 1)
                                                    <label class="label label-warning"><i class="fas fa-tv"></i> Esperando clase en vivo...</label>
                                                @else
                                                    <label class="label label-success"><i class="fa fa-medal"></i> ¡Curso Finalizado!</label>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif
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

    <div class="modal fade" id="modal-clase" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Solicitar clase en vivo</h4>
                </div>
                <form class="form-horizontal" action="{{ route('user.request-online-class') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $curso->id }}">
                    <input type="hidden" name="course_slug" value="{{ $curso->slug }}">
                    <div class="modal-body">
                        Si estás listo para tener tu clase online final por favor presionar <b>"Solicitar Clase"</b>, al hacerlo el mentor se pondrá en contacto contigo a través de tús datos de contacto en la brevedad posible.
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Solicitar Clase</button>
                    </div>
                </form> 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection