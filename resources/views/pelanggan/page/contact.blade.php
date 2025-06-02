@extends('pelanggan.layout.index')

@section('content')
    <div class="mt-4">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-3xl p-5 lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    We didn't reinvent the wheel
                </h2>
                <p class="mb-4">
                    We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick,
                    but big enough to deliver the scope you want at the pace you need.
                </p>
                <p>
                    We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png" alt="office content 1" />
                <img class="w-full rounded-lg mt-4 lg:mt-10" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-1.png" alt="office content 2" />
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center mt-12">
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Tertarik untuk Bergabung?</h3>
        <p class="text-gray-600 dark:text-gray-300 mb-6">Daftarkan diri Anda sekarang sebagai pelanggan atau seller, dan mulai berjualan atau belanja dengan mudah.</p>
        <a href="#"
            class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
            Daftar Sekarang
        </a>
    </div>

    <!-- Statistik -->
    <div class="flex justify-center gap-10 mt-10">
        <div class="flex flex-col items-center gap-1 text-center">
            <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M...Z" clip-rule="evenodd" /></svg>
            <p class="text-lg font-semibold">+ 300 Pelanggan</p>
        </div>
        <div class="flex flex-col items-center gap-1 text-center">
            <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path d="M...Z" /></svg>
            <p class="text-lg font-semibold">+ 300 Seller</p>
        </div>
        <div class="flex flex-col items-center gap-1 text-center">
            <svg class="w-10 h-10 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M...Z" /></svg>
            <p class="text-lg font-semibold">+ 300 Produk</p>
        </div>
    </div>

    <!-- Testimoni -->
    <div class="my-16">
        <h4 class="text-center text-2xl font-semibold mb-6">Apa Kata Mereka?</h4>
        <div class="grid md:grid-cols-3 gap-6 px-4">
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600 italic">"Pelayanan cepat, produk lengkap, dan mudah digunakan!"</p>
                <p class="mt-4 font-semibold text-blue-600">– Rina, Pelanggan</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600 italic">"Sebagai seller, saya sangat terbantu dengan sistem marketplace ini."</p>
                <p class="mt-4 font-semibold text-blue-600">– Budi, Seller</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-600 italic">"Sangat user-friendly dan supportnya responsif."</p>
                <p class="mt-4 font-semibold text-blue-600">– Sarah, Pelanggan</p>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="mt-16">
        <h4 class="text-center text-2xl font-semibold mb-6">Pertanyaan Umum</h4>
        <div class="grid md:grid-cols-3 gap-6 px-4">
            <div class="bg-white p-4 rounded shadow">
                <h5 class="font-semibold">Bagaimana cara mendaftar sebagai seller?</h5>
                <p class="text-gray-600 mt-2">Anda dapat mendaftar melalui halaman <a href="/register" class="text-blue-600 underline">Daftar</a> dan memilih opsi sebagai seller.</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h5 class="font-semibold">Apakah ada biaya berlangganan?</h5>
                <p class="text-gray-600 mt-2">Tidak. Marketplace kami gratis untuk digunakan oleh pelanggan dan seller.</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h5 class="font-semibold">Bagimana Aplikasinya apakah Membantu Anda?</h5>
                <p class="text-gray-600 mt-2">Tidak. Marketplace kami gratis untuk digunakan oleh pelanggan dan seller.</p>
            </div>
        </div>
    </div>

    <!-- Contact Us -->
    <h4 class="text-center mt-16 mb-4 text-2xl font-semibold">Contact Us</h4>
    <hr class="mb-10 border-gray-300">

    <div class="lg:flex lg:gap-10 mb-16">
        <div class="lg:w-1/3 bg-gray-300 rounded-lg flex items-center justify-center text-gray-600">[Map atau Info Kontak]</div>

        <div class="lg:w-2/3 mt-8 lg:mt-0">
            <div class="bg-white shadow rounded-lg">
                <div class="p-6 border-b text-center">
                    <h4 class="text-xl font-bold">Kritik dan Saran</h4>
                </div>
                <div class="p-6">
                    <p class="mb-8 text-center text-gray-600">
                        Masukkan kritik dan saran anda kepada aplikasi kami agar kami dapat memberikan layanan yang lebih baik lagi.
                    </p>
                    <form>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" placeholder="Masukkan email anda"
                                class="block w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" />
                        </div>
                        <div class="mb-6">
                            <label for="pesan" class="block mb-2 text-sm font-medium text-gray-700">Pesan</label>
                            <textarea id="pesan" placeholder="Masukkan Pesan anda" rows="4"
                                class="block w-full rounded-md border border-gray-300 p-3 text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md transition duration-300">
                            Kirim Pesan Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
