<?php
include "db.php";

$query = "update course set name = '".$_POST['name']."' where id = '".$_POST['id']."'";

if ($conn->query($query) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>