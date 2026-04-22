<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'mahasiswa_id';

    protected $fillable = [
        'nim',
        'nama_lengkap',
        'prodi_id'
    ];

    // 🔥 relasi ke prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    // 🔥 relasi ke media
    public function media()
    {
        return $this->hasMany(Media::class, 'mahasiswa_id');
    }
}
