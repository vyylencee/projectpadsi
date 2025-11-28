<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';

    protected $fillable = [
        'id',
        'id_order',
        'ruangan',
        'tanggal_reservasi',
        'waktu_mulai',
        'waktu_akhir',
        'tipe_reservasi',
        'status',
        'payment_status',
    ];
}