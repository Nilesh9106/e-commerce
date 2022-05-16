<?php

include "fun.php";
// include "comp/config.php";
    
$n = false;
$check = "danger";
$mess="";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
        
    if (login($email,$pass)) {
        header("Location: index.php");
    }else{
        $mess="incorrect username or password";
        $n=true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <?php include "comp/link.php" ?>
</head>

<body>
    <div class="container-fluid d-flex flex-column p-3 justify-content-center w-75 my-5 border rounded">
        <h1 class="mt-2 text-center">Sign in</h1>
        <hr>
        <?php if ($n) { ?>
            <div class="alert alert-<?= $check ?>" role="alert">
               <?=$mess?>
            </div>
        <?php } ?>
        <form class="col g-3 d-flex flex-column align-items-center " action="signin.php" method="POST" >
            <div class="col-md-6">
                <label for="exampleInputEmail1" class="form-label">Username or Email address</label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="col-md-6 mb-2">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="col-md-6">
                <a href="signup.php" class="ms-1 mb-2 text-success text-decoration-none">Don't Have an account</a>
            </div>
            <button type="submit" class="btn col-md-6 my-2 btn-outline-dark">Submit</button>
        </form>
    </div>
</body>

</html>