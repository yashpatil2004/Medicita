<?php
include ("databaseconn.php");

$query = "insert into semester (semester) values('".$_POST['semester']."')";
$result = mysqli_query($conn, $query);

if($result)
{
    echo true;
}
else
{
    echo false;
}
?>