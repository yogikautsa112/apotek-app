@extends('templates.app', ['title' => 'Add Account | APOTEK'])

@section('dynamic-content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h2 class="mb-0">Tambah Akun</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user_add.store') }}" method="POST" ">
                                @if (Session::get('failed'))
                            <div class="alert alert-success">
                                {{ Session::get('failed') }}
                            </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ol>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                    value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Tipe Akun</label>
                                <select class="form-select" name="role" id="role">
                                    <option selected disabled>Pilih tipe akun</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Tambah Akun</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
