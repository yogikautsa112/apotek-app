@extends('templates.app', ['title' => 'Register | APOTEK'])

@section('dynamic-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 class="mb-4">Register</h2>
                <form method="POST" action="{{ route('regisAction') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirm" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="passwordConfirm" required>
                    </div>
                    <button type="submit" class="btn btn-success">Register</button>
                </form>
                <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
            </div>
        </div>
    </div>
@endsection
