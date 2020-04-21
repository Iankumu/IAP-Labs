<?php

include "Crud.php";
include_once "DBconnector.php";
class user implements Crud{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    

    function __construct($first_name,$last_name,$city_name){
        $this->first_name=$first_name;
        $this->last_name=$last_name;
        $this->city_name=$city_name;
    }
    public function setUserId($user_id){
        $this->user_id=$user_id;
    }

    public function getUserId(){
        return $this->$user_id;
    }

    public function save(){
        $fn=$this->first_name;
        $ln=$this->last_name;
        $cn=$this->city_name;

        $con = new DBconnector;

        $res=mysqli_query($con->conn,"INSERT INTO users(firstname,lastname,user_city) VALUES('$fn','$ln','$cn')") or die("Error:" . mysqli_connect_error());
        return $res;
    }

    public function readAll(){

        $con = new DBconnector;
        $result = mysqli_query($con->conn,"SELECT * FROM users") or die("Error:" . mysqli_connect_error());
        return $result;    
    }
    public function readUnique(){
        return null;
    }
    public function search(){
        return null;
    }
    public function update(){
        return null;
    }
    public function removeOne(){
        return null;
    }
    public function removeAll(){
        return null;
    }


}