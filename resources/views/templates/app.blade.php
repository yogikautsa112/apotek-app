<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    {{-- Icon Bar --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/iconApotek.png') }}" class=>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    {{-- stack : wadah penampung content dinamis namun optional biasanya untuk wadah styling tambahan atau script tambahan --}}
    @stack('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-lg-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">APOTEK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('loginPage') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('login') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('landing_page') ? 'active' : '' }} "
                            href="{{ route('landing_page') }}"> Landing </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('medicines') ? 'active' : '' }} "
                            href="{{ route('medicines') }}">Data Obat</a>
                    </li>
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('menage') ? 'active' : '' }} "
                                href="{{ route('menage') }}">Kelola Akun</a>
                        </li>
                    @endif
                </ul>
                <form action="{{ route('medicines') }}" method="GET" class="d-flex" role="search">
                    {{-- Mengaktifkan form di laravel:
                    1. di <form> ada action dan method
                        GET : untuk search
                        POST : untuk menambah/mengubah/ mengahpus data
                    2. ada button type submit
                    3. di <input> harus ada name
                    4. action di isi dari wbe.php
                    --}}
                    <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-dark" type="submit"><i class="fa fa-search"></i> </button>
                </form>
            </div>
        </div>
    </nav>
    @yield('dynamic-content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('script')
</body>

</html>
