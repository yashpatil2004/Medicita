<?php
include "databaseconn.php";


$query = "update semester set semester = '".$_POST['semester']."' where id = '".$_POST['id']."'";
$result = mysqli_query($conn, $query);

if ($conn->query($query) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>