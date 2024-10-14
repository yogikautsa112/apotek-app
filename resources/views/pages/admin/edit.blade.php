@extends('templates.app', ['title' => 'Edit Akun | APOTEK'])

@section('dynamic-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Edit Akun</h1>
                @if (Session::get('failed'))
                    <div class="alert alert-danger">
                        {{ Session::get('failed') }}
                    </div>
                @endif
                <form action="{{ route('users.edit.update', $user['id']) }}" method="POST" class="form-control p-4">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user['name'] }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" value="{{ $user['email'] }}"
                            class="form-control">
                        @error('stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="role" class="form-label">Tipe Akun</label>
                        <select name="role" id="role" class="form-select">
                            <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kasir" {{ $user['role'] == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        </select>
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-dark">Ubah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
