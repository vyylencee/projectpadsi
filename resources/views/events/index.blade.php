@extends('dashboard')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container mt-2">
<div class="row">
   <div class="col-lg-12 margin-tb">
      <div class="pull-left mb-4">
         <h2>Kelola Reservasi</h2>
      </div>
      <div class=" mb-2">
         <a 
            href="{{ route('events.create') }}" 
            class="btn  align-items-center px-3 py-2"
            style="background-color: #FFFFFF; border-radius: 50px; font-family: 'Fredoka', sans-serif; font-size: 14px; font-weight: semi-bold;">
            <i class="bi bi-plus-circle mr-2"></i> 
            Tambah Reservasi
         </a>
      </div>
   </div>
</div>
@if($message = Session::get('success'))
<div class="alert alert-success">
   <p>{{ $message }}</p>
</div>
@endif
<table class="mt-3 table table-bordered text-center" style="background-color: #FFFFFF; font-family: 'Fredoka', sans-serif; font-size: 14px;">
   <tr>
      <th>ID Reservasi</th>
      <th>Tanggal Reservasi</th>
      <th>Ruangan</th>
      <th>Waktu Mulai</th>
      <th>Waktu Berakhir</th>
      <th>Aksi</th>
   </tr>
   @foreach ($events as $event)
   <tr>
      <td>{{ $event->id }}</td>
      <td>{{ $event->tanggal_reservasi }}</td>
      <td>{{ $event->ruangan }}</td>
      <td>{{ $event->waktu_mulai }}</td>
      <td>{{ $event->waktu_akhir }}</td>
      <td>
         <form action="{{ route('events.destroy',$event->id) }}" method="POST">
            <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
         </form>
      </td>
   </tr>
   @endforeach
</table>
{!! $events->links() !!}
@endsection