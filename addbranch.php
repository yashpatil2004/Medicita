<?php
include ("db.php");
$query = "insert into branch (branch, course_id) values('".$_POST['branch']."','".$_POST['course_id']."')";
$result = mysqli_query($conn, $query);
if($result){
    echo true;
}
else{
    echo false;
}
?>