<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'BoolBnb') }}</title>
  <link rel="icon" type="image/x-icon" href="/public/favicon.ico">


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps.css'>
  <!-- Scripts -->
  @yield('script')
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 0 !important">
      <div class="container">
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          {{-- <ul class="navbar-nav mr-auto">

                    </ul> --}}

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto w-100 justify-content-between align-items-center ">
            <!-- Authentication Links -->
            @guest
              <a class="navbar-brand" href="{{ url('/') }}">
                <img style="width: 60px" src="{{ URL('img/logoBoolBnb.png') }}" alt="">
              </a>
              <div class="d-flex">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}" style="color: #dc3545"><i
                      class="bi bi-box-arrow-in-right"></i>
                    {{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}" style="color: #dc3545"><i
                        class="bi bi-pencil-square"></i> {{ __('Register') }}</a>
                  </li>
                @endif

              </div>
            @else
              <a class="navbar-brand" href="{{ url('/') }}">
                <img style="width: 60px" src="{{ URL('img/logoBoolBnb.png') }}" alt="">
              </a>
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-danger text-white" href="#" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('admin.apartments.index') }}">
                    Dashboard
                  </a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                                                                           document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main id="app">
      @yield('content')
    </main>
  </div>
  <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps-web.min.js"></script>
  <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/services/services-web.min.js"></script>
</body>

</html>
