<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .navbar-dark {
            background-color: #343a40;
        }
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.5);
        }
        .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, 0.75);
        }
        .navbar-brand {
            color: white;
        }
        .navbar-brand:hover {
            color: white;
        }
        .navbar-text {
            color: rgba(255, 255, 255, 0.5);
        }
        .dropdown-item.active {
            background-color: #26355d;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                Sistem Informasi Poliklinik
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Request::is('pasien*') || Request::is('dokter*') ? 'active' : '' }}" 
                               href="#" 
                               role="button" 
                               data-bs-toggle="dropdown">
                                Data Master
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ Request::is('pasien*') ? 'active' : '' }}" 
                                       href="{{ route('pasien.index') }}">
                                        Data Pasien
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Request::is('dokter*') ? 'active' : '' }}" 
                                       href="{{ route('dokter.index') }}">
                                        Data Dokter
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('periksa*') ? 'active' : '' }}" 
                               href="{{ route('periksa.index') }}">
                                Pemeriksaan
                            </a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOgQpeKBmBIpJRrgE0h7FeC5O1fYCBYlYw5y3e8+2ig" crossorigin="anonymous"></script>
