@extends('layouts.user.template')

@section('content')
@include('layouts.user.partials.headerHome')
<!-- Header Area End -->
<!-- Background Area Start -->
<section id="slider-container" class="slider-area">
    <div class="slider-owl owl-theme owl-carousel">
        <!-- Start Slingle Slide -->
        <div class="single-slide item" style="background-image: url({{ asset('images/banner8.jpg')}})">
            <!-- Start Slider Content -->
            <div class="slider-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-left-5">
                            <div class="slide-content-wrapper">
                                <div class="slide-content">
                                    <h3>Astrología Contemporánea Aplicada </h3>
                                    <p>Intégrate a una experiencia visionaria y natural del mundo. Aprende a guiarte o permite que te guiemos siguiendo el camnino del cosmos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Slider Content -->
        </div>
        <!-- End Slingle Slide -->
        <!-- Start Slingle Slide -->
        <div class="single-slide item" style="background-image: url({{ asset('images/banner2.jpg')}})">
            <!-- Start Slider Content -->
            <div class="slider-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-left-5">
                            <div class="slide-content-wrapper text-left">
                                <div class="slide-content">
                                    <h3>Astrología Contemporánea Aplicada </h3>
                                    <p>Intégrate a una experiencia visionaria y natural del mundo. Aprende a guiarte o permite que te guiemos siguiendo el camnino del cosmos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Slider Content -->
        </div>
    </div>
</section>
<!-- Background Area End -->
<!-- Notice Start -->
<section class="notice-area pt-50 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="notice-left">
                    <h3>Noticias</h3>
                    @foreach ($noticias as $noticia)
                    <div class="single-notice-left mb-25 pb-25">
                        <h4>{{ date('d-m-Y', strtotime($noticia->created_at)) }}</h4>
                        <a href="{{ route('news.show', [$noticia->slug, $noticia->id]) }}">
                            <h4>{{ $noticia->title }}</h4>
                        </a>
                        {!! substr($noticia->description, 0, 200) !!}... <a href="{{ route('news.show', [$noticia->slug, $noticia->id]) }}" style="color: #ec1c23 !important;">Leer Completa</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="notice-right">
                    <div class="single-notice-right mb-25 pb-25">
                        <h3>PRIVACIDAD</h3>
                        <p>Manejar información de cartas astrales personales, ya sean de tu carta natal, de tus proyectos y relaciones es sumamente importante para nosotros, en SP valoramos tu confianza y acuñamos nuestro modelo de ética… </p>
                    </div>
                    <div class="single-notice-right mb-25 pb-25">
                        <h3>PROFESIONALISMO</h3>
                        <p>Los creativos de SP son profesionales en distintas áreas académicas, como indagadores  del cielo ha sido difícil conseguir un aval legal en nuestra época. Sin embargo, puedes contar con un trato abierto, justo y de calidad. </p>
                    </div>
                    <div class="single-notice-right">
                        <h3>HONESTIDAD</h3>
                        <p>En SP tendrás acceso a toda la información que requieras sobre ti, sobre lo que te rodea desde una perspectiva astrológica sin poner esta información encima de tu persona, de tus creencias y valores.  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Notice End -->
<!-- Choose Start -->
<section class="choose-area pb-85 pt-77">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 pt-80">
                <div class="choose-content text-left">
                    <h2>¿Qué te ofrecemos en Solar Providencia?</h2>
                    <p>Te ofrecemos el conocimiento del mundo que te rodea desde una perspectiva astrológica. En SP no te impondremos formas, ÚNICAMENTE te recordaremos quién eres. </p>
                    <a class="default-btn" href="{{ route('courses.index') }}">Ver Cursos</a>
                </div>
            </div>
            <div class="col-md-4" style="z-index: 1;">
                <img class="img-circle" src="https://solarprovidencia.com/wp-content/uploads/2021/03/27a11bd7-b89f-49a8-b649-821060050345-300x286.jpg">
            </div>
        </div>
    </div>
</section>
<!-- Choose Area End -->
<!-- Courses Area Start -->
<div class="courses-area pt-150 text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title">
                    <img src="{{ asset('eduhome/img/icon/section.png') }}" alt="section-title">
                    <h2>NUESTROS CURSOS</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($cursos as $curso)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-course">
                    <div class="course-img">
                        <a href="{{ route('courses.show', [$curso->slug, $curso->id]) }}"><img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" alt="course" style="width: 100%; height: 250px;">
                            <div class="course-hover">
                                <i class="fa fa-link"></i>
                            </div>
                        </a>
                    </div>
                    <div class="course-content">
                        <h3><a href="course-details.html">{{ $curso->title }}</a></h3>
                        <p>{{ $curso->subtitle }}</p>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                    <a class="default-btn" href="{{ route('courses.show', [$curso->slug, $curso->id]) }}">Ver Más</a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right" style="font-weight: bold;">
                                    <span class="text-info"> {{ $curso->type }} </span><br>
                                    @if ($curso->type == "Online")
                                        <i class="fa fa-calendar"> {{ date('d/m/Y', strtotime($curso->date)) }}</i>
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Courses Area End -->
<!-- Event Area Start -->
<div class="event-area one text-center pt-140 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title">
                    <img src="{{ asset('eduhome/img/icon/section.png') }}" alt="section-title">
                    <h2>PRÓXIMOS EVENTOS</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @php $cont = 0; @endphp
            @foreach ($eventos as $evento)
                @php $cont++; @endphp
                @if ( ($cont == 1) || ($cont == 5) )
                    <div class="col-md-6 col-sm-12 col-xs-12">
                @endif
                    <div class="single-event mb-35">
                        <div class="event-date">
                            <h3><a href="event-details.html">{{ date('d', strtotime($evento->date)) }} <span>{{ $evento->mes }}</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">{{ $evento->title }}</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> {{ date('H:i A', strtotime($evento->time)) }}</li>
                                    <li><i class="fa fa-map-marker"></i> {{ $evento->place }}</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="{{ route('events.show', [$evento->slug, $evento->id]) }}">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @if ( ($cont == 4) || ($cont == 8) )
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- Event Area End -->
<!-- Testimonial Area Start -->
<div class="testimonial-area pt-110 pb-105 text-center">
    <div class="container">
        <div class="row">
            <div class="testimonial-owl owl-theme owl-carousel">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <div class="single-testimonial">
                        <div class="testimonial-info">
                            <div class="testimonial-img">
                                <img src="{{ asset('logos/logo_white.png')}}" alt="testimonial">
                            </div>
                            <div class="testimonial-content">
                                <p>Intégrate a una experiencia visionaria y natural del mundo. Aprende a guiarte o permite que te guiemos siguiendo el camino del cosmos. </p>
                                <h4>Damián Chávez</h4>
                                <h5>Astrólogo</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial Area End -->

@endsection