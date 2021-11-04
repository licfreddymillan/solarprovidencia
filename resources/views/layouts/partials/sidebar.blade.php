<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header" style="height: 80px !important;">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('logos/logo.png')}}" alt="Admin Solar" style="width: 160px;">
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a href="index.html"><i class="feather icon-home"></i><span class="menu-title">Inicio</span></a>
            </li>
            <li class="nav-item"><a href="{{ route('admin.pending-class') }}"><i class="feather icon-video"></i><span class="menu-title">Clases Pendientes</span></a></li>
            <li class="nav-item"><a href="{{ route('admin.courses') }}"><i class="feather icon-video"></i><span class="menu-title">Cursos</span></a></li>
            <li class="nav-item"><a href="{{ route('admin.events') }}"><i class="feather icon-calendar"></i><span class="menu-title">Eventos</span></a></li>
            <li class="nav-item"><a href="{{ route('admin.news') }}"><i class="feather icon-message-square"></i><span class="menu-title">Noticias</span></a></li>
            <li class="nav-item"><a href="{{ route('admin.purchases.index') }}"><i class="feather icon-shopping-cart"></i><span class="menu-title">Historial de Compras</span></a></li>
            <li class=" nav-item"><a href="#"><i class="feather icon-book"></i><span class="menu-title" data-i18n="User">Transferencias</span></a>
                <ul class="menu-content">
                    <li><a href="{{ route('admin.transfers.pending') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="List">Pendientes</span></a>
                    </li>
                    <li><a href="{{ route('admin.transfers.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View">Historial</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{ route('admin.users.index') }}"><i class="feather icon-user"></i><span class="menu-title">Listado de Usuarios</span></a></li>
        </ul>
    </div>
</div>