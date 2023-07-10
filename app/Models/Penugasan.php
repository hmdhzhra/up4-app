<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;
    protected $table = 'penugasan';
    protected $fillable = [
        'pengujian_id',
        'tim_lab',
        'surat_tugas',
        'laporan_lab',
    ];
    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'pengujian_id');
    }
}
