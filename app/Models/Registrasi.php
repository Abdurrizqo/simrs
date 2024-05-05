<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'registrasi';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'no_rawat',
        'waktu_registrasi',
        'antrian_poli',
        'status_periksa',
        'status_bayar',
        'poli',
        'dokter',
        'pasien',
    ];
}
