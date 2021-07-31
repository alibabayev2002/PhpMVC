<?php

namespace App\Controller;

use App\Classes\Request;
use ReflectionMethod;

use Jenssegers\Blade\Blade;



/**
 * Controller
 */

class Controller{
        
    /**
     * render
     *
     * @param  mixed $file
     * @param  mixed $arr
     * @return void
     */

    public function render($file,$arr){
        $blade = new Blade('resources/views', 'resources/cache');
        echo $blade->make($file, $arr)->render();
    }
        
    /**
     * call
     *
     * @param  mixed $request
     * @param  mixed $controller
     * @param  mixed $function
     * @return void
     */
    public static function call(Request $request,$controller,$function,$args){
        // echo "sa";
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
        // print_r($result);
        // echo "sasaa";
        // echo $controller." $function";
        call_user_func_array(array(new $controller, $function), $result);
    }
}