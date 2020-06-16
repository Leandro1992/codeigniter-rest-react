<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;
class SetLanguage
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
        // dd($request);
        \App::setlocale($request->lang);
        
        return $next($request);
    }
}
