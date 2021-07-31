<?php


namespace App\Classes;


use App\Classes\Request;

use App\Middleware\Middleware;

/**
 * Class App
 * @package App\Classes
 */

class App{

    static function callMiddleware($arr){
        $request = new Request();
        require realpath('.')."/app/configs/kernel.php";
        foreach($arr as $item){
            $middlewares[] = $titles[$item];
        }
        foreach($middlewares as $middleware){
            if($request instanceof Request){
                $request = Middleware::call(new $middleware,function($req){
                    return $req;
                },$request);
            }else{
                break;
            }
        }
        return ($request);
    }
}