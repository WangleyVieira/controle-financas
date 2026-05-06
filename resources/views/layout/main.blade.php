<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <title>Controle de Finanças</title>
        <meta name="description" content="Sistema de controle financeiro pessoal — gerencie lançamentos, categorias e mais.">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        {{-- Custom premium theme (overrides AdminKit defaults) --}}
        <link rel="stylesheet" href="{{ asset('css/style-custom.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.0/r-2.2.9/rr-1.2.8/datatables.min.css"/>
        <link href="{{asset('select2-4.1.0/dist/css/select2.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('select2-bootstrap/dist/select2-bootstrap.css')}}"/>
        <script src="{{ asset('js/jquery.js') }}"></script>
    </head>

    <body>
        <div class="wrapper">
            <nav id="sidebar" class="sidebar js-sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class="sidebar-brand" href="index.html">
                        <span class="align-middle">Controle de Finanças</span>
                    </a>

                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Páginas
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="index.html">
                                <i class="align-middle fas fa-chart-line"></i> <span class="align-middle">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="pages-profile.html">
                                <i class="align-middle fas fa-user"></i> <span class="align-middle">Perfil</span>
                            </a>
                        </li>

                        <li class="sidebar-header">
                            Finanças
                        </li>

                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="ui-buttons.html">
                            <i class="align-middle fas fa-chart-line"></i> <span class="align-middle">Entradas</span>
                            </a>
                        </li> --}}

                        <li class="sidebar-item {{ Request::is('lancamentos*') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('lancamento.index') }}">
                            <i class="align-middle fas fa-chart-line"></i> <span class="align-middle">Lançamentos</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="#">
                            <i class="align-middle fas fa-chart-area"></i> <span class="align-middle">Gastos Anuais</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="ui-forms.html">
                            <i class="align-middle fas fa-layer-group"></i> <span class="align-middle">Parcelamentos</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="ui-forms.html">
                            <i class="align-middle fas fa-credit-card"></i> <span class="align-middle">Cartões de Crédito</span>
                            </a>
                        </li>

                        <li class="sidebar-header">
                            Controle
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="charts-chartjs.html">
                            <i class="align-middle fas fa-shopping-cart"></i> <span class="align-middle">Compras Variadas</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="maps-google.html">
                            <i class="align-middle fas fa-chart-bar"></i> <span class="align-middle">Relatórios</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="maps-google.html">
                            <i class="align-middle fas fa-history"></i> <span class="align-middle">Histórico</span>
                            </a>
                        </li>

                        <li class="sidebar-header">
                            Configurações
                        </li>

                        <li class="sidebar-item {{ Request::is('configuracao/categoria') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('configuracao.categoria.index') }}">
                            <i class="align-middle fas fa-tags"></i> <span class="align-middle">Categorias</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('configuracao/tipo-categoria') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('configuracao.tipo_categoria.index') }}">
                            <i class="align-middle fas fa-bullseye"></i> <span class="align-middle">Tipo de Categoria</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('configuracao/responsavel') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('configuracao.responsavel.index') }}">
                            <i class="align-middle fas fa-user-check"></i> <span class="align-middle">Responsável</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ Request::is('configuracao/usuario') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('configuracao.usuario.index') }}">
                            <i class="align-middle fas fa-users"></i> <span class="align-middle">Usuários</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="main">
                <nav class="navbar navbar-expand navbar-light navbar-bg">
                    <a class="sidebar-toggle js-sidebar-toggle">
                        <i class="hamburger align-self-center"></i>
                    </a>

                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav navbar-align">
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                    <i class="align-middle" data-feather="settings"></i>
                                </a>

                                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                    <span class="text-dark">{{ Auth::user()->name }} - {{ Auth::user()->email }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">

                                    {{-- <a class="dropdown-item" href="#">Log out</a> --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="content">
                    @yield('content')
                </main>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-start">
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        {{-- Bootstrap 4.5 — inclui jQuery plugin .modal(), data-toggle, data-dismiss nativos --}}
        <script src="{{ url('js/bootstrap.js') }}"></script>

        <script src="{{asset('jquery-mask/dist/jquery.mask.min.js')}}"></script>
        <script src="{{ url('js/fontawesome.js') }}"></script>
        <script src="{{ url('js/functions.js') }}"></script>
        <script src="{{ url('js/prevent_multiple_submits.js') }}"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.0/r-2.2.9/datatables.min.js"></script>
        <script src="{{asset('select2-4.1.0/dist/js/select2.min.js')}}"></script>
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script src="{{asset('jquery-mask/src/jquery.mask.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.17/inputmask.js" integrity="sha512-XvlcvEjR+D9tC5f13RZvNMvRrbKLyie+LRLlYz1TvTUwR1ff19aIQ0+JwK4E6DCbXm715DQiGbpNSkAAPGpd5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @yield('scripts')
    </body>
</html>




