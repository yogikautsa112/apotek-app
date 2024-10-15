    @extends('templates.app', ['title' => 'Home || APOTEK'])
    @push('style')
    @endpush
    @section('dynamic-content')
        <div class="jumbotron jumbotron-fluid py-4 px-2">
            <div class="container">
                <h1 class="display-4">Selamat Datang {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Kasir' }} !</h1>
                <hr>
                <p class="lead">Aplikasi ini digunakan hanya oleh pagawai Administrator APOTEK. Digunakan juga untuk mengelola obat, penyetokan, dan pembelian (Kasir)</p>
            </div>
    </div>
    @endsection
