<?php

use App\Classes\Route;

function str_ireplace_array($search, array $replace, $subject)
{
    if (0 === $tokenc = substr_count(strtolower($subject), strtolower($search))) {
        return $subject;
    }
    $string  = '';
    if (count($replace) >= $tokenc) {
        $replace = array_slice($replace, 0, $tokenc);
        $tokenc += 1; 
    } else {
        $tokenc = count($replace) + 1;
    }
    foreach(preg_split('/'.preg_quote($search, '/').'/i', $subject, $tokenc) as $part) {
        $string .= $part.array_shift($replace);
    }
    return $string;
}
function route($name,$arr = [])  {
    $route = Route::$names[$name];
    if($arr !== []){
        $test = (preg_replace('/{([a-zA-Z0-9]+)}/','$-$',$route));
        $result = str_ireplace_array('$-$',$arr, $test);
    }else{
        $result = $route;
    }
    return $result;
}
function asset($name){
    return "assets"."/".$name;
}

