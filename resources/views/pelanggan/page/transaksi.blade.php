@extends('pelanggan.layout.index')

@section('content')

    <h4 class="mt-4 mb-3">Keranjang Belanja</h4>

    @if (count($cart) > 0)
        @foreach ($cart as $item)
            @php
                // Cari data produk lengkap dari id_barang
                $product = \App\Models\Product::find($item['id_barang']);
            @endphp
            @if ($product)
                <div class="keranjang-item position-relative d-flex align-items-start" data-id="{{ $product->id }}">
                    <input type="checkbox" class="form-check-input mt-2 me-3 item-check">
                    <img src="{{ asset('storage/product/' . $product->foto) }}" alt="{{ $product->nama_product }}"
                        style="width: 80px; height: 80px; object-fit: cover;" class="me-3">
                    <div class="flex-grow-1">
                        <p class="product-name mb-1">{{ $product->nama_product }}</p>
                        <p class="product-price mb-2">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-outline-secondary btn-sm minus-btn">-</button>
                            <input type="number" class="form-control text-center qty-input" value="{{ $item['qty'] }}"
                                min="1" max="9999" style="width: 60px;" data-harga="{{ $product->harga }}">
                            <button class="btn btn-outline-secondary btn-sm plus-btn">+</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center ms-3">
                        <button class="btn btn-danger btn-sm remove-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Bar bawah -->
        <div class="checkout-bar mt-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <input type="checkbox" class="form-check-input" id="check-all" />
                <span>Pilih Semua</span>
            </div>
            <div class="text-end">
                @php
                    $total = collect($cart)->sum(function ($item) {
                        $product = \App\Models\Product::find($item['id_barang']);
                        return $product ? $product->harga * $item['qty'] : 0;
                    });
                @endphp
                <div>Total: <span id="total" class="product-price">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <form action="{{ route('checkOut') }}" method="POST" id="checkoutForm">
                    @csrf
                    <input type="hidden" name="selected_items" id="selected_items">
                    <button type="submit" class="btn btn-danger mt-2 px-4">Checkout</button>
                </form>

            </div>
        </div>
    @else
        <p>Keranjang kosong.</p>
    @endif
    <script>
        document.querySelector('#checkoutForm').addEventListener('submit', function(e) {
            const checkedItems = [];

            document.querySelectorAll('.keranjang-item').forEach(function(item) {
                const checkbox = item.querySelector('.item-check');
                if (checkbox && checkbox.checked) {
                    checkedItems.push(item.getAttribute('data-id'));
                }
            });

            if (checkedItems.length === 0) {
                e.preventDefault();
                alert('Pilih minimal 1 produk untuk checkout.');
                return;
            }

            document.getElementById('selected_items').value = JSON.stringify(checkedItems);
        });
    </script>


@endsection
