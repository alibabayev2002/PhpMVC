<?php

namespace App\Middleware;

use Closure;

/**
 * 
 */
class Iki implements MiddlewareInterface{
        
    /**
     * handle
     *
     * @param  mixed $next
     * @param  mixed $request
     * @return void
     */
    function handle(Closure $next,$request){
        // print_r($request);
        // echo "sa";

        return $next($request);
    }
}