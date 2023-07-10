<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengujian extends Model
{
    use HasFactory;

    protected $table = 'pengujian';
    protected $fillable = [
        'pelanggan_id',
        'nama_proyek',
        'lokasi_proyek',
        'bidang',
        'berkas_sp',
        'berkas_spmk',
        'berkas_ktp',
        'berkas_gambar',
        'berkas_skrd',
        'status',
        'tgl_permohonan',
        'jadwal_pengujian',
        'no_skrd',
        'no_order',
        'laporan',
        'keterangan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function layanan()
    {
        return $this->hasOne(Layanan::class, 'pengujian_id');
    }
    public function penugasan()
    {
        return $this->hasOne(Penugasan::class, 'pengujian_id');
    }


}
