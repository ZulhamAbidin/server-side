<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'alamat_domisili',
        'jenis_kelamin',
        'pendidikan_terakhir',
        'jurusan',
        'hari'
    ];
}
