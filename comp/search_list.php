
        <!-- single product  -->

        <div class=" single justify-content-center  mb-3">
            <div class="col-md-12 col-xl-10">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row row-cols-2 row-cols-md-2 ">
                            <div class="col-md-12 col-sm-2 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                    <!-- photo start  -->
                                    <img src="<?=$row['photo']?>" class="w-100" />
                                    
                                </div>
                            </div>
                            <!-- photo end  -->
                            <!-- rating start -->
                            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                                <h5><?=$row['name']?></h5>
                                
                                <!-- rating end -->

                                <div class="mb-2 text-muted small">
                                    <span>By <?=$row['brand']?></span>

                                </div>
                                <!-- description start  -->
                                <p class="text-truncate mb-4 mb-md-0">
                                    <?php echo $row['description'] ?>
                                </p>
                                <!-- description end -->
                            </div>
                            <div class="col-md-6 col-lg-3 mx-auto col-xl-3 border-sm-start-none border-start">
                                <div class="d-flex flex-row align-items-center mb-1">
                                    <h4 class="mb-1 me-1"> ₹ <?=(float)$row['price']?></h4>
                                </div>
                                <?php if($row['max_qty']!=0){ ?>
                                <h6 class="text-success">In Stock</h6>
                                <?php } else{?>
                                    <h6 class="text-danger">Out of Stock</h6>

                                    <?php } ?>
                                <div class="d-flex flex-column mt-4">
                                    <a class="btn btn-primary btn-sm" href="product.php?id=<?=$row['pid']?>">Details</a>
                                    
                                    <a class="btn btn-outline-dark btn-sm mt-2" href="add_to_cart.php?cid=<?=$row['pid']?>">
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single product  -->
