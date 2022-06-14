<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet"/>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.js"></script>

    <style>
        body {
            background-color: #121212;
        }

        nav {
            background-color: #1F1F1F;
        }

        .card-header {
            background-color: #262626;
            color: white;
        }

        .card-body {
            background-color: #262626;
            color: white !important;
        }

        .col-form-label {
            color: white;
        }

        .blur {
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }
    </style>
    @yield('js')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @guest
                    @else
                        <li class="nav-item">
                            <a class="nav-link @if(route('home') === \Illuminate\Support\Facades\Request::url()) active @endif"
                               href="{{ route('home') }}">Dashboard</a>
                        </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-dark px-3 me-2 @if(route('login') === \Illuminate\Support\Facades\Request::url()) active @endif"
                                   href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary px-3 @if(route('register') === \Illuminate\Support\Facades\Request::url()) active @endif"
                                   href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <div style="margin-left: 1em" class="dropdown">
                            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                               id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown"
                               aria-expanded="false">
                                <span style="margin-right: 1em"
                                      class="text-white-50">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                <img src="{{asset('storage/'.auth()->user()->avatar)}}"
                                     class="rounded-circle" height="25" alt="Black and White Portrait of a Man"
                                     loading="lazy"/>
                            </a>
                            <ul
                                    class="dropdown-menu dropdown-menu-dark dropdown-menu-end"
                                    aria-labelledby="navbarDropdownMenuAvatar"
                            >
                                <li>
                                    <a class="dropdown-item" href="{{route('profile')}}"><i class="fas fa-user"></i> {{__('Profil')}}</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out"></i>
                                        {{ __('Abmelden') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
