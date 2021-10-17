<?php
include("databaseconn.php");
include("sendmail.php");

 $query = 'select * from user where email="'.$_POST['email'].'"';    
    
    $exe = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($exe);
    if($result)
    {
        sendMail("jp0027006@gmail.com","Test","Testing email");
        echo "true";
    }
    else
    { 
       echo "false";
    }
?>