<section class="pt-5">
    <div class="container">
        <div class="row">
            <?php foreach($shop['product'] as $key => $value){ ?>
            <div class="col-md-6">
                <div class="card mb-4 rounded-0 border-0 product-hover">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href=""><img src="<?php echo MURL; ?>uploads/<?php echo $value['product_image']; ?>" alt="" class="w-100" height="200"></a>
                            </div>
                            <div class="col-md-6">
                                <div class="py-3">
                                    <h6 class="font-weight-bold text-secondary"><?php echo $value['product_name']; ?></h6>
                                    <h4 class="font-weight-bold text-success"><?php echo $value['product_price']; ?> บาท</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>


