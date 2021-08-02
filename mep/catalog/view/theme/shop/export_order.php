<?php

        header("Content-Type: application/vnd.ms-excel"); // ประเภทของไฟล์
        header('Content-Disposition: attachment; filename="export_order'.date('d-m-Y').'.xls"'); //กำหนดชื่อไฟล์
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
                <td>วันที่</td>
                <td>เลขที่เครื่อง POS</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($order as $key => $value){ ?>
                <tr>
                    <td><?php echo $value['date_added']; ?></td>
                    <td><?php echo $value['pos']; ?></td>
                    <td><?php echo number_format($value['total'],2); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>