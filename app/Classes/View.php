<?php


namespace App\Classes;

class View{

    // private $path;


    public static function render($file,$arr){

        $path = realpath('.')."/app/views";
        if(is_file($path."/".$file.".php")){
            extract($arr);
            require $path."/".$file.".php";
        }
    }
}