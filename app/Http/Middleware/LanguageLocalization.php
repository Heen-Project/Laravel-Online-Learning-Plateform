<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\CookieJar;
use Closure;

class LanguageLocalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!\Session::has('locale'))
        {
           \Session::put('locale', \Config::get('app.locale'));
        }
        // if(\Cookie::has('country'))
        // {
        //     if (!\Cookie::has('checkCountry')){
        //         if (\Cookie::has('country')=='Indonesia'){
        //             \Session::put('locale', 'id');
        //             //Cookie::make('name', 'value', $minutes)
        //             Cookie::make('countryCheck', true, 60);
        //         }
        //     }           
        // }
        
        app()->setLocale(\Session::get('locale'));
        
        return $next($request);
    }
}
