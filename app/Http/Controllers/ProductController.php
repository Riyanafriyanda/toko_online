<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = product::paginate(3);
        return view('admin.page.product', [
            'name' => 'Product',
            'title' => 'Admin Product',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function addModal()
    {
        return view('admin.modal.addModal', [
            'title' => 'Tambahkan Data Product',
            'sku' => 'BRG' . rand(10000, 99999),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Product();
        $data->sku = $request->sku;
        $data->nama_produk = $request->nama_produk;
        $data->slug = Str::slug($request->sku . '-' . now()->timestamp);
        $data->type = $request->type;
        $data->kategory = $request->kategory;
        $data->harga = $request->harga;
        $data->quantity = $request->quantity;
        $data->discount = 10 / 100;

        if ($request->hasFile('foto')) {
            $photo = $request->file('foto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/product'), $filename);
            $data->foto = $filename;
        }

        $data->save();
        Alert::toast('Data berhasil disimpan', 'success');
        return redirect()->route('product');
    }



    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $data = product::findOrFail($id);

        return view('admin.modal.editModal', [
            'title' => 'Edit Data Modal',
            'data' => $data,
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $data = Product::findOrFail($id);

        if ($request->file('foto')) {
            $photo = $request->file('foto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/product'), $filename);
            $data->foto = $filename;
        } else {
            $filename = $request->foto;
        }

        $field = [
            'sku' => $request->sku,
            'nama_produk' => $request->nama_produk,
            'slug' => $this->generateUniqueSlug($request->nama_produk, $id),
            'type' => $request->type,
            'kategory' => $request->kategory,
            'harga' => $request->harga,
            'quantity' => $request->quantity,
            'discount' => 10 / 100,
            'foto' => $filename,
        ];

        Product::where('id', $id)->update($field);
        Alert::toast('Data berhasil diupdate', 'success');
        return redirect()->route('product');
    }



    public function destroy(Request $request, $id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Data berhasil dihapus.'], 200);
        }

        // fallback kalau bukan AJAX
        return redirect()->route('product')->with('success', 'Data berhasil dihapus.');
    }

    private function generateUniqueSlug($name, $id = null)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)
            ->when($id, fn($query) => $query->where('id', '!=', $id))
            ->exists()
        ) {
            $slug = $original . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
