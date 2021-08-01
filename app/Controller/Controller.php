<?php

namespace App\Controller;

use App\Classes\App;
use App\Classes\Request;
use ReflectionMethod;





/**
 * Controller
 */

class Controller extends App{
        
    /**
     * render
     *
     * @param  mixed $file
     * @param  mixed $arr
     * @return void
     */

   
        
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
        // echo "sa";
        // print_r($args);
        // die();
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