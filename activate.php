<?php 
include "auth.php";
include "fun.php";
if(isset($_GET['email'])){
$email=$_GET['email'];
$activation_code=$_GET['activation_code'];

$user=find_unverified_user($activation_code,$email);
if($user and activate_user($user['id'])){
    header("Location: signin.php");
}
}else{
    header("Location: index.php");
}
?>