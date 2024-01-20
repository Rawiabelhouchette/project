<?php

namespace App\Console;

use App\Models\Annonce;
use App\Models\StatistiqueAnnonce;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        try {
            $schedule->call(function () {
                Annonce::where('date_validite', '<', now())->update(['is_active' => false]);
            })
            // ;
            ->hourly();

            $schedule->call(function () {
                $this->updateAnnonceStat();
            })
            // ;
            ->daily();
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

    }
    
    private function updateAnnonceStat()
    {
        // update annonce stat
        $annonces = Annonce::all();
        foreach ($annonces as $annonce) {
            $nb_favoris = $annonce->favoris()->count();
            $nb_notation = $annonce->notation()->count();

            $stat = StatistiqueAnnonce::where('annonce_id', $annonce->id)->first();
            $stat->nb_favoris = $nb_favoris;
            $stat->nb_notation = $nb_notation;
            $stat->save();
        }
    }


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
