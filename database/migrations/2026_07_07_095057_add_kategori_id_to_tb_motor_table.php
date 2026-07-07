<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_motor', function (Blueprint $table) {
            // PENTING: Gunakan nullable() agar data lama yang sudah ada di database tidak error
            $table->unsignedBigInteger('kategori_id')->nullable()->after('id_motor');
            
            // Membuat relasi foreign key ke tabel tb_kategori
            $table->foreign('kategori_id')
                  ->references('id_kategori')
                  ->on('tb_kategori')
                  ->onDelete('set null'); // Jika kategori dihapus, id di motor jadi null (data motor tidak ikut terhapus)
        });
    }

    public function down(): void
    {
        Schema::table('tb_motor', function (Blueprint $table) {
            // Membatalkan relasi dan menghapus kolom jika di-rollback
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};