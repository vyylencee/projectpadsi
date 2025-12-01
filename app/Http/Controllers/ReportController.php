<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // 1. HALAMAN UTAMA + FILTER
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $reports = Report::whereMonth('tanggal_reservasi', $bulan)
                         ->whereYear('tanggal_reservasi', $tahun)
                         ->orderBy('tanggal_reservasi', 'asc')
                         ->get();

        $totalPendapatan = $reports->sum('total_payment');

        $daftarTahun = range(date('Y'), date('Y') - 10);

        $namaBulan = \Carbon\Carbon::create()->month($bulan)->translatedFormat('F');

        return view('report.index', compact(
            'reports', 'bulan', 'tahun', 'daftarTahun', 'totalPendapatan', 'namaBulan'
        ));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'bulan' => 'required|in:01,02,03,04,05,06,07,08,09,10,11,12',
            'tahun' => 'required|integer|min:2000|max:' . date('Y')
        ]);

        return redirect()->route('report.index', [
            'bulan' => $request->bulan,
            'tahun' => $request->tahun
        ]);
    }

    public function pdf(Request $request)
    {
        
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $reports = Report::whereMonth('tanggal_reservasi', $bulan)
                         ->whereYear('tanggal_reservasi', $tahun)
                         ->orderBy('tanggal_reservasi')
                         ->get();

        $namaBulan = \Carbon\Carbon::create()->month($bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('report.pdf', compact(
            'reports', 'namaBulan', 'tahun'
        ))->setPaper('a4', 'landscape');

        $namaFile = "Laporan_SIRFU_{$namaBulan}_{$tahun}.pdf";
        return $pdf->stream($namaFile);
    }
}