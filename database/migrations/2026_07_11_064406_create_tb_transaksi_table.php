<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi');
            
            // Nama kolom disesuaikan dengan Controller
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('motor_id');
            
            $table->decimal('harga_sewa', 10, 2);
            $table->integer('durasi');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->decimal('total_bayar', 10, 2);
            $table->enum('status_transaksi', ['berjalan', 'selesai'])->default('berjalan');
            
            // Relasi tetap menggunakan id_motor dan id_customer dari tabel masternya
            $table->foreign('motor_id')->references('id_motor')->on('tb_motor')->onDelete('cascade');
            $table->foreign('customer_id')->references('id_customer')->on('tb_customer')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};