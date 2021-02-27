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

        @if (Session::has('msj-erroneo'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>{{ Session::get('msj-erroneo') }}</strong>
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
                                <li>Estudiantes <span>{{ $curso->users_count }}</span></li>
                            </ul>
                            <h3 class="red">Precio: ${{ $curso->price }}</h3>

                            @if (!Auth::guest())
                                <div style="padding-top: 10px;" class="text-center">
                                    <form action="{{ route('paypal-checkout') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="amount" value="{{ $curso->price }}"> 
                                        <input type="hidden" name="description" value="{{ $curso->title }}">  
                                        <input type="hidden" name="course_id" value="{{ $curso->id }}">
                                        <button type="submit" class="btn btn-primary"><i class="fab fa-paypal"></i> Pagar con PayPal</button>
                                    </form>
                                </div>
                                <div style="padding-top: 10px;" class="text-center">
                                    <a class="btn btn-success" data-toggle="modal" data-target="#modal-transferencia"><i class="fas fa-university"></i> Pagar con Transferencia Bancaria</a>
                                </div>
                            @else
                                <div class="tex-center" style="padding-top: 10px; font-weight: 700;">
                                    <a href="{{ route('login') }}">Inicia sesión</a> o <a href="{{ route('register') }}">regístrate</a> para poder comprar el curso
                                </div>
                            @endif
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

<div class="modal fade" id="modal-transferencia" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pago por Transferencia Bancaria</h4>
            </div>
            <form class="form-horizontal" action="{{ route('user.transfers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{ $curso->id }}">
                <input type="hidden" name="course_slug" value="{{ $curso->slug }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Banco:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="bank" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4"># de Transacción:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="transaction_number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Fecha de Transacción:</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Monto Depositado:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="amount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Soporte de Transacción:</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="support_image" required>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cargar Pago</button>
                </div>
            </form> 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection