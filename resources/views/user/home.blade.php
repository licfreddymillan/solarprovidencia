@extends('layouts.user.template')

@section('content')
@include('layouts.user.partials.headerHome')
<!-- Header Area End -->
<!-- Background Area Start -->
<section id="slider-container" class="slider-area">
    <div class="slider-owl owl-theme owl-carousel">
        <!-- Start Slingle Slide -->
        <div class="single-slide item" style="background-image: url({{ asset('logos/fondo3.jpg')}})">
            <!-- Start Slider Content -->
            <div class="slider-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-left-5">
                            <div class="slide-content-wrapper">
                                <div class="slide-content">
                                    <h3>EDUCATION MAKES </h3>
                                    <h2>PROPER HUMANITY </h2>
                                    <p>I must explain to you how all this mistaken idea of denouncing pleasure and prsing pain was born and I will give you a complete account of the system </p>
                                    <a class="default-btn" href="about.html">Learn more</a>
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
        <div class="single-slide item" style="background-image: url({{ asset('logos/fondo2.jpg')}})">
            <!-- Start Slider Content -->
            <div class="slider-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-left-5">
                            <div class="slide-content-wrapper text-left">
                                <div class="slide-content">
                                    <h3>EDUCATION MAKES </h3>
                                    <h2>PROPER HUMANITY </h2>
                                    <p>I must explain to you how all this mistaken idea of denouncing pleasure and prsing pain was born and I will give you a complete account of the system </p>
                                    <a class="default-btn" href="about.html">Learn more</a>
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
        <div class="single-slide item" style="background-image: url({{ asset('logos/fondo.jpg')}})">
            <!-- Start Slider Content -->
            <div class="slider-content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-md-offset-left-5">
                            <div class="slide-content-wrapper">
                                <div class="slide-content">
                                    <h3>EDUCATION MAKES </h3>
                                    <h2>PROPER HUMANITY </h2>
                                    <p>I must explain to you how all this mistaken idea of denouncing pleasure and prsing pain was born and I will give you a complete account of the system </p>
                                    <a class="default-btn" href="about.html">Learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Slider Content -->
        </div>
        <!-- End Slingle Slide -->
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
                        <h3>PROFESSIONAL TEACHER</h3>
                        <p>I must explain to you how all this mistaken idea of denouncing pleure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings </p>
                    </div>
                    <div class="single-notice-right mb-25 pb-25">
                        <h3>Online courses</h3>
                        <p>I must explain to you how all this mistaken idea of denouncing pleure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings </p>
                    </div>
                    <div class="single-notice-right">
                        <h3>easy to addmission</h3>
                        <p>I must explain to you how all this mistaken idea of denouncing pleure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings </p>
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
            <div class="col-md-8 col-md-offset-left-4 col-sm-8 col-md-offset-left-4">
                <div class="choose-content text-left">
                    <h2>WHY YOU CHOOSE EDUHOME ?</h2>
                    <p>I must explain to you how all this mistaken idea of denouncing pleure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings the master-builder of humanit happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because. </p>
                    <p class="choose-option">I must explain to you how all this mistaken idea of denouncing pleure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings the master-builder. </p>
                    <a class="default-btn" href="course-details.html">view courses</a>
                </div>
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
                        <p>{{ $curso->description }}</p>
                        <a class="default-btn" href="{{ route('courses.show', [$curso->slug, $curso->id]) }}">Ver Más</a>
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
                                    <li><i class="fa fa-clock-o"></i>{{ date('H:i A', strtotime($evento->time)) }}</li>
                                    <li><i class="fa fa-map-marker"></i>{{ $evento->place }}</li>
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
                                <img src="img/testimonial/testimonial.jpg" alt="testimonial">
                            </div>
                            <div class="testimonial-content">
                                <p>I must explain to you how all this mistaken idea of denoung pleure and praising pain was born and I will give you a coete account of the system, and expound the actual</p>
                                <h4>David Morgan</h4>
                                <h5>Student, CSE</h5>
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