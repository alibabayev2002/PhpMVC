<?php


namespace App\middleware;

class Middleware{    
    /**
     * call
     *
     * @param  mixed $class
     * @param  mixed $next
     * @param  mixed $request
     * @return void
     */
    public static function call($class,$next,$request){
        //  print_r($request);
        //  echo "Sal";
        return call_user_func_array([new $class,"handle"],[$next,$request]);

    }
}