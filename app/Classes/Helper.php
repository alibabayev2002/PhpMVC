<?php

namespace App\Classes;

class Helper{



    public static function load(){
        if($dh = opendir(realpath('.') . '/app/helpers' )){
            while ($file = readdir($dh) ){
                if(is_file(realpath('.') . '/app/helpers/'.$file )){
                    require realpath('.') . '/app/helpers/'.$file;
                }
            }
        }
    }
}