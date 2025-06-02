<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('addData') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="sku" class="col-sm-5 col-form-label">SKU</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control-plaintext" id="sku" name="sku"
                                value="{{ $sku }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_produk" class="col-sm-5 col-form-label">Nama Product</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="type" class="col-sm-5 col-form-label">Type Product</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Pilih Type</option>
                                <option value="celana">Celana</option>
                                <option value="baju">Baju</option>
                                <option value="aksesoris">Aksesoris</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="kategory" class="col-sm-5 col-form-label">Kategori Product</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="kategory" name="kategory" required>
                                <option value="">Pilih Kategori</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                                <option value="anak-anak">Anak-anak</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-5 col-form-label">Harga Product</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="quantity" class="col-sm-5 col-form-label">Qty Product</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="quantity" name="quantity">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-5 col-form-label">Foto Product</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="foto">
                            <img id="preview" alt="" style="width: 100px;" class="mb-2">
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
        const foto = document.querySelector('#foto'); // pakai ID, jadi pakai #
        const preview = document.querySelector('#preview'); // pakai ID juga

        preview.style.display = "block"; // opsional, karena preview sudah terlihat

        const oFReader = new FileReader();
        oFReader.readAsDataURL(foto.files[0]);

        oFReader.onload = function(oFREvent) {
            preview.src = oFREvent.target.result;
        }
    }
</script>
