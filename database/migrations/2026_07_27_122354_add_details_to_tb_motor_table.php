<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_motor', function (Blueprint $table) {
            // Menambahkan kolom baru setelah kolom harga (atau sesuaikan dengan kebutuhanmu)
            $table->string('kategori_badge')->nullable()->after('harga');
            $table->string('cc_mesin')->nullable()->after('kategori_badge');
            $table->string('tag_tambahan')->nullable()->after('cc_mesin');
        });
    }

    public function down(): void
    {
        Schema::table('tb_motor', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn(['kategori_badge', 'cc_mesin', 'tag_tambahan']);
        });
    }
};