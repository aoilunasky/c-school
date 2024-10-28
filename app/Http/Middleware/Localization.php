<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle($request, Closure $next)
    {

        $locale = Session::get('locale') ?? 'en';
        Session::put('locale', $locale);
        App::setlocale($locale);
        // if (session()->has('locale')) { // Correct session helper
        //     App::setLocale(session()->get('locale'));
        // }

        return $next($request);
    }
}
