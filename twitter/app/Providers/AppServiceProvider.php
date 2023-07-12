<?php

namespace App\Providers;

use App\Models\Tweet;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\View;
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
    public function boot(UrlGenerator $url)
    {
        /**
         * ログインしているユーザー情報をheader.blade.phpに渡す。
         */

        View::composer('components.header', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $view->with('userInfo', $user);
            }
        });
    }
}
