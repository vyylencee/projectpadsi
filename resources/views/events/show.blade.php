@extends('main')
@section('content')
<div class="container mt-2">
<div class="row">
   <div class="col-lg-12 margin-tb">
      <div class="pull-left mb-2">
         <h2 class="mb-4">Tampil Detail Reservasi</h2>
      </div>
   </div>
</div>

@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
   {{ session('status') }}
</div>
@endif
<form action="{{ route('events.show',$event->id) }}" method="post" enctype="multipart/form-data">
      <div class="row" style="background-color: #fff; padding: 20px; border-radius: 10px;">
         <!-- TANGGAL RESERVASI -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="mt-2 d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Tanggal Reservasi:</strong>
               <span class="detail-label">{{ $event->tanggal_reservasi }}<span>
            </div>
         </div>

         <!-- RUANGAN -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Ruangan:</strong>
               <span class="detail-label">{{ $event->ruangan_nama }}<span>
            </div>
         </div>

         <!-- WAKTU MULAI -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Waktu Mulai:</strong>
               <span class="detail-label">{{ $event->waktu_mulai }}<span>
            </div>
         </div>

         <!-- WAKTU SELESAI -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Waktu Selesai:</strong>
               <span class="detail-label">{{ $event->waktu_akhir }}<span>
            </div>
         </div>

         <!-- KONTAK -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Kontak:</strong>
               <<span class="detail-label">{{ $event->kontak }}<span>
            </div>
         </div>
        
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Tipe Reservasi</strong>
               <span class="detail-label">{{ $event->tipe_reservasi }}<span>
            </div>
         </div>

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Status:</strong>
               <span class="detail-label">{{ $event->status_reservasi }}<span>
            </div>
         </div>

         <div class="col-12 mt-3">
         <div class="d-flex justify-content-end gap-2">
            <a class="btn btn-primary mr-3" href="{{ route('events.index') }}">Kembali</a>
         </div>
      </div>
      </div>
   </form>
</div>
@endsection
