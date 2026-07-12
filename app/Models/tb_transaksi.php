<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_transaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
    'customer_id', 'motor_id', 'harga_sewa', 'durasi', 
    'tgl_mulai', 'tgl_selesai', 'total_bayar', 'status_transaksi'
];

    /**
     * Relasi ke tabel Customer
     * Satu transaksi dimiliki oleh satu customer
     */
    public function customer()
    {
        // Pastikan nama Model 'tb_customer' sesuai dengan nama Model Anda (misal: Customer::class atau tb_customer::class)
        return $this->belongsTo(tb_customer::class, 'customer_id', 'id_customer');
    }

    /**
     * Relasi ke tabel Motor
     * Satu transaksi menyewa satu motor
     */
    public function motor()
    {
        // Pastikan nama Model 'Motor' sesuai dengan nama Model Anda
        return $this->belongsTo(tb_motor::class, 'motor_id', 'id_motor');
    }
}