<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Carbon\Carbon;
use DateTime;
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
            
            $perHari = \App\Models\Event::selectRaw('DATE(tanggal_reservasi) as tanggal, COUNT(*) as total')
                ->where('tanggal_reservasi', '>=', now()->subDays(6))
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();
        
            $labelsHari = $perHari->pluck('tanggal');
            $dataHari   = $perHari->pluck('total');
    
            $perBulan = \App\Models\Event::selectRaw('MONTH(tanggal_reservasi) as bulan, COUNT(*) as total')
                ->whereYear('tanggal_reservasi', now()->year)
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();
        
            $labelsBulan = $perBulan->pluck('bulan')->map(function($b){ 
                return DateTime::createFromFormat('!m', $b)->format('F');
            });
        
            $dataBulan   = $perBulan->pluck('total');
       
            $perTahun = \App\Models\Event::selectRaw('YEAR(tanggal_reservasi) as tahun, COUNT(*) as total')
                ->groupBy('tahun')
                ->orderBy('tahun')
                ->get();
        
            $labelsTahun = $perTahun->pluck('tahun');
            $dataTahun   = $perTahun->pluck('total');
        
    
            return view('dashboard', [
            'totalHariIni'     => $totalHariIni,
            'onGoingHariIni'   => $onGoingHariIni,
            'completedHariIni' => $completedHariIni,
            'reservasiHariIni' => $reservasiHariIni,
            'ruanganFav' => $ruanganFav,
            'waktuFavorit' => $waktuFavorit,
            'rerataDurasi' => $rerataDurasi,
            'labelsHari' => $labelsHari,
            'labelsBulan' => $labelsBulan,
            'labelsTahun' => $labelsTahun,
            'dataHari' => $dataHari,
            'dataBulan' => $dataBulan,
            'dataTahun' => $dataTahun


        ]);
    }


}
    
