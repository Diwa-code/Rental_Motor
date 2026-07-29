<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_kategori;
use Illuminate\Support\Facades\Cache;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_kategori = tb_kategori::get();
        return view('pages.kategori.show', compact('data_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kategori.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_badge' => 'required|string|max:100',
        ], [
            'kategori_badge.required' => 'Nama badge wajib diisi',
        ]);

        tb_kategori::create([
            'kategori_badge' => $request->kategori_badge,
        ]);

        // Hapus cache data_kategori karena data berubah
        Cache::forget('data_kategori');

        return redirect('/kategori')->with('pesan', 'Badge berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kategori)
    {
        $data = tb_kategori::findOrFail($id_kategori);
        return view('pages.kategori.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_kategori)
    {
        $request->validate([
            'kategori_badge' => 'required|string|max:100',
        ], [
            'kategori_badge.required' => 'Nama badge wajib diisi',
        ]);

        tb_kategori::findOrFail($id_kategori)->update([
            'kategori_badge' => $request->kategori_badge,
        ]);

        // Hapus cache data_kategori karena data berubah
        Cache::forget('data_kategori');

        return redirect('/kategori')->with('pesan', 'Badge berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kategori)
    {
        tb_kategori::findOrFail($id_kategori)->delete();

        // Hapus cache data_kategori karena data berubah
        Cache::forget('data_kategori');

        return redirect('/kategori')->with('pesan', 'Data berhasil dihapus');
    }
}
