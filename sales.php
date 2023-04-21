<?php
$con = new mysqli("localhost", "root", "", "invoice_db");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/jquery-ui.css">
    <script src="./jquery file/jquery-3.6.4.js"></script>
    <script src="./jquery file/jquery-ui.js"></script>
</head>

<body>
    <div class="container-fuid">
        <div class="container pt-5">
            <h1 class="text-center pb-5">Sales Report</h1>
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">Sid</th>
                        <th scope="col">Invoice No</th>
                        <th scope="col">Date</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $sql = "SELECT * FROM `customer`";
                    $res = mysqli_query($con, $sql);
                    // print_r($res);
                    if ($res) {

                        while ($row = mysqli_fetch_assoc($res)) {
                            $sid = $row['sid'];
                            $invoice_no = $row['invoice_no'];
                            $invoice_date = $row['invoice_date'];
                            $cname = $row['cname'];
                            $caddress = $row['caddress'];
                            $ccity = $row['ccity'];
                            $total = $row['grand_total'];



                            echo "<tr>
                    <th scope='row'>$sid</th>
                    <td>$invoice_no</td>
                    <td>$invoice_date</td>
                    <td>$cname</td>
                    <td>$caddress</td>
                    <td>$ccity</td>
                    <td>$total</td>
                    <td><button><a href='print.php?id=$sid'>click</a></button></td>
                    </tr>";
                        }
                    }


                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>