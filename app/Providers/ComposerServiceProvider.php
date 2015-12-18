<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('america/new_york');
        # Make the variable "user" available to all views
        \View::composer('*', function($view) {
            $user = \Auth::user();
            $access = false;
            if(!is_null($user)){
                $access = str_contains($user->user_role, 'admin');
            }
            $view->with('user', $user)->with('access', $access);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
