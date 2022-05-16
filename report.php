<?php 
include "auth.php";
include "comp/config.php";
$message=$_POST['mess'];
$id=$_COOKIE['id'];
$sql="SELECT * FROM users WHERE id =$id";
$result=$link->query($sql);
$row=$result->fetch_assoc();
$uname=$row['username'];
$sql="INSERT INTO reports (message,username) VALUES ('$message','$uname')";
if($link->query($sql)){
    header("Location: index.php?mess=your message sent successfully");
}else{
    
    header("Location: index.php?report=something went wrong");
}
?>