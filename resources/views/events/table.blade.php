<table class="mt-3 table table-bordered text-center" style="background-color: #FFFFFF; font-family: 'Fredoka', sans-serif; font-size: 14px;">
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


