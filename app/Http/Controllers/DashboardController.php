<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
        {
            $today = Carbon::today()->toDateString();

            $todayReservations = Event::whereDate('tanggal_reservasi', $today)
                ->orderBy('waktu_mulai', 'asc')
                ->get();

            return view('dashboard', compact('todayReservations', 'today'));
        }
    
}