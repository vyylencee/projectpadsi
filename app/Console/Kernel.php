<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    $schedule->call(function () {
        \DB::table('events')
        ->where('tipe_reservasi', 'non-private')
        ->whereRaw("TIMESTAMP(tanggal_reservasi, waktu_akhir) < NOW()")
        ->where('status', 'On-Going')
        ->update(['status' => 'Completed']);
        
            $completedEvents = \DB::table('events')
            ->where('status', 'Completed')
            ->get();

            foreach ($completedEvents as $event) {

            $exists = \DB::table('reports')
                ->where('id_reservasi', $event->id)
                ->exists();

            if (!$exists) {
                \DB::table('reports')->insert([
                        'id_reservasi'     => $event->id,
                        'id_order'           => $event->id_order ?? '-',
                        'tanggal_reservasi'  => $event->tanggal_reservasi,
                        'ruangan'            => $event->ruangan,
                        'waktu_mulai'        => $event->waktu_mulai,
                        'waktu_akhir'        => $event->waktu_akhir,
                        'tipe_reservasi'     => $event->tipe_reservasi,
                        'status'             => 'Completed',
                        'payment_status'     => $event->payment_status ?? '-',
                    ]);
            }
        }

        \DB::table('events')
            ->where('tipe_reservasi', 'private')
            ->whereRaw("TIMESTAMP(tanggal_reservasi, waktu_akhir) < NOW()")
            ->where('status', 'On-Going')
            ->update(['status' => 'Pending']);


        
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

}
