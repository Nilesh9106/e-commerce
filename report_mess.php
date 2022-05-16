<?php 
include "auth.php";
include "comp/config.php";
$id=$_COOKIE['id'];
$sql="SELECT * FROM users WHERE id = $id";
$result=$link->query($sql);
$row=$result->fetch_assoc();
if($row['is_admin']==0){
    header("Location: index.php?mess=you can not goto that page");
}
?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>reports</title>
        <?php include "comp/link.php" ?>
        </head>
        
        <body>
            <?php include "comp/nav.php" ?>
            <div class="col-md-6 col-lg-7 col-xl-8">
                <ul class="list-unstyled m-3">
    <?php 
        $sql="SELECT * FROM reports";
        $result=$link->query($sql);
        while($row=$result->fetch_assoc()){
        ?>
            <li class="d-flex justify-content-between m-3 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <p class="fw-bold mb-0"><?=$row['username']?></p>
                        <p class="text-muted small mx-4 mb-0"><i class="far fa-clock mx-2"></i><?=$row['time']?></p>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                            <?=$row['message']?>
                        </p>
                    </div>
                </div>
            </li>
        <?php } ?>
        </ul>
    </div>

</body>

</html>