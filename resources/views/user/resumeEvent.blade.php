@extends('layouts.user.template')

@push('scripts')
    <script>
        const getRemainingTime = deadline => {
            let objFecha = new Date()
            let now = new Date(objFecha.getUTCFullYear(), objFecha.getUTCMonth(), objFecha.getUTCDate(), objFecha.getUTCHours(), objFecha.getUTCMinutes(), objFecha.getUTCSeconds()),
                remainTime = (new Date(deadline) - now + 1000) / 1000,
                remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2),
                remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2),
                remainHours = ('0' + Math.floor(remainTime / 3600 % 24)).slice(-2),
                remainDays = Math.floor(remainTime / (3600 * 24));
            return {
                remainSeconds,
                remainMinutes,
                remainHours,
                remainDays,
                remainTime
            }
        };
        const countdown = (deadline) => {
            //const el = document.getElementById(elem);
            const timerUpdate = setInterval(() => {
                let t = getRemainingTime(deadline);
                //el.innerHTML = `${t.remainDays}d:${t.remainHours}h:${t.remainMinutes}m:${t.remainSeconds}s`;
                
                if (t.remainTime <= 1) {
                    $("#clock").css('display', 'none');
                    $("#ended").css('display', 'none');
                    $("#live").css('display', 'block');
                } else {
                    $("#ended").css('display', 'none');
                    $("#live").css('display', 'none');
                    $("#clock").css('display', 'block');
                    
                    document.getElementById("days").innerHTML = '<b>'+t.remainDays+'</b> Días';
                    document.getElementById("hours").innerHTML = '<b>'+t.remainHours+'</b> Horas';
                    document.getElementById("minutes").innerHTML = '<b>'+t.remainMinutes+'</b> Minutos';
                    document.getElementById("seconds").innerHTML = '<b>'+t.remainSeconds+'</b> Segundos';
                }
            }, 1000)
        };
        var fecha = document.getElementById("countdown_limit").value;
        if (fecha != 0){
            countdown('{{$evento->date.' '.$evento->time}}');
        }else{
            $("#clock").css('display', 'none');
            $("#live").css('display', 'none');
            $("#ended").css('display', 'block');
        }

    </script>
@endpush
@section('content')
    @include('layouts.user.partials.header')
    <input type="hidden" id="countdown_limit" value="{{ $countdown_limit }}">
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
                            <img src="{{ asset('uploads/images/events/'.$evento->cover) }}" alt="courses-details">
                        </div>
                        <div class="course-details-content">
                            <h2>{{ $evento->title }}</h2>
                            <p>{!! $evento->description !!}</p>
                        </div>

                        <div>
                            <div class="panel" style="border: solid 1px #2C2B5E;">
                                <div class="panel-heading"style="background-color: #2C2B5E;">
                                    <div class="row">
                                        <div class="col-md-6 text-left" style="font-size: 18px; color: white; font-weight: bold;">
                                            <i class="fa fa-play-circle"></i> Estado del Evento
                                        </div>
                                        <div class="col-md-6 text-right" style="font-size: 14px; color: white; font-weight: bold;">
                                            @if ($evento->live == 0)
                                                <i class="fa fa-check-circle"></i> Pregrabado
                                            @else
                                                <i class="fa fa-eye"></i> En Vivo
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body text-center">
                                    @if ($evento->live == 0)
                                        @if(!is_null($evento->video))
                                            <a class="default-btn" href="{{ route('user.show-event-video', [$evento->slug, $evento->id]) }}">Ver Video</a>
                                        @else
                                            El evento no posee el video pregrabado aún...
                                        @endif
                                    @else
                                        <div id="clock">
                                            <div class="pb-20" style="font-size: 20px; font-weight: bold;"> FALTAN </div>
                                            <div class="row">
                                                <div class="col-md-3" id="days" style="font-size: 20px; color: red;"></div>
                                                <div class="col-md-3" id="hours" style="font-size: 20px; color: red;"></div>
                                                <div class="col-md-3" id="minutes" style="font-size: 20px; color: red;"></div>
                                                <div class="col-md-3" id="seconds" style="font-size: 20px; color: red;"></div>
                                            </div>
                                        </div>

                                        <div id="live" style="display: none;">
                                            <div class="pb-20" style="font-size: 20px; font-weight: bold;"> EL EVENTO ESTÁ EN VIVO </div>

                                            @if(!is_null($evento->link))
                                                <a class="default-btn" href="{{ $evento->link }}">Ir al evento</a>
                                            @else
                                                Verifique su correo electrónico para encontrar el link del evento
                                            @endif
                                        </div>

                                        <div id="ended" style="display: none;">
                                            <div class="pb-20" style="font-size: 20px; font-weight: bold;">El evento ha finalizado.</div>

                                            @if(!is_null($evento->video))
                                                <a class="default-btn" href="{{ route('user.show-event-video', [$evento->slug, $evento->id]) }}">Ver Video</a>
                                            @else
                                                El evento no posee el video pregrabado aún...
                                            @endif
                                        </div>
                                    @endif
                                </div>
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