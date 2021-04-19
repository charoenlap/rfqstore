<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="<?php echo route('company/addCompany'); ?>" class="btn btn-outline-success btn-lg rounded-0 w-100">+ เพิ่มบริษัท</a>
                                    <!-- <h6 class="mb-0"><i class="fa fa-exclamation-triangle text-danger" aria-hidden="true"></i> เริ่มใช้งานโดย เพิ่มบริษัทจากปุ่มสีเขียว</h6> -->
                                </div>
                                <!-- <div class="col-md-10">
                                    <h6 class="mb-0"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> เริ่มใช้งานโดย เพิ่มบริษัทจากปุ่มสีเขียว</h6>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <!-- <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <h6><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> เริ่มใช้งานโดย เพิ่มบริษัทจากปุ่มสีเขียว</h6>
                      </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <?php foreach($list_company as $val){ ?>
                <div class="col-md-3">
                  <div class="card">
                      <div class="card-body text-center">
                        <img src="../assets/image/logo.png" alt="" class="mb-3 w-50">
                        <h5 class="card-title"><?php echo $val['company_name']; ?></h5>
                        <!-- <p class="card-text">Some quick example text to build.</p> -->
                        <p class="text-success">Verify</p>
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <a href="<?php echo route('company/editCompany&id_company='.encrypt($val['id_company'])); ?>" class="btn btn-warning w-100 rounded-0"><i class="fas fa-edit"></i> แก้ไขข้อมูล</a>
                            </div>
                            <div class="col-md-12">
                                <a href="<?php echo route('company&id_company='.encrypt($val['id_company'])); ?>" class="btn btn-primary btn-theme w-100 rounded-0"><i class="fas fa-eye"></i> เลือกบริษัท</a>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- <div class="col-md-2"> 
            <div class="row mt-4">
                <div class="col-md">
                    <div class="card">
                      <div class="card-body">
                        เริ่มใช้งานโดย เพิ่มบริษัทจากปุ่มสีเขียว
                      </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>