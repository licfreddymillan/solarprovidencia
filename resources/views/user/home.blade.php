@extends('layouts.user.template')

@section('content')
    <!-- Header Area Start -->
    <header class="top">
        <div class="header-area header-sticky fixed">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('logos/logo.png')}}" alt="eduhome" /></a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="content-wrapper one">
                            <!-- Main Menu Start -->
                            <div class="main-menu one text-right">
                                <nav>
                                    <ul>
                                        <li><a href="index.html">Home</a>
                                            <ul>
                                                <li><a href="index.html">Home One</a></li>
                                                <li><a href="index-2.html">Home Two</a></li>
                                                <li><a href="index-3.html">Home Three</a></li>
                                                <li><a href="index-4.html">Home Four</a></li>
                                                <li><a href="index-5.html">Home Five</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="https://anthoncode.com">About</a></li>
                                        <li><a href="course.html">courses</a>
                                            <ul>
                                                <li><a href="course.html">courses</a></li>
                                                <li><a href="course-details.html">courses details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="event.html">event</a>
                                            <ul>
                                                <li><a href="event.html">event</a></li>
                                                <li><a href="event-left-side-bar.html">event left sidebar</a></li>
                                                <li><a href="event-right-side-bar.html">event right sidebar</a></li>
                                                <li><a href="event-details.html">event details</a></li>
                                            </ul>
                                        </li>
                                        <li class="hidden-sm"><a href="teacher.html">teacher</a>
                                            <ul>
                                                <li><a href="teacher.html">teacher</a></li>
                                                <li><a href="teacher-details.html">teacher details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="blog.html">blog</a>
                                            <ul>
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="blog-left-side-bar.html">blog left sidebar</a></li>
                                                <li><a href="blog-right-side-bar.html">blog righ sidebar</a></li>
                                                <li><a href="blog-details.html">blog details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="#">Buy Now</a>
                                    </ul>
                                </nav>
                            </div>
                            <div class="mobile-menu hidden-lg hidden-md one"></div>
                            <!-- Main Menu End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
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
    <section class="notice-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="notice-left">
                        <h3>notice board</h3>
                        <div class="single-notice-left mb-25 pb-25">
                            <h4>5, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
                        <div class="single-notice-left mb-25 pb-25">
                            <h4>4, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
                        <div class="single-notice-left pb-75">
                            <h4>3, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
                        <div class="single-notice-left mb-25 pb-25">
                            <h4>5, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
                        <div class="single-notice-left mb-25 pb-25">
                            <h4>4, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
                        <div class="single-notice-left pb-70">
                            <h4>3, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
                        <div class="single-notice-left mb-25 pb-25">
                            <h4>5, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
                        <div class="single-notice-left mb-25 pb-25">
                            <h4>4, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
                        <div class="single-notice-left pb-70">
                            <h4>3, June 2017</h4>
                            <p>I must explain to you how all this mistaken idea of denouncing plasure and praising pain was born and I will give you a complete </p>
                        </div>
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
                                <a href="course-details.html"><img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" alt="course" style="width: 100%; height: 250px;">
                                    <div class="course-hover">
                                        <i class="fa fa-link"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="course-content">
                                <h3><a href="course-details.html">{{ $curso->title }}</a></h3>
                                <p>{{ $curso->description }}</p>
                                <a class="default-btn" href="course-details.html">Ver Más</a>
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
                        <img src="img/icon/section.png" alt="section-title">
                        <h2>UPCOMMING EVENTS</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="single-event mb-35">
                        <div class="event-date">
                            <h3><a href="event-details.html">20 <span>June</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">MICRO BIOLOGICAL WORKSHOP</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>9.00 AM - 4.45 PM</li>
                                    <li><i class="fa fa-map-marker"></i>New Yourk City</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="event-details.html">join now</a>
                            </div>
                        </div>
                    </div>
                    <div class="single-event mb-35">
                        <div class="event-date">
                            <h3><a href="event-details.html">18 <span>June</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">ADVANCE PHP WORKSHOP</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>9.00 AM - 4.45 PM</li>
                                    <li><i class="fa fa-map-marker"></i>New Yourk City</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="event-details.html">join now</a>
                            </div>
                        </div>
                    </div>
                    <div class="single-event mb-35">
                        <div class="event-date">
                            <h3><a href="event-details.html">16 <span>June</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">LEARN ENGLISH HISTORY</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>9.00 AM - 4.45 PM</li>
                                    <li><i class="fa fa-map-marker"></i>New Yourk City</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="event-details.html">join now</a>
                            </div>
                        </div>
                    </div>
                    <div class="single-event">
                        <div class="event-date">
                            <h3><a href="event-details.html">14 <span>June</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">GLOBAL ECONOMIC CONFERENCE</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>9.00 AM - 4.45 PM</li>
                                    <li><i class="fa fa-map-marker"></i>New Yourk City</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="event-details.html">join now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div class="single-event mb-35">
                        <div class="event-date">
                            <h3><a href="event-details.html">12 <span>June</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">MATHEMATICAL WORKSHOP</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>9.00 AM - 4.45 PM</li>
                                    <li><i class="fa fa-map-marker"></i>New Yourk City</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="event-details.html">join now</a>
                            </div>
                        </div>
                    </div>
                    <div class="single-event mb-35">
                        <div class="event-date">
                            <h3><a href="event-details.html">10 <span>June</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">WORDPRESS AUTHOR MEET UP</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>9.00 AM - 4.45 PM</li>
                                    <li><i class="fa fa-map-marker"></i>New Yourk City</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="event-details.html">join now</a>
                            </div>
                        </div>
                    </div>
                    <div class="single-event mb-35">
                        <div class="event-date">
                            <h3><a href="event-details.html">08 <span>June</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">DIGITAL MARKETING ANALYSIS</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>9.00 AM - 4.45 PM</li>
                                    <li><i class="fa fa-map-marker"></i>New Yourk City</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="event-details.html">join now</a>
                            </div>
                        </div>
                    </div>
                    <div class="single-event">
                        <div class="event-date">
                            <h3><a href="event-details.html">06 <span>June</span></a></h3>
                        </div>
                        <div class="event-content text-left">
                            <div class="event-content-left">
                                <h4><a href="event-details.html">WROKSHOP ON UI &amp; UX</a></h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>9.00 AM - 4.45 PM</li>
                                    <li><i class="fa fa-map-marker"></i>New Yourk City</li>
                                </ul>
                            </div>
                            <div class="event-content-right">
                                <a class="default-btn" href="event-details.html">join now</a>
                            </div>
                        </div>
                    </div>
                </div>
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