<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
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

    protected $fillable = [
        'title', 'description','date','place','image','event_type','status'
    ];
}
