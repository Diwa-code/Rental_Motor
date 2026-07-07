<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tb_kategori extends Model
{
    protected $table = 'tb_kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];
    protected $guarded = ['id_kategori'];
}
