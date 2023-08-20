<?php 
require "db_con.php";

    $con= dbConnect();
    $uname = $con->real_escape_string($_POST['username']);
    $passwd = $con->real_escape_string($_POST['pwd']);

    $query = "INSERT INTO account(username, password) VALUES('$uname', '$passwd')";
    $result = $con->query($query);
if(!$result)
{
    $err =1;
}
    $con->close();
if(isset($err))
{
    header("location: register.php?err=1");
}
else
{
    header("location: index.php");
}

?>
