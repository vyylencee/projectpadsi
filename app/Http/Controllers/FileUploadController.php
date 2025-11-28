<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\UploadedFile;

class FileUploadController extends Controller
{
    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt|max:2048',
    ]);

    // Simpan file ke storage
    $path = $request->file('file')->store('uploads/reservasi');

    // Catat ke database
    $uploaded = UploadedFile::create([
        'file_name' => $request->file('file')->getClientOriginalName(),
        'file_path' => $path,
        'status' => 'pending',
    ]);

    // Proses isi CSV
    $this->processCsv(storage_path('app/' . $path));

    // Update status file
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
            ->where('status', 'Pending')
            ->first();

        if ($reservation) {
            $reservation->update([
                'id_order' => $data['id_order'] ?? null,
                'minimum_order' => $data['minimum_order'] ?? null,
                'total_payment' => $data['total_payment'] ?? null,
                'payment_status' => $data['payment_status'] ?? null,
                'status' => 'Completed',
            ]);
        }

    }
}



}
