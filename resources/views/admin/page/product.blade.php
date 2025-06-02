@extends('admin.layout.index')

@section('content')
    <div class="card mb-1" style="border: none">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
            <div class="filter d-flex flex-row gap-3 flex-grow-1 flex-md-grow-0">
                <input type="date" class="form-control" name="tgl_awal" />
                <input type="date" class="form-control" name="tgl_akhir" />
                <button class="btn btn-primary">Filter</button>
            </div>
            <input type="text" class="form-control mt-3 mt-md-0 flex-shrink-0" placeholder="Search....."
                style="min-width: 200px; max-width: 300px;" />
        </div>
    </div>

    <div class="card rounded-full" style="border: none">
        <div class="card-header bg-transparent">
            <button class="btn btn-success" id="addData">
                <i class="fa fa-plus"></i> <span>Tambah product</span>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Date In</th>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isEmpty())
                            <tr class="text-center">
                                <td colspan="9">Belum Ada Barang</td>
                            </tr>
                        @else
                            @foreach ($data as $y => $x)
                                <tr class="align-middle">
                                    <td>{{ ++$y }}</td>
                                    <td>
                                        <img src="{{ asset('storage/product/' . $x->foto) }}" style="width: 100px"
                                            alt="gambar product">
                                    </td>
                                    <td>{{ $x->created_at }}</td>
                                    <td>{{ $x->sku }}</td>
                                    <td>{{ $x->nama_produk }}</td>
                                    <td>{{ $x->type . ' ' . $x->kategory }}</td>
                                    <td>{{ $x->harga }}</td>
                                    <td>{{ $x->quantity }}</td>
                                    <td>
                                        <button class="btn btn-info editModal" data-id="{{ $x->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger deleteData" data-id="{{ $x->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="pagination d-flex flex-row justify-content-between align-items-center mt-3 gap-4">
                <div class="showData">
                    Data ditampilkan {{ $data->count() }} dari {{ $data->total() }}
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="tampilData"></div>
    <div class="tampilEditData"></div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log("Document ready");

            // Tambah data modal
            $('#addData').click(function(e) {
                e.preventDefault();
                console.log("Tombol tambah data diklik");

                $.ajax({
                    url: "{{ route('addModal') }}",
                    type: 'GET',
                    success: function(response) {
                        console.log("Response diterima:", response);
                        $('.tampilData').html(response);
                        const modalElement = document.getElementById('addModal');
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                    },
                    error: function(xhr) {
                        alert('Gagal memuat modal: ' + xhr.statusText);
                    }
                });
            });

            // Edit data modal - event delegation
            $(document).on('click', '.editModal', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('editModal', ['id' => ':id']) }}".replace(':id', id),
                    success: function(response) {
                        $('.tampilEditData').html(response).show();
                        $('#editModal').modal("show");
                    },
                    error: function(xhr) {
                        alert('Gagal memuat modal edit: ' + xhr.statusText);
                    }
                });
            });

            // Delete data dengan SweetAlert2
            $(document).on('click', '.deleteData', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('deleteData', ['id' => ':id']) }}".replace(
                                ':id', id),
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dihapus!',
                                    response.message || 'Data berhasil dihapus.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
