<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Atlet;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'kompetensi_keahlian'];

    public function siswa()
    {
        return $this->hasMany(Atlet::class);
    }
}