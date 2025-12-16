<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

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

    protected $table = 'reports';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_reservasi',
        'id_order',
        'tanggal_reservasi',
        'ruangan',
        'waktu_mulai',
        'waktu_akhir',
        'tipe_reservasi',
        'status',
        'payment_status'
    ];

    public $timestamps = false;

    public function getWaktuMulaiAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i');
    }

    public function getWaktuAkhirAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i');
    }
    
    public function event()
    {
        return $this->belongsTo(Event::class, 'id_reservasi');
    }

    protected $appends = ['idRep_format'];

    public function getFormattedReportIdAttribute()
    {
        $date = Carbon::parse($this->created_at);

        $bulan = strtoupper($date->translatedFormat('M'));
        $tahun = $date->format('y');

        $urutan = self::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->where('id', '<=', $this->id)
            ->count();

        return 'LAP-' . $bulan . '-' . $tahun . '-' . str_pad($urutan, 2, '0', STR_PAD_LEFT);
    }
}