<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_kategori', function (Blueprint $table) {
            // Menambahkan .nullable() dan diakhiri dengan ->change()
            $table->string('nama_kategori')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tb_kategori', function (Blueprint $table) {
            // Mengembalikan ke kondisi semula (tidak boleh null) jika di-rollback
            $table->string('nama_kategori')->nullable(false)->change();
        });
    }
};