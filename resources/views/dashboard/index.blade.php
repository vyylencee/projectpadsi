@extends('dashboard')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


<div class="container-fluid">
    <span class="navbar-text mb-2" style="font: Gabarito; font-size: 20px; font-weight: 600;">Selamat Datang, Admin!</span>
</div>

<div class="container d-flex justify-content-end">
    <span class="navbar-text p-2 mb-3 mt-2" style="background-color: #ffffff; font: Gabarito; font-size: 16px; font-weight: 600; border-radius: 15px;">
    <i class="bi bi-calendar2-week ml-2 mr-2"></i>
    {{ \Carbon\Carbon::now()->translatedFormat('d/m/Y') }}</span>
</div>

<div class="container">
    <div class="row justify-content-center" style="font-family: 'Fredoka', sans-serif; font-size: 14px; color: #000; ">
            <div class="col-md-3 mx-4 ml-2 p-4 text-left" style="background-color: #fff; border-radius: 15px; color: black;">
                <h6>Total Reservasi</h6>
                <h2>0</h2>
                <span>Total Reservasi Hari Ini</span>
            </div>

            <div class="col-md-3 mx-4 ml-2 p-4 text-left" style="background-color: #fff; border-radius: 15px; color: black;">
                <h6>Reservasi Aktif</h6>
                <h2>0</h2>
                <span>Total reservasi yang akan datang</span>
            </div>

            <div class="col-md-3 mx-4 ml-2 p-4 text-left" style="background-color: #fff; border-radius: 15px; color: black;">
                <h6>Reservasi Selesai</h6>
                <h2>0</h2>
                <span>Total reservasi yang sudah selesai</span>
            </div>
    </div>

    <span class="navbar-text mb-3 mt-4" style="font: Gabarito; font-size: 18px; font-weight: 600; font-color: white;">Daftar Reservasi Hari Ini!</span>

    <table class="table table-bordered text-center" style="background-color: #FFFFFF; font-family: 'Fredoka', sans-serif; font-size: 14px;">
        <tr>
            <th>ID Reservasi</th>
            <th>Tanggal Reservasi</th>
            <th>Ruangan</th>
            <th>Waktu Mulai</th>
            <th>Waktu Berakhir</th>
        </tr>
    </table>
</div> 


@endsection