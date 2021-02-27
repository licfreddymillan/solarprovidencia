@extends('layouts.user.template')

@section('content')
	@include('layouts.user.partials.header')

	<div class="event-area three pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="course-title">
                        <h3>Buscar Eventos</h3>
                    </div>
                    <div class="course-form">
                        <form method="GET" action="{{ route('events.search') }}">
                            <input type="search" placeholder="Evento..." name="busqueda" />
                            <button type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($eventos->count() > 0)
                    @foreach ($eventos as $evento)
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="single-event mb-60">
                                <div class="event-img">
                                    <a href="event-details.html">
                                        <img src="{{ asset('uploads/images/events/'.$evento->cover) }}" alt="event">
                                        <div class="course-hover">
                                            <i class="fa fa-link"></i>
                                        </div>
                                    </a>
                                    <div class="event-date">
                                        <h3>{{ date('d', strtotime($evento->date)) }} <span>{{ $evento->mes }}</span></h3>  
                                    </div>
                                </div>
                                <div class="event-content text-left">
                                    <h4><a href="event-details.html">{{ $evento->title }}</a></h4>
                                    <ul>
                                        <li><span>Hora:</span>{{ date('H:i A', strtotime($evento->time)) }}</li>
                                        <li><span>Lugar</span>{{ $evento->place }}</li>
                                    </ul>
                                    <div class="event-content-right">
                                        <a class="default-btn" href="{{ route('events.show', [$evento->slug, $evento->id]) }}">Ver Detalles</a>
                                    </div>
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