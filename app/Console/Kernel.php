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
            ->whereRaw("TIMESTAMP(tanggal_reservasi, waktu_akhir) < NOW()")
            ->where('status_reservasi', 'On-Going')
            ->where('tipe_reservasi', 'non-private')
            ->update(['status_reservasi' => 'Completed']);

        DB::table('events')
            ->where('tipe_reservasi', 'private')
            ->whereRaw("TIMESTAMP(tanggal_reservasi, waktu_akhir) < NOW()")
            ->where('status_reservasi', 'On-Going')
            ->where('tipe_reservasi', 'private')
            ->update(['status_reservasi' => 'Pending']);
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
