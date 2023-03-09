<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPP</title>

    {{-- icon web app --}}
    <link rel="shortcut icon" href="{{ asset('storage/images/logo_aplikasi.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    {{-- Link CSS Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles()

    @stack('css')

    {{-- Plugin JqueryCDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Plugin Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <!-- load satu -->
    <link rel="stylesheet" href="{{ asset('loadAnimations/loadSatu.css') }}">
    <!-- load dua -->
    <link rel="stylesheet" href="{{ asset('loadAnimations/loadDua.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('storage/images/logo_aplikasi.png') }}" alt="Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ __('SMKN 1 KATAPANG') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::user()->photo == null)
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="img"
                                class="rounded-circle" height="150px" width="150" id="myImg">
                        @endif

                        @if (Auth::user()->photo != null)
                            <img src="{{ asset('storage/profile/' . Auth::user()->photo) }}" alt="img"
                                class="rounded-circle" style="width: 40px; height: 40px;" id="myImg">
                        @endif
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                        {{-- public --}}
                        <li class="nav-item {{ Route::currentRouteName() == 'home' || Route::currentRouteName() == 'detailCetak' ? ' active bg-gradient-primary' : '' }}">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="nav-icon bi bi-house-fill"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>

                        @can('pengelola')
                            <li class="nav-item {{ Route::currentRouteName() == 'showProfile' || Route::currentRouteName() == 'changeProfile' ? ' active bg-gradient-primary' : '' }}">
                                <a href="{{ route('showProfile') }}" class="nav-link">
                                    <i class="nav-icon bi bi-person-circle"></i>
                                    <p>
                                        Profile
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item {{ Route::currentRouteName() == 'dataTransaksi' ? ' active bg-gradient-primary' : '' }}">
                                <a href="{{ route('dataTransaksi') }}" class="nav-link">
                                    <i class="nav-icon bi bi-bank"></i>
                                    <p>
                                        Transaksi
                                    </p>
                                </a>
                            </li>
                        @endcan

                        @can('siswa')
                        <li class="nav-item {{ Route::currentRouteName() == 'dataBayar' || Route::currentRouteName() == 'dataBayarDetail' ? ' active bg-gradient-primary' : '' }}">
                            <a href="{{ route('dataBayar') }}" class="nav-link">
                                <i class="nav-icon bi bi-globe2"></i>
                                <p>
                                    Bayar
                                </p>
                            </a>
                        </li>
                        @endcan

                        @can('admin')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="bi bi-table"></i>
                                    <p>
                                        Created data user
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item {{ Route::currentRouteName() == 'makeSiswa' ? ' active bg-gradient-primary' : '' }}">
                                        <a href="{{ route('makeSiswa') }}" class="nav-link">
                                            <i class="nav-icon bi bi-person"></i>
                                            <p>
                                                Create data Siswa
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item {{ Route::currentRouteName() == 'makePetugas' ? ' active bg-gradient-primary' : '' }}">
                                        <a href="{{ route('makePetugas') }}" class="nav-link">
                                            <i class="nav-icon bi bi-person-badge"></i>
                                            <p>
                                                Create data Petugas
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item {{ Route::currentRouteName() == 'dataCreate' ? ' active bg-gradient-primary' : '' }}">
                                <a href="{{ route('dataCreate') }}" class="nav-link">
                                    <i class="nav-icon bi bi-calendar-week"></i>
                                    <p>
                                        Data Create
                                    </p>
                                </a>
                            </li>
                        @endcan


                        <li class="nav-item ">
                            <a href="/home/message" class="nav-link">
                                <i class="nav-icon bi bi-chat-left-text"></i>
                                <p>
                                    Chatting
                                </p>
                            </a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() == 'logout' ? ' active bg-gradient-primary' : '' }}">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>
                                    Keluar
                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022 RPL 1 Aplikasi Pembayaran SPP</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>

    @livewireScripts()

    @stack('js')

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('template/dist/js/pages/dashboard3.js') }}"></script>

</body>

</html>
