<?php
include ("db.php");
$query = "insert into managecollege (college_name, administrator_name, course_id, email, password, address) values('".$_POST['college_name']."', '".$_POST['administrator_name']."', '".$_POST['course_id']."', '".$_POST['email']."', '".$_POST['password']."', '".$_POST['address']."')";
$result = mysqli_query($conn, $query);
if($result){
    echo true;
}
else{
    echo false;
}
?>