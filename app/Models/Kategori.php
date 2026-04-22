<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'nama_kategori'
    ];

    // 🔥 relasi ke media
    public function media()
    {
        return $this->hasMany(Media::class, 'kategori_id');
    }
}
