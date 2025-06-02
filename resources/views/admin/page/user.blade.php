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
                <i class="fa fa-plus"></i> <span>Tambah Karyawan</span>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIK</th>
                            <th>Join Date</th>
                            <th>Nama Karyawan</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $x)
                            <tr class="align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/user/' . $x->foto) }}" style="width: 80px;" alt="Foto User">
                                </td>
                                <td>{{ $x->nik }}</td>
                                <td>{{ $x->created_at->format('Y-m-d') }}</td>
                                <td>{{ $x->name }}</td>
                                <td>
                                    <span class="badge text-bg-{{ $x->role === 1 ? 'primary' : 'success' }}">
                                        {{ $x->role === 1 ? 'Admin' : 'Manager' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge text-bg-{{ $x->is_active === 1 ? 'info' : 'danger' }}">
                                        {{ $x->is_active === 1 ? 'Active' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm editUser" data-id="{{ $x->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm deleteUser" data-id="{{ $x->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination d-flex flex-row justify-content-between align-items-center mt-2">
                <div class="showData">
                    Data ditampilkan {{ $data->count() }} dari {{ $data->total() }}
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal container untuk Tambah dan Edit --}}
    <div class="tampilData"></div>
    <div class="tampilEditDataUser"></div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Tombol tambah data
                $('#addData').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('modalUser') }}",
                        type: 'GET',
                        success: function(response) {
                            $('.tampilData').html(response);

                            const modalEl = document.getElementById('modalUser');
                            const modal = new bootstrap.Modal(modalEl);
                            modal.show();
                        },
                        error: function(xhr) {
                            alert('Gagal memuat modal: ' + xhr.statusText);
                        }
                    });
                });

                // Tombol edit data user (event delegation)
                $(document).on('click', '.editUser', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');

                    $.ajax({
                        url: "{{ route('editUser', ['id' => ':id']) }}".replace(':id', id),
                        type: 'GET',
                        success: function(response) {
                            $('.tampilEditDataUser').html(response);

                            const modalEl = document.getElementById('editUser');
                            const modal = new bootstrap.Modal(modalEl);
                            modal.show();
                        },
                        error: function(xhr) {
                            alert('Gagal memuat modal edit: ' + xhr.statusText);
                        }
                    });
                });

                // Tombol hapus data user
                $(document).on('click', '.deleteUser', function(e) {
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
                                url: "{{ route('deleteDataUser', ['id' => ':id']) }}".replace(
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
@endsection
