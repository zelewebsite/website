<?php 
require "db_con.php";
$con= dbConnect();
    $uname = $con->real_escape_string($_POST['username']);
    $passwd = $con->real_escape_string($_POST['pwd']);

if(isset($_POST['Login'])){
    $query="SELECT username, password FROM account WHERE username = '$uname' AND password='$passwd'";  
    $result = $con->query($query);
    $rowCount=  $result->num_rows;   
}

if($rowCount==0){

    header("location:loginview.php?user=Incorrect username or Password");
}

while($row=$result->fetch_assoc())
{
    if($row['username']==$uname && $row['password']==$passwd){

        if(!empty($_POST['rememberMe'])){
            setcookie("member_login", $uname, time()+(10*365*24*60*60));
            setcookie("member_password", $passwd, time()+(10*365*24*60*60));
        }else{
            if(isset($_COOKIE['member_login'])){
                setcookie("member_login", "");
            }
            if(isset($_COOKIE['member_password'])){
                setcookie("member_password", "");
            }
        }
    }
    session_start();
    
    $_SESSION["loggedin"] = true;
    $_SESSION['username']=$uname;
    
    header("Location: welcome.php");
}
$con->close();   
?>