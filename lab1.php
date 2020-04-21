<?php
include_once 'DBconnector.php';
include_once 'user.php';
$con = new DBconnector;

if(isset($_POST['btn-save'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $city=$_POST['city_name'];


    $user = new user($first_name,$last_name,$city);
    $res=$user->save();


    if($res){
        $con->closeDatabase();
        echo "Save Operation was Successful";
    }
    else
    {
        echo "An Error Occured";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title Goes Here</title>
</head>
<body>
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
    <table>
    <tr>
    <td><input type="text"name="first_name"required placeholder="First Name"></td>
    </tr>
    
    <tr>
    <td><input type="text"name="last_name"required placeholder="Last Name"></td>
    </tr>
    
    <tr>
    <td><input type="text"name="city_name"required placeholder="City"></td>
    </tr>

    <tr>
    <td><button type="submit"name="btn-save"><strong>SAVE</strong></button></td>
    </tr>
    
    </table>
    </form>
</body>
</html>