<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = "pemesanan";

    protected $fillable = [
        "driver",
        "persetujuan_admin",
        "persetujuan_pihak",
        "id_user",
        "id_kendaraan"
    ];
}
