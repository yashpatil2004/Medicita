<?php
include("databaseconn.php");

    $query = 'select * from user where email="'.$_POST['val-email'].'"';    
    
    $exe = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($exe);
    if($result)
    {
        echo "---".$result['val-email'];
        session_start();
        $_SESSION['val-email'] = $final['val-email'];
        $_SESSION['login'] = 1;
        header('location: ../otp.php');
    }
    else
    { 
        header('location: ‪../forgotpassword.php?err=1');
    }
?>