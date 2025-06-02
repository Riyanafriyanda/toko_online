@extends('admin.layout.index')

@section('content')
    <div class="container">
        <div class="row g-3 justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="material-icons fs-1 text-secondary" aria-label="Inventory icon">inventory</span>
                        <span class="fs-1 m-0 p-0">100</span>
                    </div>
                    <div class="card-footer bg-transparent">
                        <h5>Total Inventory</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="card text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="material-icons fs-1 text-secondary" aria-label="Shopping cart icon">shopping_cart</span>
                        <span class="fs-1 m-0 p-0">100</span>
                    </div>
                    <div class="card-footer bg-transparent">
                        <h5>Total Transaksi</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="card text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="material-icons fs-1 text-secondary" aria-label="People icon">people</span>
                        <span class="fs-1 m-0 p-0">100</span>
                    </div>
                    <div class="card-footer bg-transparent">
                        <h5>Total Karyawan</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="card text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center gap-2">
                        <span class="material-icons fs-1 text-secondary" aria-label="Wallet icon">account_balance_wallet</span>
                        <span class="fs-1 m-0 p-0">100</span>
                    </div>
                    <div class="card-footer bg-transparent">
                        <h5>Total Profit</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
