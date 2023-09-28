<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUtama extends Model
{
    use HasFactory;
    protected $table = 'kategori_utama';
    protected $primaryKey = 'id_kategori_utama';

    protected $fillable = [
        'id_kategori_utama',
        'nama_kategori_utama',
    ];

    public function kategoribesar()
    {
        return $this->hasMany(KategoriBesar::class, 'id_kategori_utama', 'id_kategori_utama');
    }
}
