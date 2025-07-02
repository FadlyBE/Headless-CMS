<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasSession()) {
            $locale = session('locale', config('app.locale'));
            App::setLocale($locale);
    
            Log::info('Locale set to: ' . $locale);
        }
    
        return $next($request);
    }
}

