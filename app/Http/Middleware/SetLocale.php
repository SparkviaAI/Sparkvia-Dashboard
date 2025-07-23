<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle($request, Closure $next)
    // {
    //     if (request('change_language')) {
    //         session()->put('language', request('change_language'));
    //         $language = request('change_language');
    //     } elseif (session('language')) {
    //         $language = session('language');
    //     }

    //     $language = $language ?? getDefaultLocale();
    //     app()->setLocale($language);

    //     URL::defaults(['locale' => $language]);
    //     return $next($request);
    // }
    public function handle($request, Closure $next)
    {
        if (Session::has('language')) {
            App::setLocale(Session::get('language'));
        }

        return $next($request);
    }
}


