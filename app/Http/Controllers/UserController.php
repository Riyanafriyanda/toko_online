<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $data = User::paginate(3);
        return view('admin.page.user', [
            'name' => 'UserManagement',
            'title' => 'Admin User Management',
            'data' => $data,
        ]);
    }

    public function addModalUser()
    {
        return view('admin.modal.modalUser', [
            'title' => 'Tambahkan Data User',
            'nik' => date('Ymd') . rand(000, 999),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input, pastikan nik juga divalidasi dan unique
        $validated = $request->validate([
            'nik' => 'required|string|unique:users,nik',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string',
            'tlp' => 'required|string',
            'role' => 'required|in:1,2',
            'tglLahir' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = new User();
        $data->nik = $request->nik;
        $data->name = $request->nama;
        $data->slug = Str::slug($request->nik . '-' . now()->timestamp);
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->alamat = $request->alamat;
        $data->tlp = $request->tlp;
        $data->role = $request->role;
        $data->tglLahir = $request->tglLahir;
        $data->is_active = 1;
        $data->is_member = 0;
        $data->is_admin = 1;

        if ($request->hasFile('foto')) {
            $photo = $request->file('foto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/user'), $filename);
            $data->foto = $filename;
        }

        $data->save();

        Alert::toast('Data berhasil disimpan', 'success');
        return redirect()->route('userManagement');  // Pastikan route userManagement juga benar
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('admin.modal.editUser', [
            'title' => 'Edit Data Modal',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required',
            'email' => 'required|email',
            'tglLahir' => 'required|date',
            'alamat' => 'required',
            'tlp' => 'required',
            'role' => 'required|in:1,2',
            'is_active' => 'required|in:1,0',
            'password' => 'nullable|string|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = User::findOrFail($id);
        $filename = $data->foto; // tetap pakai foto lama jika tidak diubah

        if ($request->hasFile('foto')) {
            $photo = $request->file('foto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/user'), $filename);
        }

        // Update field biasa
        $data->nik = $request->nik;
        $data->name = $request->name;
        $data->slug = Str::slug($request->nik . '-' . now()->timestamp);
        $data->email = $request->email;
        $data->tglLahir = $request->tglLahir;
        $data->alamat = $request->alamat;
        $data->tlp = $request->tlp;
        $data->role = (int) $request->role;
        $data->is_active = $request->is_active;
        $data->foto = $filename;

        // Jika ada password baru, update juga
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }

        $data->save();

        Alert::toast('Data berhasil diupdate', 'success');
        return redirect()->route('userManagement');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
