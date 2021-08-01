<?php


namespace App\Classes;


use App\Classes\Request;

use App\Middleware\Middleware;
use Jenssegers\Blade\Blade;

/**
 * Class App
 * @package App\Classes
 */

class App{
    public function render($file,$arr){
        $blade = new Blade('resources/views', 'resources/cache');
        echo $blade->make($file, $arr)->render();
    }
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