<?php

include "Crud.php";
include "authenticator.php";
include_once "DBconnector.php";
include_once "fileUploader.php";
class user implements Crud,Authenticator{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    private $username;
    private $password;
    private $profileImage;
   

    

    function __construct($first_name,$last_name,$city_name,$username,$password,$profileImage){
        $this->first_name=$first_name;
        $this->last_name=$last_name;
        $this->city_name=$city_name;
        $this->username=$username;
        $this->password=$password;
        $this->profileImage=$profileImage;
    }

    
    public static function create(){
        $instance = new self($first_name, $last_name, $city_name, $username, $password,$profileImage);
        return $instance;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setUserId ($user_id){
        $this->user_id = $user_id;
    }

    public function getUserId (){
        return $this->user_id;
    }

    public function setProfile($profileImage){
        $this->profileImage = $profileImage;
    }

    public function getProfile(){
        return $this->profileImage;
    }

    public function isUserExist(){
        $username = $this->username;
        $con = new DBConnector;
        $found = false;
        $res = mysqli_query($con->conn, "SELECT * FROM users") or die("Error: " .mysqli_error());

        while($row = mysqli_fetch_array($res)){
            if($row['username'] == $username){
                $found = true;
            }
        }

        $con->closeDatabase();
        return $found;
    }
   

    public function save(){
        $con= new DBconnector();
        $fn=$this->first_name;
        $ln=$this->last_name;
        $cn=$this->city_name;
        $uname = $this->username;
        $this->hashedPassword();
        $pass = $this->password;
        $filename = $this->profileImage;

        $res=mysqli_query($con->conn,"INSERT INTO users(firstname,lastname,user_city,username,user_password,mage) VALUES('$fn','$ln','$cn','$uname','$pass','$filename')") or die("Error:" . mysqli_connect_error());
        return $res;
    }
    public function isPasswordCorrect()
    {
        $con = new DBconnector;
        $found = false;
        $result = mysqli_query($con->conn,"SELECT * FROM users") or die("Error:" . mysqli_connect_error());
        while ($row = mysqli_fetch_array($result))
        {
            if (password_verify($this->getPassword(),$row['user_password'])&& $this->getUsername()==$row['username']){
                $found = true;
            }
        }
        $con->closeDatabase();
        return $found;  
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
    public function valiteForm(){
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;

        if($fn =="" || $ln=="" || $city==""){
            return false;
        }
        return true;
    }
    public function CreateFormErrorSessions(){
        session_start();
        $_SESSION['form_errors']="All Fields are required";
    }
    public function hashedPassword(){
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
    }
    

    public function login()
    {
        if($this->isPasswordCorrect()){
            header("Location:private_page.php");
        }
    }
    public function createUserSession(){
        session_start();
        $_SESSION['username'] = $this->getUsername();
    }
    public function logout()
    {
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:lab1.php");
    }


}