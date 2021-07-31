<?php

namespace App\Middleware;

use Closure;

/**
 * 
 */
class Bir implements MiddlewareInterface{
        
    /**
     * handle
     *
     * @param  mixed $next
     * @param  mixed $request
     * @return void
     */
    function handle(Closure $next,$request){
        // return false;
        // echo "sa";
        return $next($request);
    }
}