<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="font-weight-bold"><?php echo $shop['detail']['company_name']; ?></h3>
                <p><?php echo $shop['detail']['company_address']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th width="20%">รูปภาพ</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1; 
                            // echo "<pre>";
                            // print_r($shop['detail']);
                            // echo "</pre>";
                            foreach($shop['product'] as $key => $value){ 
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><img src="<?php echo MURL; ?>uploads/<?php echo $value['product_image']; ?>" class="w-100" alt=""></td>
                            <td><h5 class="font-weight-bold"><?php echo $value['product_name']; ?></h5></td>
                            <td><h5><span class="text-success font-weight-bold"><?php echo $value['product_price']; ?></span> บาท</h5></td>
                            <td><button class="btn btn-primary w-100"><i class="fas fa-shopping-cart"></i></button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>