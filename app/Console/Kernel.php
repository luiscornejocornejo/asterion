<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Webklex\IMAP\Commands\ImapIdleCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    { 
        // $schedule->command('inspire')->hourly();
        //$schedule->command('semanal:asignacion2')->cron('*/1 * * * *')->withoutOverlapping()->emailOutputOnFailure('kayser1712@gmail.com');
       // $schedule->command('semanal:asignaciong')->cron('*/1 * * * *')->withoutOverlapping()->emailOutputOnFailure('kayser1712@gmail.com');
        $schedule->command('semanal:asignaciontickets')->cron('*/1 * * * *')->withoutOverlapping()->emailOutputOnFailure('kayser1712@gmail.com');
       // $schedule->command('semanal:nodos')->daily()->emailOutputOnFailure('kayser1712@gmail.com');
       $schedule->command('semanal:nodoswispro')->daily()->emailOutputOnFailure('kayser1712@gmail.com');
       $schedule->command('semanal:napswispro')->daily()->emailOutputOnFailure('kayser1712@gmail.com');
       // $schedule->command('semanal:limpiezacloud')->daily()->emailOutputOnFailure('kayser1712@gmail.com');
       // $schedule->command('semanal:mailtickets')->cron('*/10 * * * *')->emailOutputOnFailure('kayser1712@gmail.com');
     //   $schedule->command('ma:mailtickets')->everyTwoMinutes()->sendOutputTo("scheduler-output.log");
  
        
        //$schedule->command('command:pp')->cron('*/1 * * * *')->emailOutputOnFailure('kayser1712@gmail.com');

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
