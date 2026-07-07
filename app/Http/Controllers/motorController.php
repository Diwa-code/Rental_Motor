<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_motor;
use App\Models\tb_kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class motorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data_motor = tb_motor::join('tb_kategori', 'tb_motor.kategori_id', '=', 'tb_kategori.id_kategori')
            ->get(); 
        // $queryBuilder = DB::table('tb_produk')->get(); 
        // //query builder untuk mengambil semua data yang ada di tabel produk
        return view('pages.motor.show', compact('data_motor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua data kategori untuk ditampilkan di dropdown form
        $data_kategori = tb_kategori::all();
        
        // Mengarahkan ke halaman form tambah motor dan membawa data kategori
        return view('pages.motor.add', compact('data_kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input dari Form
        $request->validate([
            'kategori_id'  => 'required',
            'nama_motor'   => 'required',
            'tahun'        => 'required|numeric',
            'harga'        => 'required|numeric',
            'status'       => 'required|in:tersedia,disewa,servis',
            'gambar_motor' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'    => 'required',
        ], [
            // Kustomisasi pesan error agar lebih ramah dibaca pengguna
            'kategori_id.required'  => 'Kategori motor wajib dipilih',
            'nama_motor.required'   => 'Nama motor wajib diisi',
            'tahun.required'        => 'Tahun keluaran wajib diisi',
            'tahun.numeric'         => 'Tahun harus berupa angka',
            'harga.required'        => 'Harga sewa wajib diisi',
            'harga.numeric'         => 'Harga harus berupa angka',
            'status.required'       => 'Status motor wajib dipilih',
            'status.in'             => 'Pilihan status tidak valid',
            'gambar_motor.image'    => 'File yang diupload harus berupa gambar',
            'gambar_motor.mimes'    => 'Format gambar hanya boleh jpeg, png, jpg, atau webp',
            'gambar_motor.max'      => 'Ukuran gambar maksimal adalah 2MB',
            'deskripsi.required'    => 'Deskripsi atau spesifikasi motor wajib diisi',
        ]);

        // 2. Proses Upload Gambar (Jika User Mengunggah File)
        $namaGambar = null;
        if ($request->hasFile('gambar_motor')) {
            // Mengambil ekstensi file asli (misal: jpg, png)
            $ekstensi = $request->file('gambar_motor')->getClientOriginalExtension();
            
            // Membuat nama file acak agar tidak bentrok dengan file lain
            $namaGambar = Str::random(30) . '.' . $ekstensi;
            
            // Memindahkan file ke folder public/gambar_motor
            $request->file('gambar_motor')->move(public_path('gambar_motor'), $namaGambar);
        }

        // 3. Simpan Data ke Database
        tb_motor::create([
            'kategori_id'  => $request->kategori_id,
            'nama_motor'   => $request->nama_motor,
            'tahun'        => $request->tahun,
            'harga'        => $request->harga,
            'status'       => $request->status,
            'gambar_motor' => $namaGambar, // Akan berisi nama file acak atau null
            'deskripsi'    => $request->deskripsi,
        ]);

        // 4. Redirect Kembali ke Halaman Utama dengan Pesan Sukses
        return redirect('/motor')->with('pesan', 'Data motor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_motor)
    {
        $data_motor = tb_motor::join('tb_kategori', 'tb_motor.kategori_id', '=', 'tb_kategori.id_kategori')
        ->where('id_motor', $id_motor)
        ->firstOrFail();
    return view('pages.motor.detail', compact('data_motor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_motor)
    {
        $data = tb_motor::findOrFail($id_motor);
        
        // Mengambil semua data kategori untuk opsi dropdown
        $data_kategori = tb_kategori::all();
        
        // Mengarahkan ke halaman edit dan mengirimkan data motor serta kategori
        return view('pages.motor.edit', compact('data', 'data_kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_motor)
    {
        // 1. Validasi Input
        $request->validate([
            'kategori_id'  => 'required',
            'nama_motor'   => 'required',
            'tahun'        => 'required|numeric',
            'harga'        => 'required|numeric',
            'status'       => 'required|in:tersedia,disewa,servis',
            // Gambar boleh kosong (nullable) karena user mungkin tidak ingin mengganti fotonya
            'gambar_motor' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
            'deskripsi'    => 'required',
        ], [
            'kategori_id.required'  => 'Kategori motor wajib dipilih',
            'nama_motor.required'   => 'Nama motor wajib diisi',
            'tahun.required'        => 'Tahun keluaran wajib diisi',
            'tahun.numeric'         => 'Tahun harus berupa angka',
            'harga.required'        => 'Harga sewa wajib diisi',
            'harga.numeric'         => 'Harga harus berupa angka',
            'status.required'       => 'Status motor wajib dipilih',
            'status.in'             => 'Pilihan status tidak valid',
            'gambar_motor.image'    => 'File yang diupload harus berupa gambar',
            'gambar_motor.mimes'    => 'Format gambar hanya boleh jpeg, png, jpg, atau webp',
            'gambar_motor.max'      => 'Ukuran gambar maksimal adalah 2MB',
            'deskripsi.required'    => 'Deskripsi atau spesifikasi motor wajib diisi',
        ]);

        // 2. Siapkan data dasar yang akan diupdate
        $dataUpdate = [
            'kategori_id'  => $request->kategori_id,
            'nama_motor'   => $request->nama_motor,
            'tahun'        => $request->tahun,
            'harga'        => $request->harga,
            'status'       => $request->status,
            'deskripsi'    => $request->deskripsi,
        ];

        // 3. Handle upload gambar baru (jika ada)
        if ($request->hasFile('gambar_motor')) {
            $motorLama = tb_motor::findOrFail($id_motor);
            
            // Cek apakah gambar lama ada di database dan file fisiknya ada di folder
            if ($motorLama->gambar_motor && File::exists(public_path('gambar_motor/' . $motorLama->gambar_motor))) {
                // Hapus file gambar lama
                File::delete(public_path('gambar_motor/' . $motorLama->gambar_motor));
            }

            // Simpan gambar baru
            $ekstensi = $request->file('gambar_motor')->getClientOriginalExtension();
            $namaGambar = Str::random(30) . '.' . $ekstensi;
            $request->file('gambar_motor')->move(public_path('gambar_motor'), $namaGambar);
            
            // Masukkan nama gambar baru ke array data yang akan diupdate
            $dataUpdate['gambar_motor'] = $namaGambar;
        }

        // 4. Update data ke database
        tb_motor::where('id_motor', $id_motor)->update($dataUpdate);

        // 5. Redirect kembali ke halaman utama
        return redirect('/motor')->with('pesan', 'Data motor berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_motor)
    {
        // 1. Cari data motor berdasarkan ID
        // Gunakan fail agar otomatis error 404 jika ID tidak ditemukan
        $motor = tb_motor::findOrFail($id_motor);

        // 2. Cek dan hapus file gambar fisik di dalam folder public (jika ada)
        if ($motor->gambar_motor && File::exists(public_path('gambar_motor/' . $motor->gambar_motor))) {
            File::delete(public_path('gambar_motor/' . $motor->gambar_motor));
        }

        // 3. Hapus baris data dari database
        $motor->delete();

        // 4. Redirect kembali ke halaman utama dengan pesan sukses
        return redirect('/motor')->with('pesan', 'Data motor berhasil dihapus beserta gambarnya');
    }
}
