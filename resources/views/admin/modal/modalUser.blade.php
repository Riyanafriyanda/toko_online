<div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('addUser') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nik" class="col-sm-5 col-form-label">NIK</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control-plaintext" id="nik" name="nik"
                                value="{{ $nik }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-5 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="name" name="nama" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-5 col-form-label">Email Karyawan</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-sm-5 col-form-label">Password Karyawan</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-5 col-form-label">Alamat Karyawan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tlp" class="col-sm-5 col-form-label">TelPhone karyawan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="tlp" name="tlp" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tglLahir" class="col-sm-5 col-form-label">Tgl Lahir</label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control" id="tglLahir" name="tglLahir">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="role" class="col-sm-5 col-form-label">Jabatan</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Manager</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-5 col-form-label">Foto Karyawan</label>
                        <div class="col-sm-7">
                            <img id="preview" alt="" style="width: 100px; display:none;" class="mb-2">
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

        preview.style.display = "block"; 

        const oFReader = new FileReader();
        oFReader.readAsDataURL(foto.files[0]);

        oFReader.onload = function(oFREvent) {
            preview.src = oFREvent.target.result;
        }
    }
</script>
