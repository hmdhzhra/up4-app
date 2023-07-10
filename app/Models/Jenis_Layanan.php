<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Layanan extends Model
{
    use HasFactory;
    protected $table = 'jenis_layanan';
    protected $fillable = [
        'nama_layanan',
        'harga',
        'satuan',
    ];

    public function layanan()
    {
        return $this->hasMany(Layanan::class);
    }



}
