<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use View;
use App\Models\Admin;
use App\Models\Custom;
use Carbon\Carbon;

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
        //
        Carbon::setUTF8(true);
    Carbon::setLocale(config('app.locale'));
    setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
        View::composer('layouts.plantilla', function( $view ){
                $type = Admin::where('id_user', Auth::user()->id)->get()->last();
                $bg = Custom::where('id_user', 3)->get()->last();
                $view->with( 'bg', $bg);
        });
    }
}
