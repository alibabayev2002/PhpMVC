<?php

require "vendor/autoload.php";


use App\Classes\Helper;
use App\Classes\Route;

// use App\Models\Model;
use App\Models\User;

Helper::load();


// $model = new Model();

// $user = new User();

// echo "sa";
// print_r(  $user->find(1)  );

// print_r(   $user->where('name','=','faiq')->first()   );

// $model = new Model();


// echo "sa";
// use App\Classes\App;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// // $app = new App();
// // $app->index();



// // Route::start();




require "router/route.php";

Route::end();

