<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {

        $best = product::where('quantity_out', '>=', 5)->paginate(5);
        $data = product::paginate(5);
        return view('pelanggan.page.home', [
            'title' => 'Home',
            'data' => $data,
            'best' => $best,
        ]);
    }

    public function shop()
    {
        $data = product::paginate(4);
        return view('pelanggan.page.shop', [
            'title' => 'Shop',
            'data' => $data,
        ]);
    }
    public function newProduct()
    {
        return view('pelanggan.page.newProduct', ['title' => 'Shop']);
    }

    // public function transaksi()
    // {
    //     return view('pelanggan.page.transaksi', ['title' => 'Transaksi']);
    // }

    public function contact()
    {
        return view('pelanggan.page.contact', ['title' => 'Contact Us']);
    }

    public function checkOut()
    {
        $cart = session('cart', []); // asumsi data cart disimpan di session

        $total = collect($cart)->sum(function ($item) {
            $product = \App\Models\Product::find($item['id_barang']);
            return $product ? $product->harga * $item['qty'] : 0;
        });

        return view('pelanggan.page.checkOut', [
            'title' => 'Check Out',
            'total' => $total
        ]);
    }


    public function dashboard()
    {
        return view('admin.page.dashboard', [
            'name' => 'Dashboard',
            'title' => 'Admin Dashboard',
        ]);
    }
    public function userManagement()
    {
        return view('admin.page.user', [
            'name' => 'UserManagement',
            'title' => 'Admin User Management',
        ]);
    }
    public function report()
    {
        return view('admin.page.report', [
            'name' => 'Report',
            'title' => 'Admin Report',
        ]);
    }
    public function login()
    {
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return redirect()->route('dashboard');
        }

        return view('admin.page.login', [
            'name' => 'Login',
            'title' => 'Admin Login',
        ]);
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Session::flash('error', $request->email);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Session::flash('error', 'Email tidak ditemukan.');
            return back();
        }

        // Cek apakah user bukan admin
        if ($user->is_admin == 0) {
            Session::flash('error', 'Kamu bukan admin.');
            return back();
        }

        // Lakukan proses login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Alert::toast('Kamu berhasil login', 'success');
            return redirect()->intended('/admin/dashboard');
        } else {
            Session::flash('error', 'Password kamu salah.');
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::toast('kamu LogOut', 'success');
        return redirect('admin');
    }
}
