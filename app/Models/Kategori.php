<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'id_kategori',
        'id_kategori_besar',
        'nama_kategori',
        'persen_populer',
        'persen_umum',
        'persen_unik',
    ];

    public function tempatkursus()
    {
        return $this->hasMany(TempatKursus::class, 'id_kategori', 'id_kategori');
    }

    public function kategoribesar()
    {
        return $this->belongsTo(KategoriBesar::class, 'id_kategori_besar', 'id_kategori_besar');
    }
}
