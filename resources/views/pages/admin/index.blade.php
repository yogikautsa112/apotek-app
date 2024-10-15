@extends('templates.app', ['title' => 'Kelola Akun | APOTEK'])

@section('search')
    <form action="{{ route('menage') }}" method="GET" class="d-flex" role="search">
        {{-- Mengaktifkan form di laravel:
    1. di <form> ada action dan method
        GET : untuk search
        POST : untuk menambah/mengubah/ mengahpus data
    2. ada button type submit
    3. di <input> harus ada name
    4k. action di isi dari web.php
    --}}
        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-dark" type="submit"><i class="fa fa-search"></i> </button>
    </form>
@endsection

@section('dynamic-content')
    <div class="container mt-4">
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
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
        <div class="mb-3 flex justify-content-end">
            <a href="{{ route('user_add') }}" class="btn btn-dark bold">Tambah Akun</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $loop = 1;
                @endphp
                @if ($users->count() > 0)
                    @foreach ($users as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['role'] === 'admin' ? 'Admin' : ($item['role'] === 'kasir' ? 'Kasir' : $item['role']) }}
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('users.edit', $item->id) }}">Edit</a>
                                <button class="btn btn-danger"
                                    onclick="showModal('{{ $item->id }}' , '{{ $item->name }}')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="fw-bold text-center">Data Akun Kosong</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="modal fade" id="modalDeleteObat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" id="form-delete-obat" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Akun</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus Akun <span id="nama-obat"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModal(id, name) {
            let action = '{{ route('users.delete', ':id') }}';
            action = action.replace(':id', id);
            $('#form-delete-obat').attr('action', action);
            $('#modalDeleteObat').modal('show');
            $('#nama-obat').text(name);
        }
    </script>
@endpush
