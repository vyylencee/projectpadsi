<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Event;

class ReportController extends Controller
{
    
    public function createFromEvent(Event $event)
    {
        \DB::table('report')->insert([
            'id' => $event->id,
            'id_order' => $event->id_order,
            'ruangan' => $event->ruangan,
            'tanggal_reservasi' => $event->tanggal_reservasi,
            'waktu_mulai' => $event->waktu_mulai,
            'waktu_akhir' => $event->waktu_akhir,
            'tipe_reservasi' => $event->tipe_reservasi,
            'status' => $event->status,
            'payment_status' => $event->payment_status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    public function index()
    {
        $reports = \DB::table('report')
        ->leftJoin('events', 'events.id', '=', 'report.id')
        ->select('report.*', 'events.ruangan', 'events.tanggal_reservasi')
        ->get();


        $reports = Report::orderBy('id', 'DESC')->paginate(10);
        return view('report.index', compact('reports'));
    }

}
