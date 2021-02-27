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
                                    <li><a href="{{ route('index') }}">Inicio</a></li>
                                    <li><a href="{{ route('courses.index') }}">Cursos</a></li>
                                    @if (!Auth::guest())
                                        <li><a href="{{ route('user.my-courses') }}">Mis Cursos</a></li>
                                    @endif
                                    <li><a href="{{ route('events.index') }}">Eventos</a></li>
                                    @if (!Auth::guest())
                                        <li><a href="{{ route('user.my-events') }}">Mis Eventos</a></li>
                                    @endif
                                    <li><a href="{{ route('news.index') }}">Noticias</a></li>
                                    {{--<li><a href="#">Contáctanos</a></li>--}}
                                    @if (Auth::guest())
                                        <li><a href="{{ route('login') }}">Entrar</a></li>
                                        <li><a href="{{ route('register') }}">Registrarme</a></li>
                                    @else
                                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a></li>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
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