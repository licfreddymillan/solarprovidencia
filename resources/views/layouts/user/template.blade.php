<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Eduhome - Educational HTML Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="{{ asset('eduhome/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/meanmenu.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/et-line-icon.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/reset.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('eduhome/css/responsive.css')}}">
    <script src="{{ asset('eduhome/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    @stack('styles')
</head>

<body>
    <!-- Header Area Start -->
    <div class="content-body">
        @yield('content')
    </div>

    <!-- Footer Start -->
    <footer class="footer-area">
        <div class="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-widget pr-60">
                            <div class="footer-logo pb-25">
                                <a href="index.html"><img src="{{ asset('logos/logo.png')}}" alt="Solar Providencia"></a>
                            </div>
                            <p>Intégrate a una experiencia visionaria y natural del mundo. Aprende a guiarte o permite que te guiemos siguiendo el camino del cosmos.</p>
                            <div class="footer-social">
                                <ul>
                                    <li><a href="https://www.facebook.com/solarprovidencia" target="_blank" title="Facebook: Solar Providencia"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="https://www.instagram.com/solarprovidencia" target="_blank" title="Instagram: Solar Providencia"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="https://www.facebook.com/momoastral" target="_blank" title="Facebook: Humor Astral SP"><i class="zmdi zmdi-facebook"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="single-widget">
                            <h3>Enlaces Útiles</h3>
                            <ul>
                                <li><a href="{{ route('courses.index') }}">Nuestros Cursos</a></li>
                                <li><a href="{{ route('events.index') }}">Nuestros Eventos</a></li>
                                <li><a href="{{ route('about-us') }}">Acerca de Nosotros</a></li>
                                <li><a href="{{ route('news.index') }}">Noticias</a></li>
                                <li><a href="{{ route('terms-and-conditions') }}">Términos y Condiciones</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="single-widget">
                            <h3>Contáctanos</h3>
                            <p>Zapote 13 Ahuatepec Morelos <br>Mexico.</p>
                            <p>+52 5576096718</p>
                            <p>info@solarprovidencia.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p>Copyright © <a href="https://devitems.com/" target="_blank">Solar Providencia</a> 2021. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <script src="{{ asset('eduhome/js/vendor/jquery-1.12.0.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/d6f2727f64.js" crossorigin="anonymous"></script>
    <script src="{{ asset('eduhome/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('eduhome/js/jquery.meanmenu.js')}}"></script>
    <script src="{{ asset('eduhome/js/jquery.magnific-popup.js')}}"></script>
    <script src="{{ asset('eduhome/js/ajax-mail.js')}}"></script>
    <script src="{{ asset('eduhome/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('eduhome/js/jquery.mb.YTPlayer.js')}}"></script>
    <script src="{{ asset('eduhome/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{ asset('eduhome/js/plugins.js')}}"></script>
    <script src="{{ asset('eduhome/js/main.js')}}"></script>

    @stack('scripts')
</body>

</html>