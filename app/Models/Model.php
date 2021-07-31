<?php

namespace App\Models;

use PDO;

use PDOException;

class Model{

    static $db;

    private $table;

    private $query;

    // static $instance;

    public function __construct()
    {
        if(!self::$db){
            try{
                self::$db = new PDO("mysql:host=localhost;dbname=oop;","root","root");
            } catch(PDOException $e){
               echo $e->getMessage()."<br><br>";
            }
        }
    }

    public function where($first = null,$operator = null,$val = null){
        $db = self::$db;
        $this->table = strtolower((new \ReflectionClass($this))->getShortName());
        $table = $this->table;
        $query = "SELECT * FROM `$table` WHERE `$first` $operator '$val'";
        $query = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        $this->query = $query;
        return $this;
    }
    public function find($id){
        $db = self::$db;
        $this->table = strtolower((new \ReflectionClass($this))->getShortName());
        $table = $this->table;
        $query = "SELECT * FROM `$table` WHERE `id` = '$id'";
        $query = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $query;
    }
    public function first(){
        return $this->query[0];
    }
    public function get(){
        return $this->query;
    }



}