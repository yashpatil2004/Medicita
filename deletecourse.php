<?php
include "db.php";

$sql = "delete from course WHERE id = '".$_POST['id']."'";
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>