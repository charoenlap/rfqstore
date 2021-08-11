<section class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-0">
                            <div class="card-body p-0">
                                <ul class="list-catrgory">
                                    <?php for ($i=1; $i <=10; $i++) {  ?>
                                        <li><a href="">Category <?php echo $i; ?></a></li>
                                    <?php } ?> 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-0">
                            <div class="card-body">
                                <h2 class="font-weight-bold">Products</h2>
                                <p>Home/category</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach($shop['product'] as $key => $value){ ?>
                    <div class="col-md-6">
                        <div class="card mb-4 rounded-0 border-0 product-hover">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href=""><img src="<?php echo MURL; ?>uploads/<?php echo $value['product_image']; ?>" alt="" class="w-100" height="150"></a>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold text-secondary"><?php echo $value['product_name']; ?></h6>
                                        <h6 class="font-weight-bold text-success mb-5"><?php echo $value['product_price']; ?> บาท / <?php echo $value['product_unit']; ?></h6>
                                        <div class="row">
                                            <!-- <div class="col-md-4">
                                                <button class="btn btn-info w-100"><i class="fas fa-eye w-100"></i></button>
                                            </div> -->
                                            <div class="col-6 pr-0">
                                                <button class="btn btn-danger w-100 rounded-0"><i class="fas fa-heart"></i></button>
                                            </div>
                                            <div class="col-6 pl-0">
                                                <button class="btn btn-info w-100 rounded-0"><i class="fas fa-shopping-cart"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>


