<?php
include "db.php";

$query = "update branch set branch = '".$_POST['branch']."', course_id='".$_POST['course_id']."' where id = '".$_POST['id']."'";

if ($conn->query($query) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>