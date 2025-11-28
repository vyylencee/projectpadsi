@extends('dashboard')
@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid mt-2">
    <div class="pull-left mb-4">
         <h2>Kelola Laporan</h2>
    </div>

    <table class="table table-bordered text-center" style="background-color: #FFFFFF; font-family: 'Fredoka', sans-serif; font-size: 14px;">
        <tr>
            <th>ID Reservasi</th>
            <th>ID Order</th>
            <th>Tanggal Reservasi</th>
            <th>Ruangan</th>
            <th>Waktu Mulai</th>
            <th>Waktu Berakhir</th>
            <th>Tipe Reservasi</th>
            <th>Status</th>
        </tr>

        @foreach ($reports as $report)
        <tr>
            <td>{{ $report->id ?? '-' }}</td>
            <td>{{ $report->id_order }}</td>
            <td>{{ $report->tanggal_reservasi ?? '-'}}</td>
            <td>{{ $report->ruangan ?? '-'}}</td>
            <td>{{ $report->waktu_mulai ?? '-'}}</td>
            <td>{{ $report->waktu_akhir ?? '-'}}</td>
            <td>{{ $report->tipe_reservasi ?? '-'}}</td>
            <td>{{ $report->status ?? '-'}}</td>
        </tr>
        @endforeach
    </table>
</div>



@endsection