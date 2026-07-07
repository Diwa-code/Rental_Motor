<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_motor', function (Blueprint $table) {
            $table->id('id_motor');
            $table->string('nama_motor');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->integer('tersedia');
            $table->string('foto');
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_motor');
    }
};
