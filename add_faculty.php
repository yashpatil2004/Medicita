<?php
include "databaseconn.php";

$query = "insert into faculty (first_name, last_name, email, branch, college, education, mobile_number, address) values ('".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."','".$_POST['branch']."','".$_POST['college']."', '".$_POST['education']."','".$_POST['mobile_number']."', '".$_POST['address']."')";
$result = mysqli_query($conn, $query);

if($result){
    echo true;
}
else{
    echo false;
}
?>