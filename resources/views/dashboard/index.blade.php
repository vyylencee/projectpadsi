@extends('dashboard')
@section('content')

<div class="container-fluid">
    <span class="navbar-text mb-2" style="font: Gabarito; font-size: 20px; font-weight: 600; font-color: white;">Selamat Datang, Admin!</span>
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