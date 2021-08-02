<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
  <div class="card my-3">
    <div class="card-body">
      <div class="row">
        <div class="col-md">
          <?php if (!empty($success)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success; ?></div>
          <?php endif ?>
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
          <?php endif ?>
          <h4><?php echo $title; ?></h4>
          <hr>
          <form action="<?php echo $action;?>" method="post" id="filterform">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="">ประเภท</label>
                <select name="type_bill" id="" class="form-control select2">
                  <optgroup label="ขาย">
                    <option value="quotation" <?php echo $type_bill=='quotation'?'selected':'';?>>ใบเสนอราคา</option>
                    <option value="billingnote" <?php echo $type_bill=='billingnote'?'selected':'';?>>ใบวางบิล/ใบแจ้งหนี้/ใบส่งของ</option>
                    <option value="receipt" <?php echo $type_bill=='receipt'?'selected':'';?>>ใบเสร็จรับเงิน</option>
                  </optgroup>
                  <optgroup label="ซื้อ">
                    <option value="purchaseOrder" <?php echo $type_bill=='purchaseOrder'?'selected':'';?>>ใบสั่งซื้อ</option>
                    <option value="productReceipt" <?php echo $type_bill=='productReceipt'?'selected':'';?>>ใบรับสินค้า</option>
                  </optgroup>
                  <optgroup label="ค่าใช้จ่าย">
                    <option value="theCost" <?php echo $type_bill=='theCost'?'selected':'';?>>ค่าใช้จ่าย</option>
                    <option value="withholdingTax" <?php echo $type_bill=='withholdingTax'?'selected':'';?>>ใบหักภาษี ณ​ ที่ จ่าย</option>
                  </optgroup>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">วันที่ตั้งแต่</label>
                <input type="text" class="form-control inputdatepicker" name="date_start" placeholder="วันที่เริ่มต้น" value="<?php echo $date_start;?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">จนถึงวันที่</label>
                <input type="text" class="form-control inputdatepicker" name="date_end" placeholder="วันที่สุดท้าย" value="<?php echo $date_end;?>">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">&nbsp;</label>
                <button type="submit" class="btn btn-info rounded-0 w-100" id="filtersubmit">
                ค้นหา
									</button>
                <!-- <input type="submit" class="form-control btn btn-info" value="ค้นหา" id="filtersubmit"> -->
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="">&nbsp;</label>
                <button type="button" class="btn btn-info rounded-0 w-100" data-toggle="modal" data-target="#modal_export">
										Export
									</button>
              </div>
            </div>
          </div>
          </form>
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-theme">
              <thead>
                <th>วันที่</th>
                <th>เลขที่เอกสาร</th>
                <th>บริษัท</th>
                <th class="text-right">ราคา</th>
                <th class="text-right">ภาษี</th>
                <th class="text-right">หัก ณ​ ที่จ่าย</th>
                <th class="text-right">ยอดรวาม</th>
              </thead>
              <tbody>
                <?php $sum=array(0,0,0,0); ?>
                <?php if (count($reports)==0): ?>
                <tr>
                  <td class="text-center" colspan="7">ไม่พบข้อมูล</td>
                </tr>
                <?php endif ?>
                <?php foreach ($reports as $key => $value): ?>
                <?php  
                $ex = explode(' ', $value['date']);
                $ex = explode('-', $ex[0]);
                $ex[0] += 543;
                $date = array();
                for ($i=2; $i>=0; $i--) { $date[] = $ex[$i]; }
                $date = implode('-', $date);

                $sum[0] += (double)$value['total'];
                $sum[1] += (double)$value['vat'];
                $sum[2] += (double)$value['tax'];
                $sum[3] += (double)$value['totalvat'];
                ?>
                <tr>
                  <td><?php echo $date;?></td>
                  <td><?php echo $value['doc_no'];?></td>
                  <td><?php echo $value['company'];?></td>
                  <td class="text-right" width="12%"><?php echo number_format($value['total'], 2);?></td>
                  <td class="text-right" width="12%"><?php echo number_format($value['vat'], 2);?></td>
                  <td class="text-right" width="12%"><?php echo number_format($value['tax'], 2);?></td>
                  <td class="text-right" width="12%"><?php echo number_format($value['totalvat'], 2);?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="3">รวมทั้งสิ้น</th>
                  <?php for ($i=0; $i<=3; $i++) : ?>
                  <th class="text-right"><?php echo number_format($sum[$i],2);?></th>
                  <?php endfor ?>
                </tr>
              </tfoot>
            </table>
          </div>
          <?php echo $pageing; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_export">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content border-0">
			<form action="<?php echo $action_export; ?>" method="POST">
				<div class="modal-header bg-info">
					<h3 class="text-white">EXPORT</h3>
					<hr>
				</div>
				<div class="modal-body">
					<div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label for="">ประเภท</label>
                <select name="type_bill" id="export_bill" class="form-control">
                  <optgroup label="ขาย">
                    <option value="quotation" <?php echo $type_bill=='quotation'?'selected':'';?>>ใบเสนอราคา</option>
                    <option value="billingnote" <?php echo $type_bill=='billingnote'?'selected':'';?>>ใบวางบิล/ใบแจ้งหนี้/ใบส่งของ</option>
                    <option value="receipt" <?php echo $type_bill=='receipt'?'selected':'';?>>ใบเสร็จรับเงิน</option>
                  </optgroup>
                  <optgroup label="ซื้อ">
                    <option value="purchaseOrder" <?php echo $type_bill=='purchaseOrder'?'selected':'';?>>ใบสั่งซื้อ</option>
                    <option value="productReceipt" <?php echo $type_bill=='productReceipt'?'selected':'';?>>ใบรับสินค้า</option>
                  </optgroup>
                  <optgroup label="ค่าใช้จ่าย">
                    <option value="theCost" <?php echo $type_bill=='theCost'?'selected':'';?>>ค่าใช้จ่าย</option>
                    <option value="withholdingTax" <?php echo $type_bill=='withholdingTax'?'selected':'';?>>ใบหักภาษี ณ​ ที่ จ่าย</option>
                  </optgroup>
                </select>
              </div>
            </div>
						<div class="col-md-6">
							<label for="">วันที่ตั้งแต่</label>
							<input type="text" class="form-control inputdatepicker mb-1" name="date_start" placeholder="วันที่ตั้งแต่" value="<?php echo $date_start; ?>">
						</div>
						<div class="col-md-6">
							<label for="">จนถึงวันที่</label>
							<input type="text" class="form-control inputdatepicker mb-1" name="date_end" placeholder="จนถึงวันที่" value="<?php echo $date_end; ?>">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">Export</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					<!-- <button type="button" class="btn btn-primary"></button> -->
				</div>
			</form>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function($) {
  $('#filtersubmit').click(function(event) {
    $(this).attr('disabled','disabled');
    $('#filterform').submit();
  });
  $('.select2').select2();
});
</script>