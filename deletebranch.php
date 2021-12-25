<?php
include "db.php";

$sql = "delete from Branch WHERE id = '".$_POST['id']."'";
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>