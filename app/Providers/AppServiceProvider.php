<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Sosmed;

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
        View::composer('*', function ($view) {
            $sosmeds = collect();
            if (session()->has('user_id')) {
                $userId = session('user_id');
                $sosmeds = Sosmed::where('user_id', $userId)->get();
            }
            $view->with('sosmeds', $sosmeds);
        });
    }
}
