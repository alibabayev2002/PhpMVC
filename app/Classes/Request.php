<?php

namespace App\Classes;

class Request{



    public function __get($name){
        if(!empty($_GET[$name])){
            return htmlspecialchars($_GET[$name]);
        }else{
            return !empty($_POST[$name]) ?? htmlspecialchars($_POST[$name]);
        }
    }
    
}