<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{url('css/styles.css')}}" rel="stylesheet" />
    <script src="{{ url('assets/fontawesome-free-6.7.2/js/all.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ url('/')}}">{{ config('app.name', 'Laravel') }}</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
{{--    <h4 class="navbar-text">Perfil</h4>--}}
    @isset($header)
        <header >
            <div class="navbar-text">
                {{ $header }}
            </div>
        </header>
    @endisset
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">


{{--            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />--}}
{{--            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>--}}
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
{{--                <li><a class="dropdown-item" href="{{ url("setting") }}">{{__('Settings')}}</a></li>--}}
                <li><a class="dropdown-item" href="{{ url("profile") }}">{{__("Profile")}}</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>

                    <form id="formlogout" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>



                </li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    <div class="sb-sidenav-menu-heading">{{ __('Admin') }}</div>
{{--                    <a class="nav-link" href="{{ url('settings')}}">--}}
{{--                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>--}}
{{--                        {{__('Settings')}}--}}
{{--                    </a>--}}

{{--                    <div class="sb-sidenav-menu-heading">{{__('Core')}}</div>--}}
                    <a class="nav-link" href="{{ url('dashboard')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        {{__('Dashboard')}}
                    </a>
                    <a class="nav-link" href="{{ url('profile')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                        {{__('Profile')}}
                    </a>

                    <hr class="nav-separator">

                    <button type="button" class="nav-link btn btn-link" onclick="formlogout.submit()" >
                        <div class="sb-nav-link-icon"><i class="fas fa-right-to-bracket"></i></div>
                        {{__('Logout')}}
                    </button>





                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->username ?? Auth::user()->document ?? Auth::user()->email ?? ""}}
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        {{ $slot }}
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div  class="text-muted small"><a href="mailto:oswaldo.paulo@gmail.com">Copyright &copy; oswaldo.paulo@gmail.com</a></div>
                    <div>
                        <a href="{{ url('privacy') }}">Privacy Policy</a>
                        &middot;
                        <a href="{{ url('terms') }}">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{ url('assets/bootstrap-5.0.2/js/bootstrap.bundle.js') }}"></script>
<script src="{{ url('assets/jquery-3.7.1.min.js') }}"></script>
<script src="{{url('js/scripts.js')}}"></script>
</body>
</html>
