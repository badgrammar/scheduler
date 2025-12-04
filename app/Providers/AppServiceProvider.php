<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('tanggal', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY'); ?>";
        });

        Blade::directive('tanggaljam', function ($expression){
            return "<?php echo \Carbon\Carbon::parse($expression)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY [at] HH:mm'); ?>";
        });

        Blade::directive('namahari', function ($expression){
            return "<?php echo \Carbon\Carbon::parse($expression)->locale('id_ID')->isoFormat('dddd'); ?>";
        });

        Blade::directive('hari', function ($expression){
            return "<?php echo \Carbon\Carbon::parse($expression)->locale('id_ID')->isoFormat('D'); ?>";
        });

        Blade::directive('bulan', function ($expression){
            return "<?php echo \Carbon\Carbon::parse($expression)->locale('id_ID')->isoFormat('MMMM'); ?>";
        });

        Blade::directive('tahun', function ($expression){
            return "<?php echo \Carbon\Carbon::parse($expression)->locale('id_ID')->isoFormat('YYYY'); ?>";
        });
    }
}
