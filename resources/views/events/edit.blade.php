@extends('dashboard')
@section('content')
<div class="container mt-2">
   <div class="row">
      <div class="col-lg-12 margin-tb">
         <div class="pull-left">
            <h2>Form Ubah Reservasi</h2>
         </div>
      </div>
   </div>
   @if(session('status'))
   <div class="alert alert-success mb-1 mt-1">
      {{ session('status') }}
   </div>
   @endif
   <form action="{{ route('events.update',$event->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
         <!-- TANGGAL RESERVASI -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Tanggal Reservasi:</strong>
               <input class="date form-control" type="date" value="{{ $event->tanggal_reservasi }}" name="tanggal_reservasi" placeholder="Tanggal Reservasi">
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
               <option {{ $event->ruangan == 'garden' ?'selected':'' }} value="garden"> Garden Pohon Sakura Lantai 1 </option>
               <option {{ $event->ruangan == 'meja1' ?'selected':'' }} value="meja1"> Meja Lantai 1 </option>
               <option {{ $event->ruangan == 'meja2' ?'selected':'' }} value="meja2"> Meja Lantai 2 </option>
               <option {{ $event->ruangan == 'tatamiac' ?'selected':'' }} value="tatamiac"> Tatami AC Lantai 2 </option>
               <option {{ $event->ruangan == 'tataminac' ?'selected':'' }} value="tataminac"> Tatami Non-AC Lantai 2 </option>
               <option {{ $event->ruangan == 'teras' ?'selected':'' }} value="teras"> Teras Outdoor Lantai 2 </option>
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
               <input type="Time" value="{{ $event->waktu_mulai }}" name="waktu_mulai" class="form-control" placeholder="Waktu Mulai">
            </div>
         </div>

         <!-- WAKTU SELESAI -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Waktu Selesai:</strong>
               <input type="Time" value="{{ $event->waktu_akhir }}" name="waktu_akhir" class="form-control" placeholder="Waktu Selesai">
            </div>
         </div>

         <!-- KONTAK -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Kontak:</strong>
               <input type="text" value="{{ $event->kontak }}" name="kontak" class="form-control" placeholder="Kontak">
            </div>
         </div>
        
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Event Type:</strong>
               <select class="form-control" name="tipe_reservasi">
               <option {{ $event->tipe_reservasi == 'non-private' ?'selected':'' }} value="non-private"> Non-Private </option>
               <option {{ $event->tipe_reservasi == 'private' ?'selected':'' }} value="private"> Private </option>
               </select>
               @error('event_type')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
               @enderror
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               <strong>Event Status:</strong>
               <select class="form-control" name="status">
               <option {{ $event->status == '1' ?'selected':'' }} value="1"> Active </option>
               <option {{ $event->status == '0' ?'selected':'' }} value="0"> Inactive </option>
               </select>
               @error('event_type')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
               @enderror
            </div>
         </div>

         <div class="col-12 mt-3">
         <div class="d-flex justify-content-end gap-2">
            <a class="btn btn-secondary mr-3" href="{{ route('events.index') }}">Batal</a>
            <button type="submit" class="btn btn-primary">Perbarui</button>
         </div>
      </div>
      </div>
   </form>
</div>
@endsection