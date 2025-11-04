@extends('dashboard')
@section('content')
<div class="container mt-2">
<div class="row">
   <div class="col-lg-12 margin-tb">
      <div class="pull-left mb-2">
         <h2>Formulir Tambah Reservasi</h2>
      </div>
   </div>
</div>

@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
   {{ session('status') }}
</div>
@endif
<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
   @csrf
   <div class="row">
      <!-- TANGGAL RESERVASI -->
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Tanggal Reservasi:</strong>
            <input class="date form-control" type="date" name="tanggal_reservasi" placeholder="Tanggal Reservasi">
            @error('date')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
         </div>
      </div>

      <!-- RUANGAN -->
       <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Ruangan:</strong>
            <select class="form-control" name="ruangan">
               <option value="garden">Garden Pohon Sakura Lantai 1</option>
               <option value="meja1">Meja Lantai 1</option>
               <option value="meja2">Meja Lantai 2</option>
               <option value="tatamiac">Tatami AC Lantai 2</option>
               <option value="tataminac">Tatami Non-AC Lantai 2</option>
               <option value="teras">Teras Outdoor Lantai 2</option>
            </select>
            @error('event_type')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
         </div>
      </div>

      <!-- WAKTU MULAI -->
       <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Waktu Mulai:</strong>
            <input type="time" name="waktu_mulai" class="form-control">
         </div>
      </div>

      <!-- WAKTU SELESAI -->
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Waktu Selesai:</strong>
            <input type="time" name="waktu_akhir" class="form-control">
         </div>
      </div>

      <!-- KONTAK -->
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Kontak:</strong>
            <input type="text" name="kontak" class="form-control" placeholder="Kontak">
         </div>
      </div>

      <!-- TIPE RESERVASI -->
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Tipe Reservasi</strong>
            <select class="form-control" name="tipe_reservasi">
               <option value="private">Non-Private</option>
               <option value="non-private">Private</option>
            </select>
            @error('event_type')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
         </div>
      </div>

      <!-- STATUS -->
      <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <strong>Status:</strong>
            <select class="form-control" name="status">
               <option value="1">Active</option>
               <option value="0">Inactive</option>
            </select>
            @error('event_type')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
         </div>
      </div>

      <div class="col-12 mt-3">
         <div class="d-flex justify-content-end gap-2">
            <a class="btn btn-secondary mr-3" href="{{ route('events.index') }}">Batal</a>
            <button type="submit" class="btn btn-primary" href="{{ route('events.index') }}">Tambah</button>
         </div>
      </div>
   </div>
</form>
@endsection