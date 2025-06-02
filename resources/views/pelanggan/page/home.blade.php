@extends('pelanggan.layout.index')

@section('content')
    @include('pelanggan.components.herosesion')

    <h4 class="mt-5 mb-4 fw-bold fs-5 dark:text-white border-bottom pb-2" style="letter-spacing: 1px;">
        Kategori Produk
    </h4>
    <div class="d-flex flex-wrap justify-content-center gap-4 mb-5 dark:text-white">
        @php
            $categories = [
                ['nama' => 'Aksesoris', 'ikon' => 'watch'],
                ['nama' => 'Pakaian Pria', 'ikon' => 'checkroom'],
                ['nama' => 'Pakaian Wanita', 'ikon' => 'styler'],
                ['nama' => 'Fashion Bayi & Anak', 'ikon' => 'child_care'],
            ];
        @endphp

        @foreach ($categories as $kategori)
            <div class="kategori-item text-center shadow-sm p-3 rounded bg-light"
                style="transition: all 0.3s; flex: 1 1 120px; cursor: pointer;">
                <span class="material-symbols-outlined mb-2" style="font-size: 40px; color: #dc3545;">
                    {{ $kategori['ikon'] }}
                </span>
                <p class="mb-0 fw-semibold">{{ $kategori['nama'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Best Seller --}}
    <div class="new-product-section mb-5">
        <h4 class="mt-5 mb-4 fw-bold fs-5 dark:text-white border-bottom pb-2" style="letter-spacing: 1px;">
            Best Seller
        </h4>

        <div class="content mt-3 d-flex flex-wrap gap-5 justify-content-center">
            @if ($data->isEmpty())
                <h1>Belum Ada Best Seller .....!</h1>
            @else
                @foreach ($best as $product)
                    <div class="max-w-[250px] rounded overflow-hidden shadow-lg d-flex flex-column">
                        {{-- Gambar Produk --}}
                        <div class="overflow-hidden rounded-top" style="width: 250px; height: 250px;">
                            <img src="{{ asset('storage/product/' . $product->foto) }}" class="w-100 h-100 object-cover"
                                style="object-fit: cover; width: 100%; height: 100%;">
                        </div>

                        {{-- Detail Produk --}}
                        <div class="px-3 py-4 flex-grow-1">
                            <p class="fw-bold fs-5 mb-2">{{ $product->nama }}</p>
                            <p class="text-yellow-400 text-sm">
                                <i class="fa-regular fa-star"></i> 5+
                            </p>
                        </div>

                        {{-- Harga dan Tombol --}}
                        <div class="px-3 py-3 d-flex align-items-center justify-content-between border-top">
                            <p class="fs-5 fw-semibold mb-0">
                                IDR {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                            <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 add-to-cart-btn"
                                data-id="{{ $product->id }}">
                                <i class="fa-solid fa-cart-plus"></i> Add
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Pagination --}}
        <div class="pagination d-flex flex-row justify-end align-items-center mt-4 gap-4">
            <div class="showData">
                Data ditampilkan {{ $best->count() }} dari {{ $best->total() }}
            </div>
            <div>
                {{ $best->links() }}
            </div>
        </div>
    </div>

    {{-- New Product Section --}}
    <div class="new-product-section mb-5">

        <h4 class="mt-5 mb-4 fw-bold fs-5 dark:text-white border-bottom pb-2" style="letter-spacing: 1px;">
            New Product
        </h4>

        <div class="content mt-3 d-flex flex-wrap gap-5 justify-content-center">
            @if ($data->isEmpty())
                <h1>Belum Ada Product .....!</h1>
            @else
                @foreach ($data as $product)
                    <div class="max-w-[250px] rounded overflow-hidden shadow-lg d-flex flex-column">
                        {{-- Gambar Produk --}}
                        <div class="overflow-hidden rounded-top" style="width: 250px; height: 250px;">
                            <img src="{{ asset('storage/product/' . $product->foto) }}" class="w-100 h-100 object-cover"
                                style="object-fit: cover; width: 100%; height: 100%;">
                        </div>

                        {{-- Detail Produk --}}
                        <div class="px-3 py-4 flex-grow-1">
                            <p class="fw-bold fs-5 mb-2">{{ $product->nama }}</p>
                            <p class="text-yellow-400 text-sm">
                                <i class="fa-regular fa-star"></i> 5+
                            </p>
                        </div>

                        {{-- Harga dan Tombol --}}
                        <div class="px-3 py-3 d-flex align-items-center justify-content-between border-top">
                            <p class="fs-5 fw-semibold mb-0">
                                IDR {{ number_format($product->harga, 0, ',', '.') }}
                            </p>

                            <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 add-to-cart-btn"
                                data-id="{{ $product->id }}">
                                <i class="fa-solid fa-cart-plus"></i> Add
                            </button>
                        </div>

                    </div>
                @endforeach
            @endif
        </div>

        {{-- Pagination --}}
        <div class="pagination d-flex flex-row justify-end align-items-center mt-4 gap-4">
            <div class="showData">
                Data ditampilkan {{ $data->count() }} dari {{ $data->total() }}
            </div>
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-id');

                fetch("{{ route('addTocart') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            idProduct: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update jumlah keranjang di navbar
                            const cartCount = document.querySelector('#cart-count');
                            if (cartCount) {
                                cartCount.textContent = data.totalQty;
                                cartCount.classList.remove('hidden');
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan!'
                        });
                    });
            });
        });
    </script>


@endsection
