<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\tb_customer;
use Illuminate\Support\Facades\File;


class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_customer = tb_customer::get();
        return view('pages.Customer.show', compact('data_customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.Customer.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data harus di isi
        //aturan validasi dapat di lihat di website laravel, dengan keyword "available validation rules"
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required|numeric',
            'alamat' => 'required',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'no_telp.numeric' => 'No Telepon harus berupa angka',
            'no_telp.required' => 'No Telepon harus diisi',
            'nama.required' => 'Nama Customer harus diisi',
            'alamat.required' => 'alamat harus diisi',
            'foto_ktp.image' => 'File harus berupa gambar',
            'foto_ktp.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_ktp.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle upload gambar
        $namaGambar = null;
        if ($request->hasFile('foto_ktp')) {
            $ekstensi = $request->file('foto_ktp')->getClientOriginalExtension();
            $namaGambar = Str::random(30) . '.' . $ekstensi;
            $request->file('foto_ktp')->move(public_path('foto_ktp_customer'), $namaGambar);
        }

        //query untuk mengambil data yang di isi dari show.blade dengna menggunakan name dari kolom pada tampilan add, name="nama_produk_"
        tb_customer::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'foto_ktp' => $namaGambar,
        ]);

        //untuk menampilkan kembali ke halaman produk setalah data ditambah
        return redirect('/customer')->with('pesan', 'Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id_customer)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_customer)
    {
        $data = tb_customer::findOrFail($id_customer);
        return view('pages.customer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required|numeric',
            'alamat' => 'required',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'no_telp.numeric' => 'No Telepon harus berupa angka',
            'no_telp.required' => 'No Telepon harus diisi',
            'nama.required' => 'Nama Customer harus diisi',
            'alamat.required' => 'alamat harus diisi',
            'foto_ktp.image' => 'File harus berupa gambar',
            'foto_ktp.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'foto_ktp.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $dataUpdate = [
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ];

         // Handle upload gambar baru (jika ada)
    if ($request->hasFile('foto_ktp')) {
        // Hapus gambar lama jika ada
        $produkLama = tb_customer::findOrFail($id);
        if ($produkLama->foto_ktp && File::exists(public_path('foto_ktp_customer/' . $produkLama->foto_ktp))) {
            File::delete(public_path('foto_ktp_customer/' . $produkLama->foto_ktp));
        }

        // Simpan gambar baru dengan nama acak
        $ekstensi = $request->file('foto_ktp')->getClientOriginalExtension();
        $namaGambar = Str::random(30) . '.' . $ekstensi;
        $request->file('foto_ktp')->move(public_path('foto_ktp_customer'), $namaGambar);
        $dataUpdate['foto_ktp'] = $namaGambar;
        }

        tb_customer::where('id_customer', $id)->update($dataUpdate);
        return redirect('/customer')->with('pesan', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_customer)
    {
        $customer = tb_customer::findOrFail($id_customer);
        $customer->delete();
        return redirect('/customer')->with('pesan', 'Data berhasil dihapus');
    }
}
