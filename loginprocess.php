<?php
include("db.php");

    $query = 'select * from user where email="'.$_POST['email'].'" and password="'.$_POST['password'].'"';    
    
    $exe = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($exe);
    if($result)
    {
        session_start();
        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['login'] = 1;
        
        if($result['user_type'] == "admin")
        {
            $_SESSION['user_type'] = $result['user_type'];
            echo 1;
        }
        elseif($result['user_type'] == "college administrator")
        {
            $_SESSION['user_type'] = $result['user_type'];
            echo 2;
        }
        elseif($result['user_type'] == "facuilty")
        {
            $_SESSION['user_type'] = $result['user_type'];
            echo 3;
        }
        elseif($result['user_type'] == "student")
        {
            $_SESSION['user_type'] = $result['user_type'];
            echo 4;
        }
    }
    else
    { 
       echo "false";
    }
?>
