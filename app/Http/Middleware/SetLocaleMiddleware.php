<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $segmant = !empty($request->segments()) ? $request->segments()[0] : null;
        $locale = $segmant ?? 'en';


        if (!in_array($locale, ['ku', 'ar', 'en']) && Route::current()?->parameter('locale') !== null) {
            return abort(404);
        }
        if (in_array($locale, ['ku', 'ar', 'en'])) {
            app()->setLocale($locale);
        }
        //URL::forceScheme('https');
        URL::defaults(['locale' => $locale]);
        return $next($request);
    }
}
