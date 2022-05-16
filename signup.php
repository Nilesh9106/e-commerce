<?php

include "fun.php";


$n = false;
$check = "danger";
$mess = "username is already taken please try another";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $sql = "SELECT * FROM `users` WHERE `username` = '$username' ";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) === 0) {

        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $pass = $_POST['pass'];
        $activation_code = generate_activation_code();
        if (register_user($email,$username,$pass,$activation_code,$pincode,$city." ".$state)) {
            $check = "secondary";
            $n = true;
            $mess = "Your Account opened successfully please check your email for verify your account";
            $activation_link="http://localhost/project2/activate.php?email=$email&activation_code=$activation_code";
            $subject="activation of your account";
            $message="hi $username,Please click the following link to activate your account:     $activation_link";
            $header="FROM: nileshdarji282003@gmail.com \r \n";
            if(mail($email,$subject,$message,$header)){
                $check="success";
            }
            
        } else {
        
            $n = true;
            $mess = "something went wrong please try again :(";
            
        }
    } else {
        $check = "primary";
        $n = true;
    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php include "comp/link.php" ?>
    <style>
        div.mar {
            margin: 10px auto;
            box-shadow: 1px 1px 15px #f3f3f3;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex flex-column justify-content-center w-75 mar border rounded">

        <h1 class="text-center mt-2">Sign Up</h1>
        <hr>
        <?php if ($n) { ?>
            <div class="alert alert-<?= $check ?>" role="alert">
                <?= $mess ?>
            </div>
        <?php } ?>
        <form class="col g-3 d-flex flex-column align-items-center  needs-validation" action="signup.php" method="POST" novalidate>
            <div class="col-md-6">
                <label for="validationCustom01" class="form-label">Username</label>
                <input type="text" name="uname" class="form-control" id="validationCustom01" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
           
            <div class="col-md-6">
                <label for="validationCustomUsername" class="form-label">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="email" name="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Please choose chose Email.
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom03" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="validationCustom03" required>
                <div class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationCustom04" class="form-label">State</label>
                <input type="text" name="state" class="form-control" id="validationCustom05" required>

                <div class="invalid-feedback">
                    Please select a valid state.
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <label for="validationCustom05" class="form-label">Pincode</label>
                <input type="text" name="pincode" class="form-control" id="validationCustom05" minlength="6" required>
                <div class="invalid-feedback">
                    Please provide a valid Pincode.
                </div>
            </div>
            
            <div class="col-md-6 mb-2">
                <label for="validationCustom05" class="form-label">choose Password</label>
                <input type="password" name="pass" class="form-control" id="validationCustom05" minlength="8" required>
                <div class="invalid-feedback">
                    Please provide a Password at least 8 character .
                </div>
            </div>

            <div class="col-md-6">
                <a href="signin.php" class="ms-1 text-decoration-none">Already Have an account</a>
            </div>
            <div class="col-md-6 my-3">
                <button class="btn btn-primary w-100" type="submit">Submit form</button>
            </div>
        </form>
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>