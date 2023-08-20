<?php 
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
  header("location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Page</title>
        <meta charset="utf-8">
        <style>
            body {font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 0.8em;}
            header, nav, section, article, footer {
                border:1px solid grey; margin:5px; padding:8px;
            }
            nav ul {margin: 0; padding: 0;}
            nav ul li {display: inline; margin: 5px;}
            header, footer {
                color: white; background-color: #444; margin-bottom: 5px;
            }
            section {background-color: #ddd;}
            
        </style>
    </head>
    <body>
        <header>
       
        <h2 style="color:red; background-color:white; text-align:right;"><a href="logout.php"> logout </a></h2>
        </header>
        <nav>
            <ul>
            
            
            <li><a href="view.php"> view users</a></li>
            <li><a href="About.php"> About</a></li>
           
        </ul>
        </nav>
        <header>  <h1> Users edit</h1></header>
        <section>
        <?php

 
define("HOST", "localhost");
define("USER", "root");
define("PWD", "");
define("DB_NAME", "actlab");
$con = new mysqli(HOST, USER, PWD, DB_NAME);
if($con->connect_errno){
    echo "connection failed: " . $con->connect_error;
    exit();
}
$id = $_GET['id'];
$query = "SELECT * FROM account where id = $id";
$result = $con->query($query);

$r= $result->fetch_assoc();
?>

<form action="edit.php" method="POST">
<table>
   <tr><td><label for="uname">user name</label></td>
   <td><input type="text" name="username" value="<?php echo $r['username']?>"><br></td></tr>
   <tr><td><label for="pwd">password</label></td>
   <td><input type="password" name="pwd" value="<?php echo $r['password']?>"> <br></td></tr>
<tr><td><input type="submit" value="submit"></td></tr>    
  </table>
   </form>

<?php
$result->close();
?>
        
        </section>
        <footer><p>&copy; 2021. all rights reserved</p></p>
    </body>
</html>