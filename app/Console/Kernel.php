<?php

namespace App\Console;

use App\Console\Commands\RetrieveGithUsers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

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
        // Entrada no Schedule para executar o comando criado e ja ativar um Trabalhador de Fila para executar 1 job na fila
        $schedule->command(RetrieveGithUsers::class)
                 ->everyMinute()
                 ->after(function() {
                     Artisan::call('queue:work redis --once --tries=1');
                 });
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
