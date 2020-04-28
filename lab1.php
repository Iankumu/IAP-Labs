<?php
include_once 'DBconnector.php';
include_once 'user.php';
$con = new DBconnector;

if(isset($_POST['btn-save'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $city=$_POST['city_name'];
    $uname=$_POST['username'];
    $pass=$_POST['password'];


    $user = new user($first_name,$last_name,$city,$uname,$pass);
    if (!$user->valiteForm())
    {
            $user->CreateFormErrorSessions();
            header("Refresh:0");
            die();
    }
        $res = $user->save();
        
        if($res){
            echo "Save operation was successful";
            header("Location:login.php");
        }else{
            echo "An error occured!";
        }
        $con->closeDatabase();
    }
 

if(isset($_GET['view'])) { 
    $first_name=0;
    $last_name=0;
    $city=0;
    $uname=0;
    $pass = 0;

    $user = new User($first_name, $last_name, $city,$uname,$pass);
    $res = $user->readAll();
    
    echo "<!DOCTYPE html>
                <html>
                    <head>
                        <title>ReadAll</title>
                    </head>
                    <body>
                        <div>
                        <table align ='left'; border='1'>
    
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>City</th>
                                <th>Username</th>
                            </tr>

                            <tr>";		
                                    
                                    while ($row = $res->fetch_assoc()){
                                        $user_id = $row['id'];
                                        $first_name = $row['firstname'];
                                        $last_name = $row['lastname'];
                                        $city = $row['user_city'];
                                        $uname = $row['username'];
                                        

                                    echo "<tr>
                                    <td>".$user_id."</td>
                                    <td>".$first_name."</td>
                                    <td>".$last_name."</td>
                                    <td>".$city."</td>
                                    <td>".$uname."</td>
                                    
                                    </tr>";
                                    }
                                    
                    
                            echo "</tr>
                        </table>
                        </div>
                        <div>
                            <a href='lab1.php'>Back</a>
                        </div>
                    </body>
                </html>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>  
    <title>Title Goes Here</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
    <form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
    <div>
    <table align = "center">
    <tr>
    <td>
    <div id="form-errors">
    <?php 
    session_start();
    if (!empty($_SESSION['form_errors'])){
        echo " ".$_SESSION['form_errors'];
        unset($_SESSION['form_errors']);
    }
    ?>
    </div>
    </td>
    </tr>
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
    <td><input type="text"name="username"required placeholder="Username"></td>
    </tr>

    <tr>
    <td><input type="password"name="password"required placeholder="Password"></td>
    </tr>

    <tr>
    <td><button type="submit"name="btn-save"><strong>SAVE</strong></button></td>
    </tr>

    <tr>
    <td><a href="login.php">Login</a></td>
    </tr>

    <tr>
    <td> <a href='lab1.php?view=true'>View Records</a></td>
    </tr>

    </table>

    </div>

    </form>
</body>
</html>