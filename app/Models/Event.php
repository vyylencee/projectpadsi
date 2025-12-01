<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Event extends Model
{
    use HasFactory;
    
    public static $statusOptions = [
        'On-Going'       => 'On-Going',
        'Pending'        => 'Pending',
        'Completed'        => 'Completed',
    ];

    public static $ruanganOptions = [
        'garden'       => 'Garden Pohon Sakura Lantai 1',
        'meja1'        => 'Meja Lantai 1',
        'meja2'        => 'Meja Lantai 2',
        'tatamiac'     => 'Tatami AC Lantai 2',
        'tataminac'    => 'Tatami Non-AC Lantai 2',
        'teras'        => 'Teras Outdoor Lantai 2',
    ];

    public function getRuanganNamaAttribute()
    {
        return self::$ruanganOptions[$this->ruangan] ?? $this->ruangan;
    }

    public function getStatusReservasiAttribute()
    {
        return self::$statusOptions[$this->status] ?? $this->status;
    }

    public function getWaktuMulaiAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i');
    }

    public function getWaktuAkhirAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i');
    }

    protected $fillable = [
        'id',
        'id_order',
        'minimum_order',
        'total_payment',
        'payment_status',
        'status',
        'tanggal_reservasi',
        'ruangan',
        'waktu_mulai',
        'waktu_akhir',
        'tipe_reservasi',
        'kontak'

    ];
}
