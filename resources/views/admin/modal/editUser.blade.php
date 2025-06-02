<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('updateDataUser', $data->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <!-- Nik readonly -->
                    <div class="mb-3 row">
                        <label for="nik" class="col-sm-5 col-form-label">Nik</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control-plaintext" id="nik" name="nik"
                                value="{{ $data->nik }}" readonly>
                        </div>
                    </div>


                    <!-- Name -->
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-5 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $data->name }}" required>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-5 col-form-label">Email Karyawan</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $data->email }}" required>
                        </div>
                    </div>
                    <!-- Password Baru -->
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-5 col-form-label">Password Baru</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Biarkan kosong jika tidak ingin mengubah">
                        </div>
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-sm-5 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Ulangi password baru">
                        </div>
                    </div>


                    <!-- Alamat -->
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-5 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $data->alamat }}" required>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="mb-3 row">
                        <label for="tlp" class="col-sm-5 col-form-label">TelPhone karyawan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="tlp" name="tlp"
                                value="{{ $data->tlp }}" required>
                        </div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-3 row">
                        <label for="tglLahir" class="col-sm-5 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control" id="tglLahir" name="tglLahir"
                                value="{{ $data->tglLahir }}" required>
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="mb-3 row">
                        <label for="role" class="col-sm-5 col-form-label">Jabatan</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="1" {{ $data->role == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $data->role == 2 ? 'selected' : '' }}>Manager</option>
                            </select>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="mb-3 row">
                        <label for="is_active" class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="is_active" name="is_active" required>
                                <option value="">Pilih Status</option>
                                <option value="1" {{ $data->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $data->is_active == 0 ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-5 col-form-label">Foto Karyawan</label>
                        <div class="col-sm-7">
                            <img id="preview" alt="" style="width: 100px;" class="mb-2"
                                src="{{ asset('storage/user/' . $data->foto) }}">
                            <input type="file" class="form-control" id="foto" name="foto"
                                accept=".jpg,.jpeg,.png" onchange="previewImg()">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const preview = document.querySelector('#preview');

        if (foto.files && foto.files[0]) {
            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onload = function(oFREvent) {
                preview.src = oFREvent.target.result;
            }
        }
    }
</script>
