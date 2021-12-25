<?php
include ("db.php");
$query = "update managecollege set college_name='".$_POST['college_name']."', administrator_name='".$_POST['administrator_name']."', course_id='".$_POST['course_id']."', email='".$_POST['email']."', address='".$_POST['address']."'where id = '".$_POST['id']."'";

if ($conn->query($query) === TRUE)
{
    echo true;
}
else
{
    echo false ;
}
?>