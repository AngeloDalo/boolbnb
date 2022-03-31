<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <img src="{{ asset('img/logoBoolBnb.png') }}" alt="logo" class="" style="width: 50px">
        </nav>
        <main>
            <div class="container-fluid mt-5">
                <div class='row'>
                    <nav id='sidebarMenu' class='col-2 d-md-block bg-light sidebar collapse me-5'>
                        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item">
                                    <a href="{{ url('/') }}" class="nav-link active" aria-current="page">
                                        <i class="bi bi-house"></i>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="nav-link">
                                        <i class="bi bi-bar-chart-line"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.apartments.index') }}" class="nav-link">
                                        <i class="bi bi-grid"></i>
                                        My apartment
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.apartments.create') }}" class="nav-link">
                                        <i class="bi bi-plus-square"></i>
                                        Create apartment
                                    </a>
                                </li>

                            </ul>
                            <hr>
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                        class="rounded-circle me-2">
                                    <strong>{{ Auth::user()->name }}</strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                    aria-labelledby="dropdownUser1">
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class='col-9'>
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
