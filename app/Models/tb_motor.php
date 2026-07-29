<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tb_motor extends Model
{
    protected $table = 'tb_motor';
    protected $primaryKey = 'id_motor';
    protected $fillable = ['nama_motor', 'deskripsi', 'harga', 'kategori_id', 'cc_mesin', 'tag_tambahan', 'status', 'gambar_motor', 'tahun'];
    protected $guarded = ['id_motor'];

    // Mendefinisikan relasi one-to-many dengan tb_kategori
    public function kategori()
    {
        return $this->belongsTo(tb_kategori::class, 'kategori_id', 'id_kategori');
    }
}
