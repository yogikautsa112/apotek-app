@extends('templates.app', ['title' => 'Selamat Datang di Apotek Sehat'])

@section('dynamic-content')
    <div class="jumbotron jumbotron-fluid py-4 px-2">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-primary mx-3">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="display-4">Selamat Datang {{ Auth::user()->name }} !</h1>
            <hr>
            <p class="lead">Aplikasi ini digunakan hanya oleh pagawai Administrator APOTEK. Digunakan juga untuk
                mengelola obat, penyetokan, dan pembelian (Kasir)</p>
            <a href="{{ route('logout') }}"">Log Out</a>
        </div>
    </div>
@endsection
