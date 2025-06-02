<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('updateData', $data->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="sku" class="col-sm-5 col-form-label">SKU</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control-plaintext" id="sku" name="sku"
                                value="{{ $data->sku }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_produk" class="col-sm-5 col-form-label">Nama Product</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                value="{{ $data->nama_produk }}" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="type" class="col-sm-5 col-form-label">Type Product</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Pilih Type</option>
                                <option value="celana" {{ $data->type === 'celana' ? 'selected' : '' }}>Celana</option>
                                <option value="baju" {{ $data->type === 'baju' ? 'selected' : '' }}>Baju</option>
                                <option value="aksesoris" {{ $data->type === 'aksesoris' ? 'selected' : '' }}>Aksesoris
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="kategory" class="col-sm-5 col-form-label">Kategori Product</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="kategory" name="kategory" required>
                                <option value="">Pilih Kategori</option>
                                <option value="pria" {{ $data->kategory === 'pria' ? 'selected' : '' }}>Pria</option>
                                <option value="wanita" {{ $data->kategory === 'wanita' ? 'selected' : '' }}>Wanita
                                </option>
                                <option value="anak-anak" {{ $data->kategory === 'anak-anak' ? 'selected' : '' }}>
                                    Anak-anak</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-5 col-form-label">Harga Product</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="harga" name="harga" required
                                value="{{ $data->harga }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="quantity" class="col-sm-5 col-form-label">Qty Product</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                value="{{ $data->quantity }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-5 col-form-label">Foto Product</label>
                        <div class="col-sm-7">
                            <input type="hidden" name="foto" value="{{ $data->foto }}">
                            <img src="{{ asset('storage/product/' . $data->foto) }}" id="preview" alt=""
                                style="width: 100px;" class="mb-2">
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
