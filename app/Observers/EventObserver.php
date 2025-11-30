<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Report;

class EventObserver
{
    public function updated(Event $event)
    {
        if ($event->wasChanged('status') && $event->status === 'Completed') {
            $exists = Report::where('id_reservasi', $event->id)->exists();

            if (!$exists) {
                Report::create([
                    'id_reservasi'      => $event->id,
                    'id_order'          => $event->id_order ?? '-',
                    'tanggal_reservasi' => $event->tanggal_reservasi,
                    'ruangan'           => $event->ruangan,
                    'waktu_mulai'       => $event->waktu_mulai,
                    'waktu_akhir'       => $event->waktu_akhir,
                    'tipe_reservasi'    => $event->tipe_reservasi,
                    'status'            => 'Completed',
                    'payment_status'    => $event->payment_status,
                ]);
            }
        }
    }
}