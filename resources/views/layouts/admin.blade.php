<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard </title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/shop.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">

</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/admin">Welcome, {{ Auth::user()->name }}</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Signout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        </li>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">

                            <a class="nav-link {{ Request::path() === 'admin' ? 'active' : '' }}" aria-current="page"
                                href="/admin">
                                <span data-feather="home"></span> Dashboard
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Request::path() === "admin/patient" ? 'active' : '' }}" href="/admin/patient">
                                <span data-feather="file"></span> Patients

                            </a>
                        </li>

                        <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Prescriptions</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() === "admin/prescription" ? 'active' : '' }}" href="/admin/prescription">
                                <span data-feather="shopping-cart"></span> prescription
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() === "admin/prescriptionform" ? 'active' : '' }}" href="/admin/prescriptionform">
                                <span data-feather="shopping-cart"></span> prescription Form
                            </a>
                        </li>


                    </ul>

                    {{-- only pharmacities can access it --}}
                    @if(Auth::user()->is_pharmacist == '1')

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() === "admin/pharmacist" ? 'active' : '' }}" href="/admin/pharmacist">
                                <span data-feather="shopping-cart"></span> pharmacy
                            </a>
                        </li>
                    </ul>
                    @endif




                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>User Profiles</span>
                        <a class="link-secondary" href="#" aria-label="Add a new report">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item ">
                            <?php $auth_user = Auth::user()->id; ?>
                            <a class="nav-link {{ Request::path() === "admin/profile/". $auth_user ? 'active' : '' }}" href="/admin/profile/<?=$auth_user?>" >

                                <span data-feather="user"></span> Profile

                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>
