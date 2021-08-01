<?php



namespace App\Controller;
use App\Classes\View;
use App\Classes\Request;


class home extends Controller{

    public function index(Request $request){
        return $this->render('home',[]);
    }
    public function test($user,Request $request){
        echo "burasi home sendeki $user";
    }
}