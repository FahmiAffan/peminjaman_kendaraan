<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = "kendaraan";

    protected $fillable = [
        "nama_kendaraan",
        "jenis_angkutan_kendaraan",
        "kilometer_kendaraan",
        "pemilik_kendaraan",
    ];
}
