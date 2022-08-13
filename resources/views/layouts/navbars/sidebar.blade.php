<!-- Código para tener la id del usuario -->
@if(Auth::check())
    <meta name="user-id" content="{{ Auth::user()->id }}">
    <meta name='userag' content="{{ Auth::user()->tipoUsuario }}">
@endif

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand text-warning display-1" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/granos.png" class="navbar-brand-img" alt="..."><br>
            COFFEEMOON 
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/bolsa.png">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Bienvenido') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Mi perfil') }}</span>
                    </a>
                    <a href="{{route('avisoPrivacidad')}}" class="dropdown-item">
                        <i class="ni ni-single-copy-04"></i>
                        <span>Aviso de Privacidad</span>
                    </a>
                
                 
                
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                   </div>   
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/co.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                
                

                <!-- CLIENTE -->
                @if (auth()->user()->tipoUsuario=="0")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.alimentos') }}">
                      <i class="ni ni-chart-pie-35 text-default"></i>
                      <span class="nav-link-text">Alimentos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.pedidos') }}">
                      <i class="ni ni-user-run text-default"></i>
                      <span class="nav-link-text">Historial de Pedidos</span>
                    </a>
                </li>
                @endif

                <!-- RESERVAS -->
                @if (auth()->user()->tipoUsuario=="0")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.reservas') }}">
                      <i class="ni ni-chart-pie-35 text-default"></i>
                      <span class="nav-link-text">Reservas</span>
                    </a>
                </li>             
                @endif

                <!-- REPARTIDOR -->
                @if(auth()->user()->tipoUsuario=="1")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.pedidoActual') }}">
                      <i class="ni ni-satisfied text-default"></i>
                      <span class="nav-link-text">Ver pedido actual</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.pedidos') }}">
                      <i class="ni ni-user-run text-default"></i>
                      <span class="nav-link-text">Ver pedidos disponibles</span>
                    </a>
                </li>
                @endif
               
                

                <!-- NEGOCIO -->
                @if(auth()->user()->tipoUsuario=="2")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.alimentos') }}">
                      <i class="ni ni-chart-pie-35 text-default"></i>
                      <span class="nav-link-text">Alimentos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.pedidos') }}">
                      <i class="ni ni-user-run text-default"></i>
                      <span class="nav-link-text">Ver pedidos pendientes</span>
                    </a>
                </li>
                @endif

                <!-- ADMINISTRADOR -->
                @if (auth()->user()->tipoUsuario=="8")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.clientes') }}">
                      <i class="ni ni-satisfied text-default"></i>
                      <span class="nav-link-text">Administrar clientes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.negocios') }}">
                      <i class="ni ni-building text-default"></i>
                      <span class="nav-link-text">Administrar sucursales</span>
                    </a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" href="{{ route('m.repartidores') }}">
                      <i class="ni ni-user-run text-default"></i>
                      <span class="nav-link-text"> Administrar repartidores</span>
                    </a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.reservas') }}">
                      <i class="ni ni-user-run text-default"></i>
                      <span class="nav-link-text"> Administrar reservas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.alimentos') }}">
                      <i class="ni ni-chart-pie-35 text-default"></i>
                      <span class="nav-link-text">Administrar alimentos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('m.pedidos') }}">
                      <i class="ni ni-user-run text-default"></i>
                      <span class="nav-link-text">Administrar pedidos</span>
                    </a>
                </li>
               
                
                @endif
        

            </ul>

            
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/components/alerts.html">
                        
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
