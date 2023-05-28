<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatKursus extends Model
{
    use HasFactory;
    protected $table = 'tempat_kursus';
    protected $primaryKey = 'id_tempat_kursus';

    protected $fillable = [
            'id_tempat_kursus',
            'id_user',
            'id_kategori',
            'nama_tempat_kursus',
            'alamat',
            'latitude',
            'longitude',
            'no_telp',
            'foto_utama',
            'jumlah_pengunjung',
            'instagram',
            'facebook',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function program()
    {
        return $this->hasMany(Program::class, 'id_tempat_kursus', 'id_tempat_kursus');
    }
}

