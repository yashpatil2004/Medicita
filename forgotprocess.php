<?php
include("databaseconn.php");
include("sendmail.php");

$query = 'select * from user where email="'.$_POST['email'].'"';    
$email = $_POST['email'];
    $exe = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($exe);
    if($result)
    {
        $rndno=rand(1000, 9999);
        $message = urlencode("OTP-".$rndno);
        sendMail("$email","Test","$message");
        echo "true";
    }
    else
    {
       echo "false";
    }
?>