@extends('templates.app', ['title' => 'Medicines | APOTEK'])

@section('dynamic-content')
    <div class="container my-5">
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
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h2 class="mb-0">Daftar Obat</h2>
            </div>
            <div class="card-body">
                <div class="mb-3 text-end">
                    <a href="{{ route('medicines.add') }}" class="btn btn-dark"><i class="fa fa-plus-circle me-2"></i>Tambah
                        Obat</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($medicines) > 0)
                                @foreach ($medicines as $key => $item)
                                    <tr class="text-center">
                                        <td>{{ ($medicines->currentPage() - 1) * $medicines->perpage() + ($key + 1) }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                                        <td  style="cursor: pointer" class="{{ $item['stock'] <= 3 ? 'bg-danger text-white fw-bold' : 'bg-white text-dark' }}"
                                            onclick="editStock('{{ $item['id'] }}' , '{{ $item['stock'] }}')">
                                            {{ $item['stock'] }}
                                        </td>
                                        <td class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-primary"
                                                href="{{ route('medicines.edit', $item['id']) }}">Edit</a>
                                            <button onclick="showModal('{{ $item->id }}' , '{{ $item->name }}')"
                                                class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="fw-bold text-center">Data Obat Kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mb-3 text-end fw-bold">
                        {{ $medicines->links() }}
                    </div>

                    <div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="form-edit-stock" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editStockLabel">Edit Stok</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="medicine-id">
                                        <div class="form-group">
                                            <label for="stock" class="form-label">Stok</label>
                                            <input type="number" name="stock" id="stock" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="modalDeleteObat" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="" id="form-delete-obat" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Obat</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus obat <span id="nama-obat"></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
    </script>
    <script>
        function showModal(id, name) {
            let action = '{{ route('medicines.delete', ':id') }}';
            action = action.replace(':id', id);
            $('#form-delete-obat').attr('action', action);
            $('#modalDeleteObat').modal('show');
            $('#nama-obat').text(name);
        }

        function editStock(id, stock) {
            $('#medicine-id').val(id);
            $('#stock').val(stock);
            $('#editStockModal').modal('show');
        }

        $('#form-edit-stock').on('submit', function(e) {
            e.preventDefault();

            let id = $('#medicine-id').val();
            let stock = $('#stock').val();
            let actionUrl = '{{ url('/medicines/update-stock') }}/' + id;
            actionUrl = actionUrl.replace(':id', id);

            console.log("Sending data to: ", actionUrl);
            console.log("Stock: ", stock);

            $.ajax({
                url: actionUrl,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    stock: stock
                },
                success: function(response) {
                    console.log(response);
                    $('#editStockModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Ada masalah waktu update stok');
                }
            });
        });
    </script>
@endpush
