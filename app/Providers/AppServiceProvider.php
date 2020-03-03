<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $article = \App\Article::where('created_at', '>', \Carbon\Carbon::now()->subDay(7))->orderBy('viewCount', 'desc')->take(5)->get();
        view()->share('articlePopular', $article);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
