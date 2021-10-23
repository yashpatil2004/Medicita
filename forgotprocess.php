<?php
include("databaseconn.php");
include("sendmail.php");

$query = 'select * from user where email="'.$_POST['email'].'"';    
$email = $_POST['email'];
$exe = mysqli_query($conn,$query);

$rndno=rand(1000, 9999);
$sql = "update user set otp = '".$rndno."' where email = '".$_POST['email']."'";
$exl = mysqli_query($conn,$sql);

    $result = mysqli_fetch_assoc($exe);
    if($result)
    {          
        $message = urlencode("OTP-".$rndno);
        sendMail("$email","Test","$message");
        echo "true";
    }
    else
    {
       echo "false";
    }
?>