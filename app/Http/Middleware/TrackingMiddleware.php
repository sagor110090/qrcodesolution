<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class TrackingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(env('APP_ENV') == 'local'){
            $ip = '49.35.41.195';
        }
        else{
            $ip = $request->ip();
        }

        $location = Location::get($ip);


        $request->merge([
            'ip_address' => $ip,
            'city' => $location->cityName,
            'country' => $location->countryName,
            'region' => $location->regionName,
            'zip_code' => $location->zipCode,
            'latitude' => $location->latitude,

        ]);


        return $next($request);
    }
}
