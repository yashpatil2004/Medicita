<?php
include "db.php";

$sql = "select * from managecollege where id = '".$_GET['id']."'";
$exe = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($exe);
if ($result)
{
    echo json_encode($result);
}
else
{
    echo false;
}
?>
