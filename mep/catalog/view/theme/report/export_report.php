<?php

        header("Content-Type: application/vnd.ms-excel"); // ประเภทของไฟล์
        header('Content-Disposition: attachment; filename="export_report'.date('d-m-Y').'.xls"'); //กำหนดชื่อไฟล์
        header("Content-Type: application/force-download"); // กำหนดให้ถ้าเปิดหน้านี้ให้ดาวน์โหลดไฟล์
        header("Content-Type: application/octet-stream"); 
        header("Content-Type: application/download"); // กำหนดให้ถ้าเปิดหน้านี้ให้ดาวน์โหลดไฟล์
        header("Content-Transfer-Encoding: binary"); 
        header("Content-Length: ".filesize("myexcel.xls"));   

        @readfile($filename); 

        ?>
<html 
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40"
>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <thead>
                    <th>วันที่</th>
                    <th>เลขที่เอกสาร</th>
                    <th>บริษัท</th>
                    <th class="text-right">ราคา</th>
                    <th class="text-right">ภาษี</th>
                    <th class="text-right">หัก ณ​ ที่จ่าย</th>
                    <th class="text-right">ยอดรวาม</th>
                </thead>
            </tr>
        </thead>
        <tbody>
            <?php $sum = array(0, 0, 0, 0); ?>
            <?php if (count($reports) == 0) : ?>
                <tr>
                    <td class="text-center" colspan="7">ไม่พบข้อมูล</td>
                </tr>
            <?php endif ?>
            <?php foreach ($reports as $key => $value) : ?>
                <?php
                $ex = explode(' ', $value['date']);
                $ex = explode('-', $ex[0]);
                $ex[0] += 543;
                $date = array();
                for ($i = 2; $i >= 0; $i--) {
                    $date[] = $ex[$i];
                }
                $date = implode('-', $date);

                $sum[0] += (float)$value['total'];
                $sum[1] += (float)$value['vat'];
                $sum[2] += (float)$value['tax'];
                $sum[3] += (float)$value['totalvat'];
                ?>
                <tr>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $value['doc_no']; ?></td>
                    <td><?php echo $value['company']; ?></td>
                    <td class="text-right" width="12%"><?php echo number_format($value['total'], 2); ?></td>
                    <td class="text-right" width="12%"><?php echo number_format($value['vat'], 2); ?></td>
                    <td class="text-right" width="12%"><?php echo number_format($value['tax'], 2); ?></td>
                    <td class="text-right" width="12%"><?php echo number_format($value['totalvat'], 2); ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">รวมทั้งสิ้น</th>
                <?php for ($i = 0; $i <= 3; $i++) : ?>
                    <th class="text-right"><?php echo number_format($sum[$i], 2); ?></th>
                <?php endfor ?>
            </tr>
        </tfoot>
    </table>
</body>

</html>