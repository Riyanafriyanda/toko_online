<?php

namespace App\Http\Controllers;

use App\Models\modelDetailTransaksi;
use App\Models\Transaksi;
use App\Models\tblCart;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('pelanggan.page.transaksi', [
            'title' => 'Transaksi',
            'cart' => $cart,
        ]);
    }



    public function create(Request $request)
    {
        $idProduct = $request->input('idProduct');
        $product = Product::find($idProduct);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan.'
            ]);
        }

        $cart = Session::get('cart', []);

        $foundKey = null;
        foreach ($cart as $key => $item) {
            if ($item['id_barang'] == $idProduct) {
                $foundKey = $key;
                break;
            }
        }

        if ($foundKey !== null) {
            $cart[$foundKey]['qty'] += 1;
        } else {
            $cart[] = [
                'idUser' => 'gust123',
                'id_barang' => $idProduct,
                'qty' => 1,
                'price' => $product->harga,
            ];
        }

        Session::put('cart', $cart);

        // Hitung total qty (jumlah semua qty, bukan count item unik)
        $totalQty = collect($cart)->sum('qty');

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'totalQty' => $totalQty,
        ]);
    }



    public function remove($id)
    {
        $cart = session()->get('cart', []);

        // Filter item yang tidak sesuai id
        $cart = array_filter($cart, function ($item) use ($id) {
            return $item['id_barang'] != $id;
        });

        session()->put('cart', array_values($cart)); // reset index

        // Hitung ulang total qty
        $totalQty = collect($cart)->sum('qty');

        return response()->json([
            'success' => true,
            'message' => 'Items terhapus',
            'totalQty' => $totalQty,
        ]);
    }

    public function prosesCheckout(Request $request)
    {
        $data = $request->all();

        $idBarangArray = $data['id_barang'] ?? [];
        $qtyArray = $data['qty'] ?? [];
        $totalHarga = $data['total'] ?? 0; // total harga
        $namaCustomer = $data['nama_penerima'] ?? null;
        $alamat = $data['alamat_penerima'] ?? null;
        $tlp = $data['tlp'] ?? null;
        $expedisi = $data['expedisi'] ?? null;

        // Hitung total qty
        $totalQty = array_sum($qtyArray);

        // Generate kode transaksi
        $count = \App\Models\Transaksi::count();
        $codeTransaksi = random_int(0, 999) . date('Ymd') . $count;

        // Simpan data transaksi utama
        $transaksi = new \App\Models\Transaksi();
        $transaksi->code_transaksi = $codeTransaksi;
        $transaksi->nama_customer = $namaCustomer;
        $transaksi->alamat = $alamat;
        $transaksi->no_tlp = $tlp;
        $transaksi->expedisi = $expedisi;
        $transaksi->total_qty = $totalQty;
        $transaksi->total_harga = $totalHarga;
        $transaksi->save();

        // Simpan detail transaksi per item
        foreach ($idBarangArray as $index => $idBarang) {
            $qty = $qtyArray[$index] ?? 0;

            \App\Models\modelDetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_barang' => $idBarang,
                'qty' => $qty,
                'price' => $data['price_per_item'][$index] ?? 0, // sesuaikan nama field input
            ]);
        }

        Alert::toast('CheckOut Berhasil', 'success');
        return redirect()->route('checkOut');
    }



    public function store(Request $request)
    {
        // Proses simpan transaksi ke database
    }

    public function show(Transaksi $transaksi)
    {
        //
    }

    public function edit(Transaksi $transaksi)
    {
        //
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
