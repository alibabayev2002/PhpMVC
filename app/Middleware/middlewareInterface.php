<?php 

namespace App\Middleware;
use Closure;



interface MiddlewareInterface{
        
    /**
     * handle
     *
     * @param  mixed $next
     * @param  mixed $request
     * @return void
     */
    function handle(Closure $next,$request);
}