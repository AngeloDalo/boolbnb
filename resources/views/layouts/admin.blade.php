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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ps-3 justify-content-between"
      style="position: fixed; top: 0; width: 100%">
      <a href="{{ url('/') }}"><img src="{{ asset('img/logoBoolBnb.png') }}" alt="logo" class=""
          style="width: 50px"></a>

      <ul class="list-unstyled me-5">
        <li class="nav-item dropdown">
          <a id="bottone-navbar" class="nav-link dropdown-toggle btn btn-danger text-white" href="#" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre="">
            Admin
          </a>
  
          <div class="dropdown-menu dropdown-menu-right me-5" aria-labelledby="navbarDropdown" style="left: -34px">
            <a class="dropdown-item" href="{{ url('/') }}">
              Home
            </a>
            <a class="dropdown-item" href="{{ route('admin.apartments.index') }}">
              My apartments
            </a>
            <a class="dropdown-item" href="{{ route('admin.apartments.create') }}">
              Add apartment
            </a>
            <a class="dropdown-item" href="http://127.0.0.1:8000/logout"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
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

      </ul>
      {{-- <div class="btn-group me-2 dropdown" >
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          Action
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </div> --}}
    </nav>
    <main>
      <div class="container-fluid" style="padding-top: 6em;">
        <div class='row'>
          <nav id='sidebarMenu' class='col-sm-12 col-md-12 col-lg-2 bg-light sidebar me-5'>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light border border-danger rounded-3"
              style="position: fixed; height: 80%">
              <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                  <a href="{{ url('/') }}" class="nav-link text-danger" aria-current="page">
                    <i class="bi bi-house" style="color:#03306D"></i>
                    Home
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.apartments.index') }}" class="nav-link text-danger">
                    <i class="bi bi-grid" style="color:#03306D"></i>
                    My apartments
                  </a>
                </li>
                <li>
                  <a href="{{ route('admin.apartments.create') }}" class="nav-link text-danger">
                    <i class="bi bi-plus-square" style="color:#03306D"></i>
                    Add a new apartment
                  </a>
                </li>

              </ul>
              <hr>
              <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-danger"
                  id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('img/logoBoolBnb.png') }}" alt="" width="32" height="32"
                    class="rounded-circle me-2">
                  <strong style="color:#03306D">{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                  <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
