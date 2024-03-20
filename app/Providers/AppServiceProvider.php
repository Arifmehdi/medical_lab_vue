<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        try {

            // $generalSettings = DB::table('general_settings')->first();
            // $addons = DB::table('addons')->first();
            // if (isset($generalSettings) && isset($addons)) {
            //     $dateFormat = json_decode($generalSettings->business, true)['date_format'];
            //     $__date_format = str_replace('-', '/', $dateFormat);
            //     view()->share('generalSettings', $generalSettings);
            //     view()->share('addons', $addons);
            //     view()->share('__date_format', $__date_format);
        // }
        $languages=\App\Models\Language::select('iso')->where('active',true)->get();
        view()->share('languages', $languages);

        } catch (Exception $e) {
            // echo $e->getMessage() . PHP_EOL;
        }
    }
}
