<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Home;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $home = new Home();
        $icons = [
            '<i class="fal fa-laptop"></i>',
            '<i class="fal fa-computer-speaker"></i>',
            '<i class="fal fa-tv-alt"></i>',
            '<i class="fal fa-memory"></i>',
            '<i class="fal fa-snowflake"></i>',
            '<i class="fal fa-headset"></i>',
            '<i class="fal fa-gamepad"></i>',
            '<i class="fal fa-volume"></i>',
            '<i class="fal fa-wifi"></i>',
            '<i class="fal fa-print"></i>'
        ];
        View::share('data', [
            "parentCategories" => $home->getCategories(),
            "icons" => $icons,
            "subCategories" => $home->getSubCategories(),
        ]);
    }
}
