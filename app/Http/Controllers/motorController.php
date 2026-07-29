<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_motor;
use App\Models\tb_kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class motorController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menggunakan Eager Loading with('kategori') untuk mengurangi jumlah query ke Supabase.
     * Sebelumnya: join() manual = 1 query besar yang lambat di Supabase.
     * Sekarang: with() = 2 query ringan (SELECT motor + SELECT kategori WHERE IN).
     */
    public function index()
    {
        $data_motor = tb_motor::with('kategori')->get();
        return view('pages.motor.show', compact('data_motor'));
    }

    /**
     * Show the form for creating a new resource.
     * Data kategori di-cache selama 5 menit karena jarang berubah.
     */
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data langsung dari tabel database (tanpa cache) agar selalu real-time
        $data_kategori = tb_kategori::all();

        return view('pages.motor.add', compact('data_kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input dari Form
        $request->validate([
            'nama_motor'   => 'required',
            'tahun'        => 'required|numeric',
            'harga'        => 'required|numeric',
            'cc_mesin'     => 'nullable|string|max:50',
            'tag_tambahan' => 'nullable|string|max:100',
            'status'       => 'required|in:tersedia,disewa,servis',
            'gambar_motor' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'    => 'required',
        ], [
            // Kustomisasi pesan error agar lebih ramah dibaca pengguna
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
            $ekstensi = $request->file('gambar_motor')->getClientOriginalExtension();
            $namaGambar = Str::random(30) . '.' . $ekstensi;
            $request->file('gambar_motor')->move(public_path('gambar_motor'), $namaGambar);
        }

        // 3. Simpan Data ke Database
        tb_motor::create([
            'kategori_id'  => $request->kategori_id ?: null,
            'nama_motor'   => $request->nama_motor,
            'tahun'        => $request->tahun,
            'harga'        => $request->harga,
            'cc_mesin'     => $request->cc_mesin,
            'tag_tambahan' => $request->tag_tambahan,
            'status'       => $request->status,
            'gambar_motor' => $namaGambar,
            'deskripsi'    => $request->deskripsi,
        ]);

        // Hapus cache motor yang tersedia karena data berubah
        Cache::forget('data_motor_tersedia');

        return redirect('/motor')->with('pesan', 'Data motor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     * Menggunakan Eager Loading with('kategori') sebagai pengganti join() manual.
     */
    public function show(string $id_motor)
    {
        $data_motor = tb_motor::with('kategori')->findOrFail($id_motor);
        return view('pages.motor.detail', compact('data_motor'));
    }

    /**
     * Show the form for editing the specified resource.
     * Data kategori di-cache selama 5 menit.
     */
    public function edit(string $id_motor)
    {
        $data = tb_motor::findOrFail($id_motor);

        // Ambil data langsung dari tabel database (tanpa cache)
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
            'kategori_id'  => 'nullable|exists:tb_kategori,id_kategori',
            'nama_motor'   => 'required',
            'tahun'        => 'required|numeric',
            'harga'        => 'required|numeric',
            'cc_mesin'     => 'nullable|string|max:50',
            'tag_tambahan' => 'nullable|string|max:100',
            'status'       => 'required|in:tersedia,disewa,servis',
            'gambar_motor' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi'    => 'required',
        ], [
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
            'kategori_id'  => $request->kategori_id ?: null,
            'nama_motor'   => $request->nama_motor,
            'tahun'        => $request->tahun,
            'harga'        => $request->harga,
            'cc_mesin'     => $request->cc_mesin,
            'tag_tambahan' => $request->tag_tambahan,
            'status'       => $request->status,
            'deskripsi'    => $request->deskripsi,
        ];

        // 3. Handle upload gambar baru (jika ada)
        if ($request->hasFile('gambar_motor')) {
            $motorLama = tb_motor::findOrFail($id_motor);
            if ($motorLama->gambar_motor && File::exists(public_path('gambar_motor/' . $motorLama->gambar_motor))) {
                File::delete(public_path('gambar_motor/' . $motorLama->gambar_motor));
            }
            $ekstensi = $request->file('gambar_motor')->getClientOriginalExtension();
            $namaGambar = Str::random(30) . '.' . $ekstensi;
            $request->file('gambar_motor')->move(public_path('gambar_motor'), $namaGambar);
            $dataUpdate['gambar_motor'] = $namaGambar;
        }

        // 4. Update data ke database
        tb_motor::where('id_motor', $id_motor)->update($dataUpdate);

        // Hapus cache motor yang tersedia karena data berubah
        Cache::forget('data_motor_tersedia');

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

        // Hapus cache motor yang tersedia karena data berubah
        Cache::forget('data_motor_tersedia');

        // 4. Redirect kembali ke halaman utama dengan pesan sukses
        return redirect('/motor')->with('pesan', 'Data motor berhasil dihapus beserta gambarnya');
    }
}
