<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nik',
        'telp',
        'jabatan',
        'alamat',
        'nama_pr',
        'email_pr',
        'alamat_pr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengujian()
    {
        return $this->hasMany(Pengujian::class);
    }
    

    
}
