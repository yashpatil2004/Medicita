<?php
include "databaseconn.php";

$sql = "delete from faculty WHERE id = '".$_POST['id']."'";
$exe = mysqli_query($conn,$sql);

if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>