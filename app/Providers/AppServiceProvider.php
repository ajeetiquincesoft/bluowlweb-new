<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

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
    {;
        view()->composer('*', function ($view) {

            if (Auth::user()) {
                $user_id = Auth::user()->id;
                $notifications = Notification::where('user_id', '=', $user_id)->where('status', '=', '0')->latest()->take(20)->get();

                // $notifications= array();
                $unread = Notification::where('user_id', '=', $user_id)->where('status', '=', '0')->count();
            } else {
                $notifications = array();
                $unread = "0";
            }

            $view->with(compact('notifications', 'unread'));
        });
    }
}
