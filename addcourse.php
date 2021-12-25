<?php
include ("db.php");
$query = "insert into course (name) values('".$_POST['name']."')";
$result = mysqli_query($conn, $query);
if($result){
    echo true;
}
else{
    echo false;
}
?>