@extends('pelanggan.layout.index')

@section('content')
    <div class="flex flex-col md:flex-row gap-6 mt-6">
        {{-- Sidebar Kategori --}}
        <aside class="w-full md:w-1/4">
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">Kategori</h2>

                <div id="accordion-flush" data-accordion="collapse"
                    data-active-classes="bg-red-100 dark:bg-gray-800 text-red-600 dark:text-red-400"
                    data-inactive-classes="text-gray-500 dark:text-gray-400">

                    {{-- Pria --}}
                    <h3 id="accordion-flush-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full p-3 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-lg hover:bg-gray-100 dark:hover:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-1" aria-expanded="false"
                            aria-controls="accordion-flush-body-1">
                            Pria
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                        <div class="py-2 px-5 flex flex-col gap-3">
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Baju Pria
                            </a>
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Celana Pria
                            </a>
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Aksesoris Pria
                            </a>
                        </div>
                    </div>

                    {{-- Wanita --}}
                    <h3 id="accordion-flush-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-3 font-medium text-left text-gray-500 border border-b-0 border-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                            aria-controls="accordion-flush-body-2">
                            Wanita
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                        <div class="py-2 px-5 flex flex-col gap-3">
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Baju Wanita
                            </a>
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Celana Wanita
                            </a>
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Aksesoris Wanita
                            </a>
                        </div>
                    </div>

                    {{-- Anak-anak --}}
                    <h3 id="accordion-flush-heading-3">
                        <button type="button"
                            class="flex items-center justify-between w-full p-3 font-medium text-left text-gray-500 border border-gray-200 rounded-b-lg hover:bg-gray-100 dark:hover:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
                            aria-controls="accordion-flush-body-3">
                            Anak-anak
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                    </h3>
                    <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                        <div class="py-2 px-5 flex flex-col gap-3">
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Baju Anak-anak
                            </a>
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Celana Anak-anak
                            </a>
                            <a href="#" class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600">
                                <i class="fas fa-plus"></i> Aksesoris Anak-anak
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Produk List --}}
        <main class="w-full md:w-3/4 flex flex-wrap gap-6 justify-start">
            <div class="content mt-3 d-flex flex-wrap gap-5 mb-5 justify-content-center">
                @if ($data->isEmpty())
                    <h1>Belum Ada Data ........!</h1>
                @else
                    @foreach ($data as $product)
                        <div class="max-w-[250px] rounded overflow-hidden shadow-lg flex flex-column">
                            <div class="overflow-hidden rounded-top" style="width: 250px; height: 250px;">
                                <img src="{{ asset('storage/product/' . $product->foto) }}" class="w-100 h-100 object-cover"
                                    style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                            <div class="px-3 py-4 flex-grow-1">
                                <p class="fw-bold fs-5 mb-2">{{ $product->nama }}</p>
                                <p class="text-yellow-400 text-sm"><i class="fa-regular fa-star"></i> 5+</p>
                            </div>
                            <div class="px-3 py-3 d-flex align-items-center justify-content-between border-top">
                                <p class="fs-5 fw-semibold mb-0">IDR {{ number_format($product->harga, 0, ',', '.') }}</p>
                                <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1">
                                    <i class="fa-solid fa-cart-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </main>
    </div>

    {{-- Pagination --}}
    <div class="pagination d-flex flex-row justify-end align-items-center mt-3 gap-4">
        <div class="showData">
            Data ditampilkan {{ $data->count() }} dari {{ $data->total() }}
        </div>
        <div>
            {{ $data->links() }}
        </div>
    </div>
@endsection
