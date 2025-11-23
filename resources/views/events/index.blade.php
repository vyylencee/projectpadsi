@extends('dashboard')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function(){
    $('#search').on('keyup', function(){
        let query = $(this).val();

        $.ajax({
            url: "{{ route('events.search') }}",
            type: "GET",
            data: { search: query },
            success: function(data){
                $('#table-data').html(data);
            },
            error: function(xhr){
                console.log("Terjadi error: ", xhr.responseText);
            }
        });
    });
});
</script>

<div class="container mt-2">
<div class="row">
   <div class="col-lg-12 margin-tb">
      <div class="pull-left mb-4">
         <h2>Kelola Reservasi</h2>
      </div>
      <div class='d-flex justify-content-between'>
         <div class="mb-2">
            <input type="text" id="search" name="search" class='form=control px-3 py-2' placeholder="Cari...">
         </div>

         <div class="mb-2">
            <button 
               type="button"
               id="uploadBtn"
               class="btn align-items-center px-3 py-2"
               style="background-color: #FFFFFF; border-radius: 50px; font-family: 'Fredoka', sans-serif; font-size: 14px; font-weight: semi-bold;">
                  <i class="bi bi-upload mr-2"></i> Upload File
            </button>

            <input type="file" id="csvFile" accept=".csv" class="d-none">

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
</div>
@if($message = Session::get('success'))
<div class="alert alert-success">
   <p>{{ $message }}</p>
</div>
@endif
<table id="table-data" class="mt-3 table table-bordered text-center" style="background-color: #FFFFFF; font-family: 'Fredoka', sans-serif; font-size: 14px;">
   <tr>
      <th>ID Reservasi</th>
      <th>Tanggal Reservasi</th>
      <th>Ruangan</th>
      <th>Waktu Mulai</th>
      <th>Waktu Berakhir</th>
      <th>Status</th>
      <th>Aksi</th>
   </tr>
   @foreach ($events as $event)
   <tr>
      <td>{{ $event->id }}</td>
      <td>{{ $event->tanggal_reservasi }}</td>
      <td>{{ $event->ruangan_nama }}</td>
      <td>{{ $event->waktu_mulai }}</td>
      <td>{{ $event->waktu_akhir }}</td>
      <td>
         <span class="px-2 py-1" 
               style="border-radius:5px; background-color:
                  {{ $event->status_reservasi == 'Pending' ? '#ffde21' :
                     ($event->status_reservasi == 'On-Going' ? '#0082FC' :
                     ($event->status_reservasi == 'Completed' ? '#4ade80' : '#6B7280')) }}; 
                     color: {{($event->status_reservasi == 'On-Going' ? '#ffffff' : '#000000')}}" >
            {{ $event->status_reservasi }}
         </span>
      </td>
      <td>
         <form action="{{ route('events.destroy',$event->id) }}" method="POST">
            <a class="btn" style="background-color: #0082FC; color: #ffffff;"href="{{ route('events.show',$event->id) }}">Show</a>
            <a class="btn" style="background-color: #ffde21; color: #000000;" href="{{ route('events.edit',$event->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
         </form>
      </td>
   </tr>
   @endforeach
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $events->links('pagination::bootstrap-4') }}
</div>

<script>
document.getElementById("uploadBtn").addEventListener("click", function () {
    document.getElementById("csvFile").click();
});

document.getElementById("csvFile").addEventListener("change", function () {
    var modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
});
</script>

@endsection