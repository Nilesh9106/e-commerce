<?php 
include "auth.php";
?>

<?php 

    $pid=$_GET['cid'];
    
    $qty=$_POST['qty'];
    $id=$_COOKIE['id'];
    include "comp/config.php";
    $sql="INSERT INTO `cart`(`pid`,`id`,`qty`) VALUES ($pid,$id,$qty)";
    if(mysqli_query($link,$sql)){
        header("Location: product.php?id=$pid");
    }else{
        header("Location: index.php");

    }

?>