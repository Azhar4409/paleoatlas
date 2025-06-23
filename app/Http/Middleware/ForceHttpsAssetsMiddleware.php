<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttpsAssetsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (
            $response instanceof \Illuminate\Http\Response &&
            str_contains($response->headers->get('Content-Type'), 'text/html')
        ) {
            $content = $response->getContent();

            // Replace http asset URLs with https
            $content = str_replace(
                'http://paleoatlas-production.up.railway.app/',
                'https://paleoatlas-production.up.railway.app/',
                $content
            );

            $response->setContent($content);
        }

        return $response;
    }
}