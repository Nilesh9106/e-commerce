<?php 
include "fun.php";

$email=$_GET['email'];
$activation_code=$_GET['activation_code'];

$user=find_unverified_user($activation_code,$email);
if($user and activate_user($user['id'])){
    header("Location: signin.php");
}
?>