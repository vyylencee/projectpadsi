@extends('main')
@section('content')



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container d-flex justify-content-end">
    <span class="navbar-text p-2 mb-3 mt-2" style="background-color: #ffffff; font: Gabarito; font-size: 16px; font-weight: 600; border-radius: 15px;">
    <i class="bi bi-calendar2-week ml-2 mr-2"></i>
    {{ \Carbon\Carbon::now()->translatedFormat('d/m/Y') }}</span>
</div>


<div class="container">
    <h5 class="mb-2" style="font-weight: 600;">Dashboard</h5>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="p-3 " 
                style="background-color:#fff; border-radius:16px; font-family:'Poppins', sans-serif;
                       font-size:14px; box-shadow:0 2px 6px rgba(0,0,0,0.08);">

                <div class="mb-3">
                    <h6 style="font-weight:600;">Ruangan Ter-Favorit</h6>
                    <span class="text-muted">{{ $ruanganFav->ruangan_nama ?? '-' }}</span>
                </div>
                <hr>

                <div class="mb-3">
                    <h6 style="font-weight:600;">Waktu Ter-Favorit</h6>
                    <span class="text-muted">{{ $waktuFavorit->waktu_mulai ?? '-' }}</span>
                </div>
                <hr>

                <div>
                    <h6 style="font-weight:600;">Rata-Rata Durasi Reservasi</h6>
                    <span class="text-muted">{{ number_format($rerataDurasi, 1) }} menit</span>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 " 
                style="background-color:#fff; border-radius:16px; font-family:'Poppins', sans-serif;
                       font-size:14px; box-shadow:0 2px 6px rgba(0,0,0,0.08);">

                <div class="mb-3">
                    <h6 style="font-weight:600;">Total Reservasi</h6>
                    <h4>{{ $totalHariIni }}</h4>
                    <span class="text-muted">Total Reservasi Hari Ini</span>
                </div>
                <hr>

                <div class="mb-3">
                    <h6 style="font-weight:600;">Reservasi Aktif</h6>
                    <h4>{{ $onGoingHariIni }}</h4>
                    <span class="text-muted">Total reservasi yang akan datang</span>
                </div>
                <hr>

                <div>
                    <h6 style="font-weight:600;">Reservasi Selesai</h6>
                    <h4>{{ $completedHariIni }}</h4>
                    <span class="text-muted">Total reservasi yang sudah selesai</span>
                </div>

            </div>
        </div>
        <div class="col-md-4" style="background-color:#fff; border-radius:16px; font-family:'Poppins', sans-serif;
                       font-size:14px; box-shadow:0 2px 6px rgba(0,0,0,0.08);">
            <h6 class="mt-3 mb-2" style="font-weight: 600;">Grafik Reservasi</h6>

            <select id="miniFilter" class="form-select form-select-sm mb-2" style="width: 150px;">
                <option value="mingguan">Mingguan</option>
                <option value="bulanan">Bulanan</option>
                <option value="tahunan">Tahunan</option>
            </select>

            <canvas id="miniChart" height="100"></canvas>
        </div>
    </div>
</div>

<div>
    <span class="navbar-text mb-3 mt-3" style="font: Gabarito; font-size: 18px; font-weight: 600; font-color: white;">Daftar Reservasi Hari Ini!</span>
</div>
    <table class="table table-bordered text-center" style="background-color: #FFFFFF; font-family: 'Poppins', sans-serif; font-size: 14px;">
        <tr>
            <th>ID Reservasi</th>
            <th>Ruangan</th>
            <th>Waktu Mulai</th>
            <th>Waktu Berakhir</th>
            <th>Status</th>
        </tr>

        @foreach ($reservasiHariIni as $event)
        <tr>
            <td>{{ $event->id ?? '-' }}</td>
            <td>{{ $event->ruangan_nama ?? '-'}}</td>
            <td>{{ $event->waktu_mulai ?? '-'}}</td>
            <td>{{ $event->waktu_akhir ?? '-'}}</td>
            <td><span class="px-2 py-1" 
               style="border-radius:5px; background-color:
                  {{ $event->status == 'Pending' ? '#ffde21' :
                     ($event->status == 'On-Going' ? '#0082FC' :
                     ($event->status == 'Completed' ? '#4ade80' : '#6B7280')) }}; 
                     color: {{($event->status == 'On-Going' ? '#ffffff' : '#000000')}}" >
            {{ $event->status }}
         </span></td>
        </tr>
        @endforeach
    </table>
<div class="d-flex justify-content-center mt-3">
    {{ $reservasiHariIni->links('pagination::bootstrap-4') }}
</div>
</div> 


@endsection