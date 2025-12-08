<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;


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
    
   public function chartDashboard(Request $request)
    {
        $filter = $request->filter ?? 'mingguan';

        if ($filter === 'mingguan') {
            $data = \DB::table('events')
                ->selectRaw("DATE(created_at) as tanggal, DAYNAME(created_at) as label, COUNT(*) as jumlah")
                ->whereBetween('created_at', [
                    now()->startOfWeek(), 
                    now()->endOfWeek()
                ])
                ->groupBy('tanggal', 'label')
                ->orderBy('tanggal')
                ->get();

        } elseif ($filter === 'bulanan') {
            $data = \DB::table('events')
                ->selectRaw("MONTH(created_at) as no_bulan, MONTHNAME(created_at) as label, COUNT(*) as jumlah")
                ->whereYear('created_at', now()->year)
                ->groupBy('no_bulan', 'label')
                ->orderBy('no_bulan')
                ->get();
                
        } else { // tahunan = 5 tahun terakhir
            $data = \DB::table('events')
                ->selectRaw("YEAR(created_at) as label, COUNT(*) as jumlah")
                ->whereBetween('created_at', [
                    now()->subYears(4)->startOfYear(),
                    now()->endOfYear()
                ])
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        }

        return response()->json($data);
    }


}
    
