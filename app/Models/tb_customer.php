<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_customer extends Model
{
    use HasFactory;

    protected $table = 'tb_customer';
    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
        'foto_ktp',
    ];
    protected $guarded = ['id_customer'];
}
