<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Report;
use App\Models\UploadedFile;

class FileUploadController extends Controller
{
    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt|max:2048',
    ]);

    $path = $request->file('file')->store('uploads/reservasi');


    $uploaded = UploadedFile::create([
        'file_name' => $request->file('file')->getClientOriginalName(),
        'file_path' => $path,
        'status' => 'pending',
    ]);

    $this->processCsv(storage_path('app/' . $path));

    $uploaded->update(['status' => 'Completed']);

    return back()->with('success', 'CSV berhasil diupload.');
}

private function processCsv($filePath)
{
    $csv = array_map('str_getcsv', file($filePath));
    $header = array_shift($csv);

    foreach ($csv as $row) {
        $data = array_combine($header, $row);

        $reservation = Event::where('id', $data['id'])
            ->first();


        if ($reservation) {
            $reservation->update([
                'id_order' => $data['id_order'] ?? null,
                'minimum_order' => $data['minimum_order'] ?? null,
                'total_payment' => $data['total_payment'] ?? null,
                'payment_status' => $data['payment_status'] ?? null,
                'status' => 'Completed',
            ]);
            $exists = Report::where('id_reservasi', $reservation->id)->exists();

            if (!$exists && $reservation->status === 'Completed') {
                Report::create([
                    'id_reservasi'      => $reservation->id,
                    'id_order'          => $reservation->id_order,
                    'tanggal_reservasi' => $reservation->tanggal_reservasi,
                    'ruangan'           => $reservation->ruangan,
                    'waktu_mulai'       => $reservation->waktu_mulai,
                    'waktu_akhir'       => $reservation->waktu_akhir,
                    'tipe_reservasi'    => $reservation->tipe_reservasi ?? 'private',
                    'status'            => 'Completed',
                    'payment_status'    => $reservation->payment_status,
                ]);
            }

        }
        }
    }
}


