<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanan';
    protected $fillable = [
        'pengujian_id',
        'jenis_id',
        'jumlah',
        'total',
        'status_pembayaran',
    ];
    protected $attributes = [
        'status_pembayaran' => 'unpaid',

    ];

    public function jenisLayanan()
    {
        return $this->belongsTo(Jenis_Layanan::class, 'jenis_id');
    }

    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'pengujian_id');
    }

}
