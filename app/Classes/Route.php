<?php

namespace App\Classes;


use App\Classes\Request;
use App\Classes\App;
use App\Controller\Controller;
use ReflectionMethod;


/**
 * Class Route
 * @package App\Classes
 */

class Route{

    static $routes;

    static $names;

    static $currentUrl;

    static $url;

    static $middleware;


    /**
     * @return mixed
     */
    static function getUrl(){
        if(isset($_GET['url']))
            return trim($_GET['url'],'/');
        else
            return "";
    }

    /**
     * @param mixed $url
     * @param mixed $path
     * 
     * @return static
     */
    public static function get($url,$path) {
        $args = [];
        preg_match_all('/{([a-zA-Z0-9]+)}/',$url,$result);
        foreach($result[1] as $item){
            $args[$item] = null;
        }
        $arr = explode("@",$path);
        $controller = $arr[0];
        $function = $arr[1];
        self::$url = $url;
        $controller = "App\Controller\\".$controller;
        if(method_exists($controller,$function)){
            if(isset($args)){
                self::$routes[trim($url,"/")] = [$controller,$function,$args];
            }else{
                self::$routes[trim($url,"/")] = [$controller,$function,false];
            }
        }
        return new static();
    }

    /**
     * @param $name
     * @return false
     */

    public function name($name){

        self::$names[$name] = self::$url;
        return new static();
    }


        
    /**
     * middleware
     *
     * @param  mixed $data
     * @return Route
     */
    public function middleware($data){
        // echo "$name <br><pre>";
        // print_r(self::$routes);
        // echo "</pre>";
        // print_r(array_key_last(self::$routes));
        // die();
        if(is_array($data)){
            foreach($data as $name){
                self::$middleware[array_key_last(self::$routes)][] = $name;
            }
        }else{
            self::$middleware[array_key_last(self::$routes)][] = $data;
        }
        return new static();
    }
    /**
     * end
     *
     * @return void
     */

    public static function end(){
        // echo " <br><pre>";
        // print_r(self::$middleware);
        // echo "</pre>";
        // die();
        $args = [];
        $currentUrl = self::getUrl();
        global $routes;
        $routes = self::$routes;
        $bool = false;
        foreach (self::$routes as $url => $arr) {
            if($currentUrl == $url){
                $bool = true;
                $controller = $arr[0];
                $function = $arr[1];
                if(isset(self::$middleware[$currentUrl])){
                    $request = App::callMiddleware(self::$middleware[$currentUrl]);
                    if(!$request instanceof Request){
                        die();
                    }
                }else{
                    $request = new Request();
                }
            }
            else if(!$bool){
                preg_match_all('/{([a-zA-Z0-9]+)}/',$url,$result);
                    if(!empty($result[1])){
                        preg_match_all('/([a-zA-Z0-9-\/]+)/',$url,$newUrl);
                        $newUrl =  $newUrl[1][0];
                        if(empty(strpos($currentUrl,$newUrl))){
                            $subsUrl = substr($currentUrl,strpos($currentUrl,$newUrl)+strlen($newUrl),strlen(($currentUrl)));
                            $elements = explode("/",$subsUrl);
                            $i = 0;
                            $str = $url;
                            foreach($arr[2] as $key=>$val){
                                if(isset($elements[$i])){
                                    $args[$key] = $elements[$i];   
                                    $str = str_replace("{".$key."}",$elements[$i],$str);
                                    $i++;
                                }
                            }
                            if($currentUrl == $str){
                                $controller = $arr[0];
                                $function = $arr[1];
                                if(isset(self::$middleware[$url])){
                                    $request = App::callMiddleware(self::$middleware[$url]);
                                    if(!$request instanceof Request){
                                        die();
                                    }
                                }else{
                                    $request = new Request();
                                }
                            }else{
                                echo "404 not found!";
                            }
                        }
                    }
            }
        }
        // print_r($function);
        if(isset($request) && isset($controller) && isset($function)){
            Controller::call($request,$controller,$function,$args);
        }
    }
    public static function all() {

        print_r(self::$routes);
    }
}