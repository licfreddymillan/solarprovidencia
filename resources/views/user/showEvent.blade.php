@extends('layouts.user.template')

@section('content')
	@include('layouts.user.partials.header')

	<div class="event-details-area blog-area pb-140">
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
                    <div class="event-details">
                        <div class="event-details-img">
                            <img src="{{ asset('uploads/images/events/'.$evento->cover )}}" alt="event-details">
                            <div class="event-date">
                                <h3>{{ date('d', strtotime($evento->date)) }} <span>{{ $evento->mes }}</span></h3>  
                            </div>
                        </div>
                        <div class="event-details-content">
                            <h2>{{ $evento->title }}</h2>
                            <div class="course-details-left">
                                <div class="single-course-left">
                                    <h3>Descripción del Evento</h3>
                                    <p>{!! $evento->description !!}</p>
                                </div>
                                <div class="speakers-area fix">
                                <h4>Mentor</h4>
                                    <div class="single-speaker">
                                        <div class="speaker-img">
                                            <img src="http://localhost:8000/images/damian.jpg" alt="speaker" style="width: 100px; height: 120px;">
                                        </div>
                                        <div class="speaker-name">
                                            <h5>Damián Chávez</h5>
                                            <p>Astrólogo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="course-details-right">
                                <h3>DETALLES DEL EVENTO</h3>
                                <ul>
                                    <li>Fecha: <span>{{ date('d-m-Y', strtotime($evento->date)) }}</span></li><br>
                                    <li>Hora: <span>{{ date('H:i A', strtotime($evento->time)) }}</span></li><br>
                                    <li>Lugar: <span>{{ $evento->place }}</span></li><br>
                                    <li>Suscriptores: <span>{{ $evento->users_count }}</span></li>
                                </ul>
                                <h3 class="red">Precio: ${{ $evento->price }}</h3>

                                @if (!Auth::guest())
                                    @if (is_null($transferenciaPendiente))
                                        <div style="padding-top: 10px;" class="text-center">
                                            <form action="{{ route('paypal-checkout') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="amount" value="{{ $evento->price }}"> 
                                                <input type="hidden" name="description" value="{{ $evento->title }}">  
                                                <input type="hidden" name="event_id" value="{{ $evento->id }}">
                                                <button type="submit" class="btn btn-primary"><i class="fab fa-paypal"></i> Pagar con PayPal</button>
                                            </form>
                                        </div>
                                        <div style="padding-top: 10px;" class="text-center">
                                            <a class="btn btn-success" data-toggle="modal" data-target="#modal-transferencia"><i class="fas fa-university"></i> Pagar con Transferencia Bancaria</a>
                                        </div>
                                    @else
                                        <div style="padding-top: 10px; color: orange;" class="text-center">
                                            Usted tiene una transferencia en proceso...
                                        </div>
                                    @endif
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
                                <form id="search" method="GET" action="{{ route('events.search') }}">
                                    <input type="search" placeholder="Evento..." name="busqueda" />
                                    <button type="submit">
                                        <span><i class="fa fa-search"></i></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="single-blog-widget mb-50">
                            <h3>Otros Eventos</h3>
                            @foreach ($otrosEventos as $otroEvento)
                                <div class="single-post mb-30">
                                    <div class="single-post-img">
                                        <a href="{{ route('events.show', [$otroEvento->slug, $otroEvento->id]) }}">
                                            <img src="{{ asset('uploads/images/events/'.$otroEvento->cover)}}" style="width: 100px; height: 80px;">
                                            <div class="blog-hover">
                                                <i class="fa fa-link"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="single-post-content">
                                        <h4><a href="{{ route('events.show', [$otroEvento->slug, $otroEvento->id]) }}">{{ $otroEvento->title }}</a></h4>
                                        <p>{{ date('d-m-Y', strtotime($otroEvento->date)) }} {{ date('H:i A', strtotime($otroEvento->time)) }}</p>
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
                    <input type="hidden" name="event_id" value="{{ $evento->id }}">
                    <input type="hidden" name="event_slug" value="{{ $evento->slug }}">
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