<?php



namespace App\Controller;

use App\Classes\View;
use App\Classes\Request;


class home extends Controller{

    public function index(Request $request){
        // echo $request->ali;
        // echo "Saaa";
        return $this->render('home',[]);

    }
    public function test($user,Request $request){
        echo "burasi home sendeki $user";
        // print_r($user);
    }
}