<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = 'program';
    protected $primaryKey = 'id_program';

    protected $fillable = [
            'id_program',
            'id_user',
            'id_tempat_kursus',
            'nama_program',
            'deskripsi_program',
            'foto_program',
    ];

    public function tempatkursus()
    {
        return $this->belongsTo(TempatKursus::class, 'id_tempat_kursus', 'id_tempat_kursus');
    }
}

