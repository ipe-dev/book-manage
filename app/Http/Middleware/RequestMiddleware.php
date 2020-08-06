<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class RequestMiddleware
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

        // クッキーにアクセスしたURLを入れる
    //     $url = $request->url(); 
    //     if( !Auth::check() ) {

    //         Cookie::queue('url',$url,100);
    //     } else {

    //         Cookie::queue('url',null,100);
    //    }

        return $next($request);
    }
}
