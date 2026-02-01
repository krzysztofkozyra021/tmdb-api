<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $rawLocale = $request->header("Accept-Language", "");

        $locale = substr($rawLocale, 0, 2);

        $supported = config("app.supported_locales");

        if (!in_array($locale, array_keys($supported), true)) {
            $locale = "en";
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
