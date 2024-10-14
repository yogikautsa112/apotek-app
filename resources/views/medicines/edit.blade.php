@extends('templates.app', ['title' => 'Edit Medicine | APOTEK'])

@section('dynamic-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Edit Obat</h1>
                @if (Session::get('failed'))
                    <div class="alert alert-danger">
                        {{ Session::get('failed') }}
                    </div>
                @endif
                <form action="{{ route('medicines.edit.update', $medicine['id']) }}" method="POST" class="form-control p-4">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama Obat</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $medicine['name'] }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="type" class="form-label">Tipe Obat</label>
                        <select name="type" id="type" class="form-select">
                            <option value="tablet" {{ $medicine['type'] == 'tablet' ? 'selected' : '' }}>Tablet</option>
                            <option value="sirup" {{ $medicine['type'] == 'sirup' ? 'selected' : '' }}>Sirup</option>
                            <option value="kapsul" {{ $medicine['type'] == 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                        </select>
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" name="price" id="price" value="{{ $medicine['price'] }}"
                            class="form-control">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="text" name="stock" id="stock" value="{{ $medicine['stock'] }}"
                            class="form-control">
                        @error('stock')
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
