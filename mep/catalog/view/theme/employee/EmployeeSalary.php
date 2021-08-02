<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $company_info['company_name']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="assets/boostrap_jquery/js/jquery.js"></script>
    <script src="assets/js/main.js"></script>
    <?php if (isset($script)) { ?>
        <?php foreach ($script as $value) { ?>
        <script src="<?php echo $value; ?>"></script>
        <?php } ?>
    <?php } ?>
    <?php if (isset($style)) { ?>
        <?php foreach ($style as $value) { ?>
        <link rel="stylesheet" href="<?php echo $value; ?>"></link>
        <?php } ?>
    <?php } ?>
</head>

<body>
    <style>
        table tr td:first-child::after {
            content: "";
            display: inline-block;
            vertical-align: top;
            min-height: 40px;
        }

        /* EDIT PRINT  */
        @media print {
            @page {
                size: landscape
            }

            .calculate {
                display: none;
            }

            .col-md-1,
            .col-md-2,
            .col-md-3,
            .col-md-4,
            .col-md-5,
            .col-md-6,
            .col-md-7,
            .col-md-8,
            .col-md-9,
            .col-md-10,
            .col-md-11,
            .col-md-12 {
                float: left;
            }

            .col-md-12 {
                width: 100%;
            }

            .col-md-11 {
                width: 91.66666666666666%;
            }

            .col-md-10 {
                width: 83.33333333333334%;
            }

            .col-md-9 {
                width: 75%;
            }

            .col-md-8 {
                width: 66.66666666666666%;
            }

            .col-md-7 {
                width: 58.333333333333336%;
            }

            .col-md-6 {
                width: 50%;
            }

            .col-md-5 {
                width: 41.66666666666667%;
            }

            .col-md-4 {
                width: 33.33333333333333%;
            }

            .col-md-3 {
                width: 25%;
            }

            .col-md-2 {
                width: 16.666666666666664%;
            }

            .col-md-1 {
                width: 8.333333333333332%;
            }
            .card{
                border: none;
            }
        }
    </style>
    <div class="container">
        <!-- <form action="<?php echo $action; ?>" id="form-calculate" method="POST"> -->
        <form id="form-calculate" method="POST">
            <button class="btn btn-info float-right ml-2 calculate">คำนวณ</button>
            <div class="card">
                <div class="card-body pb-0">
                    <div class="row mt-3">
                        <div class="col-md-6 text-center">
                            <!-- <h4>บริษัทตัวอย่าง</h4> -->
                            <h4><?php echo $company_info['company_name']; ?></h4>
                        </div>
                        <div class="col-md-6">
                            <h5>ใบจ่ายเงินเดือน/ค่าจ้าง/เงินประจำตำแหน่ง</h5>
                            <h6>โปรดตรวจสอบและเก็บเป็นหลักฐานในการติดต่อการเงินและบัญชี</h6>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    รหัส
                                </div>
                                <div class="col-md-12">
                                    Code
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    ชื่อพนักงาน
                                </div>
                                <div class="col-md-12">
                                    Name
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    เลขประจำตัวประชาชน
                                </div>
                                <div class="col-md-12">
                                    ตำแหน่ง
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>เงินเดือน<br>(Salary)</th>
                                    <th>เดือน<br>(Month)</th>
                                    <th>จำนวนเงิน<br>(Amount)</th>
                                    <th>ภาษี<br>(TAX)</th>
                                    <th>ประกันสังคม<br>(Social Security)</th>
                                    <th>จำนวนเงิน<br>(Amount)</th>
                                    <th>วัน/เดือน/ปี<br>(Payroll Date)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="2"><?php echo number_format($employee_salary, 2); ?></td>
                                    <td rowspan="2"><?php echo $month_th; ?></td>
                                    <td rowspan="2"><input type="number" name="income" id="income" class="form-control" value="<?php echo isset($_POST['income']) ? $_POST['income'] : ""; ?>"></td>

                                    <td rowspan="2"><input type="number" name="tax" id="tax" class="form-control tax-amount" value="<?php echo isset($_POST['tax']) ? $_POST['tax'] : ""; ?>"></td>
                                    <td rowspan="2"><input type="number" name="social" id="social" class="form-control tax-amount" value="<?php echo isset($_POST['social']) ? $_POST['social'] : ""; ?>"></td>
                                    <td rowspan="2"><input type="number" name="tax_social" id="tax_social" class="form-control tax-amount" value="<?php echo isset($_POST['tax_social']) ? $_POST['tax_social'] : ""; ?>"></td>

                                    <td style="height: 50px;"><input type="text" name="payroll" id="payroll" class="form-control inputdatepicker" value="<?php echo $date_start; ?>"></td>
                                </tr>
                                <tr>
                                    <th class="bg-light">เงินรับสุทธิ <br> Net To Pay</th>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="bg-light">รวมรายได้ <br> Total</th>
                                    <td><input type="number" readonly name="amount_total" id="amount_total" class="form-control total_comma" value="<?php echo isset($total_amount) ? $total_amount : ""; ?>"></td>
                                    <th colspan="2" class="bg-light">รวมรายการหัก <br> Total Deductions</th>
                                    <td><input type="number" readonly id="amount_deduc" class="form-control total_comma" value="<?php echo isset($total_decrease) ? $total_decrease : ""; ?>"></td>
                                    <td><input type="number" readonly id="total" class="form-control total_comma" value="<?php echo isset($total_deduc) ? $total_deduc : ''; ?>"></td>
                                </tr>
                            </tfoot>
                        </table>

                        <table class="table table-bordered text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>รายได้สะสมต่อปี</th>
                                    <th>ภาษีสะสมต่อปี</th>
                                    <th>เงินสะสมกองทุนต่อปี</th>
                                    <th>เงินประกันสังคมต่อปี</th>
                                    <th>ค่าลดหย่อนอื่นๆต่อปี</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered text-center">
                            <tbody>
                                <tr>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" readonly class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>1,000</td>
                                    <td>500</td>
                                    <td>100</td>
                                    <td>50</td>
                                    <td>20</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td>0.50</td>
                                    <td>0.25</td>
                                    <td>ลงชื่อพนักงาน</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        // function total_val() {
        //     var total_deduc = $('#amount_deduc').val();
        //     var total_amount = $('#amount_total').val();
        //     var totals = total_amount - total_deduc;
        //     $('#total').val(totals);
        // }
        $(function() {
            // $('#form-calculate').submit(function(e){
            //     $.ajax({
            //         url:'<?php echo $action; ?>',
            //         type: "POST",
            //         dataType: 'json',
            //         data: {data : $(this).serializeArray()},
            //         success: function(data){
            //             console.log(data);
            //         }
            //     })
            //     e.preventDefault();
            // });
            var totals = 0;
            $('#income').on('blur', function() {
                var salary = <?php echo (int)$employee_salary; ?>;
                totals = +$(this).val() + salary;
                // $('#amount_total').val(addCommas(totals));
                $('#amount_total').val(totals.toFixed(2));
            });
            var total_decrease = 0;
            $('.tax-amount').blur(function() {
                var sums = 0;
                $('.tax-amount').each(function() {
                    sums += Number($(this).val());
                });
                // $('#amount_deduc').val(addCommas(sums));
                $('#amount_deduc').val(sums.toFixed(2));
            });
            console.log($('#total').val());
            // var total_amount = sums;
            // console.log(total_amount);
            // $('#total').val(total_amount);
            $('.total_comma').change(function(){
                $(this).toFixed(2);
            });
            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
        });
    </script>
    <footer>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </footer>
</body>

</html>