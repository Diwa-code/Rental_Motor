<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tb_motor extends Model
{
    protected $table = 'tb_motor';
    protected $primaryKey = 'id_motor';
    protected $fillable = ['nama_motor', 'deskripsi', 'harga', 'tersedia', 'foto', 'tahun'];
    protected $guarded = ['id_motor'];
}
