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
        // Tambahkan kode ini di dalam fungsi boot
        if (env('VIEW_COMPILED_PATH')) {
            config(['view.compiled' => env('VIEW_COMPILED_PATH')]);
        }
    }
}
