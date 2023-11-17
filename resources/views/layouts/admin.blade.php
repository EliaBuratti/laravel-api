    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin') }}</title>

        <!-- Fontawesome 6 cdn -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
            integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
            crossorigin='anonymous' referrerpolicy='no-referrer' />

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Usando Vite -->
        @vite(['resources/js/app.js'])
    </head>

    <body>
        <div id="app">

            <header class=" d-flex justify-content-between navbar-dark sticky-top bg-dark flex-md-nowrap p-2 shadow">
                <div class="col-2 text-center">
                    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3"
                        href="/">{{ Route::currentRouteName() }}</a>
                    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="col-6">
                    <input class="form-control form-control-dark" type="text" placeholder="Search"
                        aria-label="Search">
                </div>
                <div class="col-2 text-center">
                    <ul class="m-0 list-unstyled">
                        <li class="nav-item dropdown">
                            <a class="btn btn-success dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item"
                                        href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <div class="nav-item text-nowrap">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </header>



            <div class="container-fluid vh-100">
                <div class="row h-100">
                    <!-- Definire solo parte del menu di navigazione inizialmente per poi
                    aggiungere i link necessari giorno per giorno
                    -->
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar collapse">
                        <div class=" pt-3">
                            <ul class="nav flex-column">
                                <li
                                    class="nav-item mb-3 btn btn-outline-secondary text-start {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary rounded-3' : '' }}">
                                    <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                                        <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i> Dashboard
                                    </a>
                                </li>
                                <li
                                    class="nav-item mb-3 btn btn-outline-secondary text-start {{ Route::currentRouteName() == 'admin.project.index' ? 'bg-secondary rounded-3' : '' }}">
                                    <a class="nav-link text-white " href="{{ route('admin.project.index') }}">
                                        <i class="fa-solid fa-clipboard-list fa-lg fa-fw"></i> Project
                                    </a>
                                </li>
                                <li
                                    class="nav-item mb-3 btn btn-outline-secondary text-start {{ Route::currentRouteName() == 'admin.type.index' ? 'bg-secondary rounded-3' : '' }}">
                                    <a class="nav-link text-white " href="{{ route('admin.type.index') }}">
                                        <i class="fa-solid fa-grip fa-lg fa-fw"></i> Type
                                    </a>
                                </li>
                                <li
                                    class="nav-item mb-3 btn btn-outline-secondary text-start {{ Route::currentRouteName() == 'admin.technology.index' ? 'bg-secondary rounded-3' : '' }}">
                                    <a class="nav-link text-white " href="{{ route('admin.technology.index') }}">
                                        <i class="fa-solid fa-tags fa-lg fa-fw"></i> Technology
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

        </div>
    </body>

    </html>
