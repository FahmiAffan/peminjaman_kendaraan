<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pemesanan extends Model
{
    use HasFactory;

    protected $table = "pemesanan";

    protected $primaryKey = "id_pemesanan";

    protected $fillable = [
        "driver",
        "konsumsi_bbm",
        "persetujuan_admin",
        "persetujuan_pihak",
        "id_user",
        "id_kendaraan"
    ];

    public function kendaraan()
    {
        return $this->hasOne(Kendaraan::class, "id_kendaraan", "id_kendaraan");
    }

    public function user()
    {
        return $this->hasOne(User::class, "id_user", "id_user");
    }
}
