<header class="top">
    <div class="header-area two header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="logo">
                        <a href="{{ route('index') }}"><img src="{{ asset('logos/logo.png')}}" alt="Solar Providencia" /></a>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-6">
                    <div class="content-wrapper text-right">
                        <!-- Main Menu Start -->
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li><a href="{{ route('index') }}">Inicio</a></li>
                                    <li><a href="{{ route('courses.index') }}">Cursos</a></li>
                                    <li><a href="event.html">Eventos</a></li>
                                    <li><a href="{{ route('news.index') }}">Noticias</a></li>
                                    <li><a href="contact.html">Contáctanos</a></li>
                                    @if (Auth::guest())
                                    <li><a href="#">Entrar</a></li>
                                    <li><a href="#">Registrarme</a></li>
                                    @else
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a></li>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </ul>
                            </nav>
                        </div>
                        <!--Search Form Start-->
                        <div class="search-btn">
                            <ul data-toggle="dropdown" class="header-search search-toggle">
                                <li class="search-menu">
                                    <i class="fa fa-search"></i>
                                </li>
                            </ul>
                            <div class="search">
                                <div class="search-form">
                                    <form id="search-form" method="GET" action="{{ route('courses.search') }}">
                                        <input type="search" placeholder="Buscar curso..." name="busqueda" />
                                        <button type="submit">
                                            <span><i class="fa fa-search"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--End of Search Form-->
                        <!-- Main Menu End -->
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="mobile-menu hidden-lg hidden-md hidden-sm"></div>
                </div>
            </div>
        </div>
    </div>
</header>