-- Active: 1727749710871@@localhost@3308@db_apotek
@extends('templates.app', ['title' => 'Add Medicine | APOTEK'])

@section('dynamic-content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h2 class="mb-0">Tambah Obat</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('medicines.add.store') }}" method="POST">
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
                            {{-- aturan CRUD
                                1. method POST 
                                2. name dari field
                                3. harus ada @csrf
                                4. form dari CRUD harus beda dengan return('view')
                            --}} @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Obat</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Tipe Obat</label>
                                <select class="form-select" name="type" id="type">
                                    <option selected disabled>Pilih tipe obat</option>
                                    <option value="tablet" {{ old('type') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                    <option value="sirup"{{ old('type') == 'sirup' ? 'selected' : '' }}>Sirup</option>
                                    <option value="kapsul"{{ old('type') == 'kapsul' ? 'selected' : '' }}>Kapsul</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga Obat</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        value="{{ old('stock') }}">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">Tambah Obat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
