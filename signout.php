

<?php 
if(isset($_COOKIE['id'])){
    setcookie('id','2',932);
    setcookie('username','2',932);
    header("Location: index.php");
}

?>