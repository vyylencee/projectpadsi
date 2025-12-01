<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
        {
            $today = Carbon::now()->format('Y-m-d');

            $totalHariIni = Event::whereDate('tanggal_reservasi', $today)->count();

            $onGoingHariIni = Event::whereDate('tanggal_reservasi', $today)
                                    ->whereIn('status', ['On-Going', 'Pending'])
                                    ->count();
            $completedHariIni = Event::whereDate('tanggal_reservasi', $today)
                                    ->where('status', 'Completed')
                                    ->count();
            $reservasiHariIni = Event::whereDate('tanggal_reservasi', $today)
                                    ->orderBy('status', 'desc')
                                    ->paginate(5);

            $totalHariIni     = $totalHariIni     ?? 0;
            $onGoingHariIni   = $onGoingHariIni   ?? 0;
            $completedHariIni = $completedHariIni ?? 0;

            $ruanganFav = Event::select('ruangan')
                ->whereDate('tanggal_reservasi', $today)
                ->groupBy('ruangan')
                ->orderByRaw('COUNT(*) DESC')
                ->first();

            $waktuFavorit = Event::select('waktu_mulai')
                ->where('tanggal_reservasi', $today)
                ->groupBy('waktu_mulai')
                ->orderByRaw('COUNT(*) DESC')
                ->first();
            
            $rerataDurasi = Event::selectRaw('AVG(TIMESTAMPDIFF(MINUTE, waktu_mulai, waktu_akhir)) as duration')
                ->value('duration');

            return view('dashboard', [
            'totalHariIni'     => $totalHariIni,
            'onGoingHariIni'   => $onGoingHariIni,
            'completedHariIni' => $completedHariIni,
            'reservasiHariIni' => $reservasiHariIni,
            'ruanganFav' => $ruanganFav,
            'waktuFavorit' => $waktuFavorit,
            'rerataDurasi' => $rerataDurasi

        ]);
        }
}
    
