<?php


namespace App\Classes;


use App\Classes\Request;
use App\Middleware\Middleware;
use Jenssegers\Blade\Blade;
use ReflectionMethod;
use App\Classes\Route;
use App\Classes\Helper;



/**
 * Class App
 * @package App\Classes
 */

class App{
    static $index;

    public function start()
    {
            Helper::load();
            require_once realpath('.')."/router/route.php";
            Route::end();
            self::$index = new static();
    }

    protected function render($file,$arr){
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
    public static function call(Request $request,$controller,$function,$args){
        $reflection = new ReflectionMethod($controller,$function);
        $params = $reflection->getParameters();
        $array = [];
        foreach($params as $param){
            if($param->getClass()){
                $array['class'] = $param->getClass()->getName();
            }else{
                $array[] = $param->getName();
            }
        }
        $result = [];
        extract($args);
        foreach($array as $key=>$el){
            if($key=='class' && $el == Request::class){
                $result[] = $request;
            }else {
                $result[$el] = $args[$el];
            }
        }
        call_user_func_array(array(new $controller, $function), $result);
    }
}