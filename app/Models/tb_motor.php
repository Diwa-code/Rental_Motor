<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tb_motor extends Model
{
    protected $table = 'tb_motor';
    protected $primaryKey = 'id_motor';
    protected $fillable = ['nama_motor', 'deskripsi', 'harga', 'status', 'gambar_motor', 'tahun', 'kategori_id'];
    protected $guarded = ['id_motor'];

    // Mendefinisikan relasi one-to-many dengan tb_kategori
    public function kategori()
    {
        return $this->belongsTo(tb_kategori::class, 'kategori_id', 'id_kategori');
    }
}
