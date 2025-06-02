@extends('pelanggan.layout.index')

@section('content')
    <form action="{{ route('prosesCheckout') }}" method="POST">
        @csrf
        <div class="row mt-3">
            <!-- Alamat Penerima -->
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body">
                        <h3>Masukan Alamat Penerima</h3>
                        <div class="row mb-3">
                            <label for="nama_penerima" class="col-form-label col-sm-3">Nama penerima</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukan nama penerima"
                                    id="nama_penerima" name="nama_penerima" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat_penerima" class="col-form-label col-sm-3">Alamat penerima</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukan alamat penerima"
                                    id="alamat_penerima" name="alamat_penerima" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tlp" class="col-form-label col-sm-3">No.tlp penerima</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Masukan nomor telepon"
                                    id="tlp" name="tlp" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="expedisi" class="col-form-label col-sm-3">Expedisi</label>
                            <div class="col-sm-9">
                                <select name="expedisi" class="form-control" id="expedisi" required>
                                    <option value="">---Pilih Expedisi---</option>
                                    <option value="jnt">J&T Ekspress</option>
                                    <option value="jne">JNE Ekspress</option>
                                    <option value="sicepat">Sicepat Ekspress</option>
                                    <option value="ninja">Ninja Ekspress</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header text-center p-4">
                        <h3>Total belanja</h3>
                    </div>
                    <div class="card-body">
                        {{-- Hidden Inputs --}}
                        <input type="hidden" name="totalBelanja" value="{{ $total }}">
                        <input type="hidden" name="discount" value="{{ $discount ?? 0 }}">
                        <input type="hidden" name="ppn" value="{{ $ppn ?? 0 }}">
                        <input type="hidden" name="ongkir" value="{{ $ongkir ?? 0 }}">

                        <div class="row mb-3">
                            <label for="dibayarkan" class="col-form-label col-sm-4">Total</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="dibayarkan" name="total"
                                    value="{{ ($total ?? 0) + ($ppn ?? 0) + ($ongkir ?? 0) - ($discount ?? 0) }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="diterima" class="col-form-label col-sm-4">Uang diterima</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="diterima" name="diterima" required
                                    min="0">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="dikembalikan" class="col-form-label col-sm-4">Uang kembalian</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="dikembalikan" name="kembalian" readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-print"></i> Proses & Cetak Struk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Script untuk hitung kembalian --}}
    <script>
        document.getElementById('diterima').addEventListener('input', function() {
            const total = parseInt(document.getElementById('dibayarkan').value) || 0;
            const diterima = parseInt(this.value) || 0;
            const kembali = diterima - total;

            document.getElementById('dikembalikan').value = kembali >= 0 ? kembali : 0;
        });
    </script>
@endsection
