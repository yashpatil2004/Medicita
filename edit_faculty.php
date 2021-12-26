<?php
include "databaseconn.php";

$sql = "UPDATE faculty SET fname='".$_POST['fname']."', lname='".$_POST['lname']."', email_id='".$_POST['email_id']."' ,branch_id='".$_POST['branch_id']."', collegee='".$_POST['collegee']."', educationn='".$_POST['educationn']."', mobile_num='".$_POST['mobile_num']."',  addres='".$_POST['addres']."' WHERE id = '".$_POST['id']."'";
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>