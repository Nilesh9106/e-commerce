<?php 
include "comp/config.php";
include "auth.php";
$id=$_COOKIE['id'];

$sql="SELECT * FROM users WHERE id=$id";
$result=$link->query($sql);
$row=$result->fetch_assoc();
$is_admin=$row['is_admin'];
if($is_admin==0){
    header("Location: index.php?mess=you are not allowed to go to that page");
}
?>
<?php
$n = false;
$check = 'danger';
$mess = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO `product` ( `name`, `brand`, `photo`, `price`, `description`, `type`, `max_qty`) VALUES ( ?,?, ?, ?,?,?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sssisss", $name, $brand, $photo, $price, $desc, $type, $qty);
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $type = $_POST['type'];
    $qty = $_POST['qty'];
    $photo = 'image/' . $id . '/' . basename($_FILES['img']['name']);
    move_uploaded_file($_FILES['img']['tmp_name'], $photo);
    if (mysqli_stmt_execute($stmt)) {
        $mess = "Your Product published successfully";
        $n = true;
        $check = 'success';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell</title>
    <?php include "comp/link.php" ?>

</head>

<body>
    <section class="w-75 mx-auto my-5 p-5 border">
        <h1 class="mb-2 text-center">Sell Your Product</h1>
        <hr>
        <?php if ($n) { ?>
            <div class="alert alert-<?= $check ?>" role="alert">
                <?= $mess ?>
            </div>
        <?php } ?>
        <form class="col g-3 d-flex flex-column align-items-center needs-validation" action="sell.php" method="POST" enctype="multipart/form-data" novalidate>
            <div class="mb-3 col-md-6">
                <label for="validationCustom05" class="form-label">Photo of Product *</label>
                <input type="file" name="img" class="form-control"  id="validationCustom05" required>
                <div class="invalid-feedback">Please Enter the file </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom01" class="form-label">Name of Product *</label>
                <input type="text" name="name" class="form-control" id="validationCustom01"  required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom02" class="form-label">Brand of Product *</label>
                <input type="text" name="brand" class="form-control" id="validationCustom02" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustomUsername" class="form-label">Price *</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">₹</span>
                    <input type="number" name="price" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Please choose a Price.
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustomUsername" class="form-label">QTY *</label>
                <div class="input-group has-validation">
                    <input type="number" name="qty" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    <div class="invalid-feedback">
                        Please choose a qty.
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationTextarea" class="form-label">Description</label>
                <!-- <input type="text"  id="validationCustom03" required> -->
                <textarea name="desc" id="validationTextarea" class="form-control " cols="30" rows="8" require></textarea>
                <div class="invalid-feedback">
                    Please provide a valid Description.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom04" class="form-label">Type *</label>
                <select class="form-select" name="type" id="validationCustom04" required>
                    <option selected disabled value="">Choose...</option>
                    <option>mobile</option>
                    <option>laptop</option>
                    <option>tablet</option>
                    <option>headphone</option>
                    <option>other</option>
                </select>
                <div class="invalid-feedback">
                    Please select a valid state.
                </div>
            </div>


            <button class="btn btn-outline-primary col-md-6" type="submit">Sell Product</button>
        </form>
    </section>
    <script>
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