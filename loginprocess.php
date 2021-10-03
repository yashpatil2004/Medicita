<?php
include("databaseconn.php");

 $query = 'select * from user where email="'.$_POST['email'].'" and password="'.$_POST['password'].'"';    
    
    $exe = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($exe);
    if($result)
    {
        session_start();
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['login'] = 1;
        echo "true";
    }
    else
    { 
       echo "false";
    }
?>
