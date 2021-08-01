<?php

require "vendor/autoload.php";


use App\Classes\Helper;
use App\Classes\Route;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// use App\Models\Model;
use App\Models\User;

use App\Classes\App;



$app = (new App())->start();







