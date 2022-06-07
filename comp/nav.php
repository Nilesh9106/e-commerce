<?php
include "comp/config.php";
$is_admin=0;
if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
    $name = $_COOKIE['username'];
    $sql="SELECT * FROM users WHERE id=$id";
    $result=$link->query($sql);
    $row=$result->fetch_assoc();
    $pincode=$row['pincode'];
    $is_admin=$row['is_admin'];

} else {
    $name = "Sign In ";
}

?>
<nav id="navbar" class="navbar navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="assets/Shop++1.jpg"  height="65px"  alt=""></a>
        <!-- <div class="d-flex"> -->
        <div class="my-2 d-flex flex-wrap">
            <div class="d-flex large-drop">
                <?php if (!isset($_COOKIE['id'])) { ?>
                    <a class="btn menu  btn-outline-dark  btn-sm" href="signin.php" title="Sign in"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg><span>Sign in</span></a>
                <?php } ?>
                <a class="btn menu  btn-outline-dark  btn-sm" href="team.php" title="Team"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                    </svg><span>Our Team</span></a>
                <a class="btn btn-outline-dark  btn-sm" href="cart.php" title="My Cart"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" style="margin-right: 5px;" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                    </svg>My Cart</a>
            </div>
            <div>
                <button class="navbar-toggler rounded btn btn-sm float-right" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png" width="22px" height="22px" class="rounded-circle" alt="">
                </button>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <?php 
                if($is_admin){
                    echo '<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Welcome Back Admin</h5>';
                }else{
                ?>
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?= $name ?></h5>
                <?php } ?>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Profile</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>
                    <?php 
                        if($is_admin==1){
                            
                            echo '<li class="nav-item">
                            <a class="nav-link" href="report_mess.php">Reports</a>
                        </li>';
                            echo '<li class="nav-item">
                            <a class="nav-link" href="sell.php">Upload product</a>
                        </li>';
                        }
                    ?>
                    <?php if (isset($_COOKIE['id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="signout.php">sign out</a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="my-2 d-flex flex-wrap small-drop">
                    <?php if (!isset($_COOKIE['id'])) { ?>
                        <a class="btn menu  btn-outline-dark  btn-sm" href="signin.php" title="Sign in"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg><span>Sign in</span></a>
                            <?php } ?>
                            
                    <a class="btn menu d-md-none  btn-outline-dark  btn-sm" href="team.php" title="Team"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                        </svg></a>
                    <a class="btn btn-outline-dark  btn-sm" href="cart.php" title="My Cart"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" style="margin-right: 5px;" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                        </svg>My Cart</a>

                </div>

            </div>
        </div>
    </div>
</nav>