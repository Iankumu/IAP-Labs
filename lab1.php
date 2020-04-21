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
        
        echo "Save Operation was Successful";
        $close = $con->closeDatabase();
    }
    else
    {
        echo "An Error Occured";
    }
} 

if(isset($_GET['view'])) { 
    $first_name=0;
    $last_name=0;
    $city=0;

    $user = new User($first_name, $last_name, $city);
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
                            </tr>

                            <tr>";		
                                    
                                    while ($row = $res->fetch_assoc()){
                                        $user_id = $row['id'];
                                        $first_name = $row['firstname'];
                                        $last_name = $row['lastname'];
                                        $city = $row['user_city'];

                                    echo "<tr>
                                    <td>".$user_id."</td>
                                    <td>".$first_name."</td>
                                    <td>".$last_name."</td>
                                    <td>".$city."</td>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title Goes Here</title>
</head>
<body>
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
    <div>
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

    </div>

    <div>
    <a href='lab1.php?view=true'>View Records</a>
    </div>

    </form>
</body>
</html>