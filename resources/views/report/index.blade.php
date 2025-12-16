@extends('main')
@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container-fluid mt-2">
    <div class="pull-left mb-4">
         <h2>Kelola Laporan</h2>
        </div>
        
        <div class="d-flex justify-content-end mb-3">
            <button 
            type="button"
            id="filterBtn"
            class="btn align-items-center px-3 py-2 mr-2"
            style="background-color: #FFFFFF; border-radius: 50px; font-family: 'Fredoka', sans-serif; font-size: 14px; font-weight: semi-bold;">
            <i class="bi bi-funnel mr-2"></i> Filter
                    <select id="bulanSelect" class="form-select ml-2" style="width:auto;">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ sprintf('%02d',$i) }}" 
                                {{ request('bulan', date('m')) == sprintf('%02d',$i) ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
        
                    <select id="tahunSelect" class="form-select" style="width:auto;">
                        @foreach(range(date('Y'), date('Y')-10) as $y)
                            <option value="{{ $y }}" {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
            </button>

            

            <a 
               onclick="forceDownloadPDF()"               
               download
               class="btn  align-items-center px-3 py-2"
               style="background-color: #FFFFFF; border-radius: 50px; font-family: 'Fredoka', sans-serif; font-size: 14px; font-weight: semi-bold;">
               
               <i class="bi bi-file-earmark-arrow-down mr-2"></i> 
               Unduh Laporan Bulanan
            </a>
        </div>    
        

    <table class="table table-bordered text-center" style="background-color: #FFFFFF; font-family: 'Fredoka', sans-serif; font-size: 14px;">
        <tr>
            <th>ID Laporan</th>
            <th>ID Reservasi</th>
            <th>ID Order</th>
            <th>Tanggal Reservasi</th>
            <th>Ruangan</th>
            <th>Waktu Mulai</th>
            <th>Waktu Berakhir</th>
            <th>Tipe Reservasi</th>
            <th>Status</th>
            <th>Status Pembayaran</th>
        </tr>

        @foreach ($reports as $report)
        <tr>
            <td>{{ $report->idRep_format ?? '-' }}</td>
            <td>{{ $report->id_reservasi ?? '-' }}</td>
            <td>{{ $report->id_order }}</td>
            <td>{{ $report->tanggal_reservasi ?? '-'}}</td>
            <td>{{ $report->ruangan_nama ?? '-'}}</td>
            <td>{{ $report->waktu_mulai ?? '-'}}</td>
            <td>{{ $report->waktu_akhir ?? '-'}}</td>
            <td>{{ $report->tipe_reservasi ?? '-'}}</td>
            <td>{{ $report->status ?? '-'}}</td>
            <td>{{ $report->payment_status ?? '-'}}</td>
        </tr>
        @endforeach
    </table>
</div>

<script>
document.getElementById('bulanSelect').addEventListener('change', filterLaporan);
document.getElementById('tahunSelect').addEventListener('change', filterLaporan);

function filterLaporan() {
    const bulan = document.getElementById('bulanSelect').value;
    const tahun = document.getElementById('tahunSelect').value;
    window.location.href = `/report?bulan=${bulan}&tahun=${tahun}`;
}

function forceDownloadPDF() {
    const url = "{{ route('report.pdf', ['bulan' => request('bulan', date('m')), 'tahun' => request('tahun', date('Y'))]) }}";
    const link = document.createElement('a');
    link.href = url;
    link.download = "Laporan_SIRFU_{{ $namaBulan }}_{{ $tahun }}.pdf";
    link.target = '_blank';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>


@endsection