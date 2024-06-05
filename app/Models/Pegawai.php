<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'foto',
        'nama',
        'alamat',
        'tempatLahir',
        'tglLahir',
        'kelamin',
        'jabatan',
        'mulaiMasuk',
        'job',
    ];
}
