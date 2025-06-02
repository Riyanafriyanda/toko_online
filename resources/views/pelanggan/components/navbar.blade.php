<nav class="bg-white dark:bg-gray-800 antialiased nav-header">
    <div class="max-w-screen-3xl p-5 mx-auto 2xl:px-0 py-4">
        <div class="flex items-center justify-between">

            <div class="flex items-center space-x-8">
                <div class="toko">
                    <h4>
                        Toko <span>Online</span>
                    </h4>
                </div>
                <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                    <li>
                        <a href="/" title=""
                            class="flex text-xl font-medium {{ Request::is('/') ? 'text-blue-600 underline' : 'text-gray-800' }}">
                            Home
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="/shop" title=""
                            class="flex text-xl font-medium {{ Request::is('shop') ? 'text-blue-600 underline' : 'text-gray-800' }}">
                            Shop
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="/contact" title=""
                            class="flex text-xl font-medium {{ Request::is('contact') ? 'text-blue-600 underline' : 'text-gray-800' }}">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <div class="flex items-center lg:space-x-2">
                @php
                    $cart = session('cart', []);
                    $totalQty = collect($cart)->sum('qty');
                @endphp

                <div class="relative">
                    <a href="{{ url('/transaksi') }}"
                        class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-xl font-medium leading-none text-gray-900 dark:text-white relative">
                        <svg class="w-7 h-7 lg:me-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                        </svg>
                        @if ($totalQty > 0)
                            <span id="cart-count"
                                class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2 {{ $totalQty > 0 ? '' : 'hidden' }}">
                                {{ $totalQty }}
                            </span>
                        @endif
                    </a>
                </div>

                <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button"
                    class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-xl font-medium leading-none text-gray-900 dark:text-white">
                    <svg class="w-7 h-7 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Account
                    <svg class="w-6 h-6 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div id="userDropdown1"
                    class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
                    <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                        <a href="#" title=""
                            class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">Sign
                            In</a>
                    </div>
                    <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                        <a href="#" title=""
                            class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">Sign
                            Out</a>
                    </div>
                </div>

                <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1"
                    aria-controls="ecommerce-navbar-menu-1" aria-expanded="false"
                    class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white">
                    <span class="sr-only">Open Menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="ecommerce-navbar-menu-1"
            class="bg-gray-50 dark:bg-gray-700 mt-4 hidden rounded-lg border border-gray-100 p-4 shadow-md dark:border-gray-600 lg:hidden">
            <ul class="space-y-2">
                <li>
                    <a href="/" title=""
                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-primary-100 dark:text-white dark:hover:bg-primary-600">Home</a>
                </li>
                <li>
                    <a href="/shop" title=""
                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-primary-100 dark:text-white dark:hover:bg-primary-600">Best
                        Sellers</a>
                </li>
                <li>
                    <a href="/shop" title=""
                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-primary-100 dark:text-white dark:hover:bg-primary-600">New
                        Product</a>
                </li>
                <li>
                    <a href="/contact" title=""
                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-primary-100 dark:text-white dark:hover:bg-primary-600">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
