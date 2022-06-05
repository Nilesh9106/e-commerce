<?php 
include "auth.php";
?>

<?php 

    $pid=$_GET['cid'];
    
    $qty=$_POST['qty'] ?? 1;
    $id=$_COOKIE['id'];
    include "comp/config.php";
    $sql="INSERT INTO `cart`(`pid`,`id`,`qty`) VALUES ($pid,$id,$qty)";
    if(mysqli_query($link,$sql)){
        header("Location: cart.php");
    }else{
        header("Location: index.php");

    }

?>