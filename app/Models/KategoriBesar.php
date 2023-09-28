<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBesar extends Model
{
    use HasFactory;
    protected $table = 'kategori_besar';
    protected $primaryKey = 'id_kategori_besar';

    protected $fillable = [
        'id_kategori_besar',
        'id_kategori_utama',
        'nama_kategori_besar',
    ];

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'id_kategori_besar', 'id_kategori_besar');
    }

    public function kategoriutama()
    {
        return $this->belongsTo(KategoriUtama::class, 'id_kategori_utama', 'id_kategori_utama');
    }
}
