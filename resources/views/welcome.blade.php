<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestión de Pensiones">
    <meta name="author" content="Alexander Marcano A">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>.:: Sistema de Gestión | Pensión a la medida ::.</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/logo.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/logo.ico">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/logo.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/logo.ico">

    {{-- <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png"> --}}
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->

    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>

    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/all.min.css">
    <link href="{{ asset('fontawesome5.13.1/css/all.css') }}" rel="stylesheet">
    <!--load all styles -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/component-chosen.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/stylos.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/parsleyjs/dist/parsley.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('js/css/alertify.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/css/themes/default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/css/themes/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/css/themes/bootstrap.min.css') }}" />
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap4.css') }}"
        rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link
        href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('vendors/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/typeahead.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/jQuery-Smart-Wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/PNotifyBrightTheme.css') }}" rel="stylesheet" type="text/css" />
    
    @yield('css')
</head>
<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-lg-down-none" style="background-color: #EBEDEF!important;">
            <!-- <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#full"></use>
      </svg> -->
      @php
         $logo = \App\Empresa::select('logo')->first(); 
      @endphp
            <div id="logoWelcome">
            <img src="{{ asset("$logo->logo") }}" alt="" width="118" height="46" class="img-fluid">
            </div>

            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="{{ asset('assets/brand/coreui.svg#signet') }}"></use>
            </svg>
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                    </svg> Tablero
                </a>
            </li>
            <li class="c-sidebar-nav-title">Opciones del Sistema</li>
            @can('gestionar_pension')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{URL::to('/gestionar-estudiantes')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                        </svg> Estudiantes
                    </a>
                </li>
            @endcan
            @can('gestionar_clientes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{URL::to('/gestion-clientes')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-contact') }}"></use>
                        </svg> Expediente académico
                    </a>
                </li>
            @endcan
            @can('gestionar_clientes')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{URL::to('/gestion-residencia')}}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-house') }}"></use>
                        </svg> Residencia
                    </a>
                </li>
            @endcan
            @can('menu_informes')
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-print') }}"></use>
                    </svg> Informes
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('informe1')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="#">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/brand.svg#cib-adobe-acrobat-reader') }}"></use>
                            </svg> Informe 1
                        </a>
                    </li>
                    @endcan
                    @can('informe2')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="#">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/brand.svg#cib-adobe-acrobat-reader') }}"></use>
                            </svg> Informe 2
                        </a>
                    </li>
                    @endcan
                    @can('informe3')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="#">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/brand.svg#cib-adobe-acrobat-reader') }}"></use>
                            </svg> Informe 3
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('menu_configuracion')
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a
                        class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-settings') }}"></use>
                        </svg> Configuración</a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        @can('mantenimiento_usuarios')
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{URL::to('/gestion-usuarios')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                                    </svg> Gestión de Usuarios
                                </a>
                            </li>
                        @endcan
                        @can('mantenimiento_empresa')
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{URL::to('/informacion-empresa')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-building') }}"></use>
                                    </svg> Información de Empresa
                                </a>
                            </li>
                        @endcan
                        @can('gestion_roles')
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link" href="{{URL::to('/gestion-roles')}}">
                                    <svg class="c-sidebar-nav-icon">
                                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-shield-alt') }}"></use>
                                    </svg> Gestión de Roles
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                </svg>
            </button>
            <a class="c-header-brand d-lg-none" href="#">
                {{-- <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="assets/brand/coreui.svg#full"></use>
                </svg></a> --}}
                <img src="{{ asset('img/logo.png') }}" alt="" width="118" height="46">
            </a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                </svg>
            </button>

            <ul class="c-header-nav ml-auto mr-4">
                <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
                        </svg></a></li>
                <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                        </svg></a></li>
                <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link" href="#">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
                        </svg></a></li>
                <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('img/user-icon.png') }}" alt="user@email.com">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">

                        <div class="dropdown-header bg-light py-2">
                            <strong>Configuración</strong>
                        </div>
                        <a class="dropdown-item" href="{{URL::to('/ver-perfil')}}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                            </svg> Perfil
                        </a>
                        <a class="dropdown-item" href="{{URL::to('/cambiar-contrasena')}}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-settings') }}"></use>
                            </svg> Cambiar Contraseña
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use>
                            </svg> Bloquear Cuenta
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}"></use>
                            </svg> Cerrar Sesión
                        </a>
                    </div>
                </li>
            </ul>
            <div class="c-subheader px-3" id="migas-pan">
                <!-- Breadcrumb-->
                <ol class="breadcrumb border-0 m-0">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Tablero</li>
                    <!-- Breadcrumb Menu-->
                </ol>
            </div>
        </header>
        <div class="c-body">
            @yield('contenido')
            <div class="d-flex flex-column ">
                <footer class="c-footer">
                    <div>Sistema de Gestión desarrollado por <a
                            href="https://www.linkedin.com/in/alexander-j-marcano-a-680016a8">Ingeniero Alexander
                            Marcano
                            A.</a></div>
                </footer>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <!--[if IE]><!-->
    <script src="{{ asset('vendors/@coreui/icons/js/svgxuse.min.js') }}"></script>
    <!--<![endif]-->

    <script src="{{ asset('vendors/@coreui/chartjs/js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('vendors/@coreui/utils/js/coreui-utils.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="{{ asset('vendors/jquery/dist/jquery.js') }}"></script>
    

    <script src="{{ asset('vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->

    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('jsApp/funcGral.js') }}"></script>
    <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('vendors/parsleyjs/dist/parsley.js') }}"></script>
    <script src="{{ asset('vendors/parsleyjs/dist/es.js') }}"></script>
    <script src="{{ asset('vendors/parsleyjs/dist/comparison.js') }}"></script>
    <script src="{{ asset('js/alertify.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}">
    </script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}">
    </script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}">
    </script>
    <script
        src="{{ asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}">
    </script>
    <script src="{{ asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}">
    </script>
    <script
        src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}">
    </script>
    <script src="{{ asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}">
    </script>
    <script src="{{ asset('vendors/moment/min/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('vendors/dropzone/dist/dropzone.js') }}"></script>
    <script src="{{ asset('js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/PNotify.js') }}"></script>
    <script src="{{ asset('js/PNotifyBootstrap4.js') }}"></script>

   
    @yield('javascript')

</body>

</html>