@extends('main')
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
            <div class="mt-2 d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Tanggal Reservasi:</strong>
               <input class="date form-control" type="date" value="{{ $event->tanggal_reservasi }}" name="tanggal_reservasi" placeholder="Tanggal Reservasi"   required>
               @error('date')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
               @enderror
            </div>
         </div>

         <!-- RUANGAN -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Ruangan:</strong>
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
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Waktu Mulai:</strong>
               <input type="Time" value="{{ $event->waktu_mulai }}" name="waktu_mulai" class="form-control" placeholder="Waktu Mulai" min="10:00" max="01:30">
            </div>
         </div>

         <!-- WAKTU SELESAI -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Waktu Selesai:</strong>
               <input type="Time" value="{{ $event->waktu_akhir }}" name="waktu_akhir" class="form-control" placeholder="Waktu Selesai" min="10:00" max="01:30">
            </div>
         </div>

         <!-- KONTAK -->
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Kontak:</strong>
               <input type="text" value="{{ $event->kontak }}" name="kontak" class="form-control" placeholder="Kontak">
            </div>
         </div>
        
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Tipe Reservasi</strong>
               <select class="form-control" name="tipe_reservasi">
               <option {{ $event->tipe_reservasi == 'non-private' ?'selected':'' }} value="non-private"> Non-private </option>
               <option {{ $event->tipe_reservasi == 'private' ?'selected':'' }} value="private"> Private </option>
               </select>
               @error('event_type')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
               @enderror
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="d-flex form-group justify-content-between">
               <strong class="mt-2" style='width: 200px'>Status:</strong>
               <select class="form-control" name="status">
               <option {{ $event->status_reservasi == 'On-Going' ?'selected':'' }} value="On-Going"> On-Going </option>
               <option {{ $event->status_reservasi == 'Pending' ?'selected':'' }} value="Pending"> Pending </option>
               <option {{ $event->status_reservasi == 'Completed' ?'selected':'' }} value="Completed"> Completed </option>
               </select>
               @error('event_type')
               <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
               @enderror
            </div>
         </div>

         @if ($errors->any())
            <div class="text-danger">
               <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
               </ul>
            </div>
         @endif

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