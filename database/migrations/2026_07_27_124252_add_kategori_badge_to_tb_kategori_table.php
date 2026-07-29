<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Memindahkan kolom kategori_badge dari tb_motor ke tb_kategori.
     * - tb_kategori: tambah kolom kategori_badge (diisi di halaman Kategori)
     * - tb_motor: hapus kolom kategori_badge (digantikan oleh FK kategori_id)
     */
    public function up(): void
    {
        // 1. Tambah kolom kategori_badge ke tabel tb_kategori
        Schema::table('tb_kategori', function (Blueprint $table) {
            $table->string('kategori_badge')->nullable()->after('nama_kategori');
        });

        // 2. Hapus kolom kategori_badge dari tb_motor (sudah dipindah ke tb_kategori)
        Schema::table('tb_motor', function (Blueprint $table) {
            $table->dropColumn('kategori_badge');
        });
    }

    /**
     * Rollback: kembalikan seperti semula.
     */
    public function down(): void
    {
        // Kembalikan kategori_badge ke tb_motor
        Schema::table('tb_motor', function (Blueprint $table) {
            $table->string('kategori_badge')->nullable()->after('harga');
        });

        // Hapus kategori_badge dari tb_kategori
        Schema::table('tb_kategori', function (Blueprint $table) {
            $table->dropColumn('kategori_badge');
        });
    }
};
