<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Reservasi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .text-center { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background: #007bff; color: white; }
        .total { font-size: 18px; font-weight: bold; text-align: right; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="text-center">
        <h1>LAPORAN RESERVASI RUANGAN</h1>
        <h3>{{ $namaBulan ?? 'Semua Bulan' }} {{ $tahun ?? date('Y') }}</h3>
    </div>

    <table>
        <thead>
            <tr>
            <th>ID Laporan</th>
            <th>ID Reservasi</th>
            <th>ID Order</th>
            <th>Tanggal Reservasi</th>
            <th>Ruangan</th>
            <th>Waktu</th>
            <th>Tipe Reservasi</th>
            <th>Status</th>
            <th>Status Pembayaran</th>
        </tr>
        </thead>
        <tbody>
            @forelse($reports as $i => $r)
            <tr>
                <td>{{ $r->id_laporan }}</td>
                <td>{{ $r->id_reservasi }}</td>
                <td>{{ $r->id_order ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($r->tanggal_reservasi)->format('d/m/Y') }}</td>
                <td>{{ $r->ruangan_nama }}</td>
                <td>{{ $r->waktu_mulai }} - {{ $r->waktu_akhir }}</td>
                <td>{{ ucfirst($r->tipe_reservasi) }}</td>
                <td>{{ $r->status }}</td>
                <td>{{ $r->payment_status }}</td>
            </tr>
            @empty
            <tr><td colspan="7">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <table>
        <tr>
            <th>Total Reservasi</th>
            <th>Ruangan Favorit</th>
            <th>Waktu Favorit</th>
            <th>Rata-Rata Durasi Reservasi</th>
        </tr>
        <tr>
            <td>{{ $totalReservasi ?? count($reports) }}</td>
            <td>{{ $ruanganFav->ruangan_nama ?? '-' }}</td>
            <td>{{ $waktuFavorit->waktu_mulai ?? '-' }}</td>
            <td>{{ $rerataDurasi ?? '-' }} menit</td>
        </tr>

</table>
</body>
</html>