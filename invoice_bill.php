<?php
$con = new mysqli("localhost", "root", "", "invoice_db");

if(isset($_POST['submit'])){
    $invoice_no = $_POST['invoice_no'];
    $invoice_date = date("y-m-d",strtotime($_POST['invoice_date']));
    $cname = $_POST['cname'];
    $caddress = $_POST['caddress'];
    $ccity = $_POST['ccity'];
    $grand_total = $_POST['grand_total'];

    $sql1 = "INSERT INTO `customer`(`invoice_no`,`invoice_date`,`cname`,`caddress`,`ccity`,`grand_total`) VALUES ('{$invoice_no}','{$invoice_date}','{$cname}','{$caddress}','{$ccity}','{$grand_total}')";
    if($con->query($sql1)){
        $sid = $con->insert_id;

        $sql2 = "INSERT INTO `product`(`sid`,`pname`,`price`,`qty`,`total`) VALUES ";
        $rows = [];
        for($i=0;$i<count($_POST["pname"]);$i++){
            $pname = $_POST['pname'][$i];
            $price = $_POST['price'][$i];
            $qty = $_POST['qty'][$i];
            $total = $_POST['total'][$i];
            $rows[]= "('{$sid}','{$pname}','{$price}','{$qty}',{$total})";
        }
        $sql2.=implode(",",$rows);
        if($con->query($sql2)){
            echo "<div class='alert alert-success'>invoice added <button><a href='print.php?id={$sid}' class='btn btn-primary'> Click</a> </button></div>";
        }else{
            echo "<div class='alert alert-danger'>invoice added failed</div>".$con->error;
        }
    }else{
        echo "<div class='alert alert-danger'>invoice added failed</div>".$con->error;

    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/jquery-ui.css">
    <script src="./jquery file/jquery-3.6.4.js"></script>
    <script src="./jquery file/jquery-ui.js"></script>
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
    <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-10 border border-info p-2">
        <h1 class="text-center text-primary fw-bold py-3">INVOICE</h1>

                <form action="invoice_bill.php" autocomplete="on" method="post" class="">
                    <div class="row">
                        <div class="col-xl-4">
                            <h5 class="text-success text-center">Invoice Details</h5>
                            <div class="mb-4">
                                <label for="invoice" class="form-label">Invoice Number</label>
                                <input type="text" class="form-control" aria-describedby="emailHelp" name="invoice_no" id="invoice_no" required>
                            </div>
                            <div class="mb-4">
                                <label for="Date" class="form-label">Date</label>
                                <input type="text" class="form-control" id="date" name="invoice_date" required>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <h5 class="text-success text-center">Customer Details</h5>
                            <div class="mb-2 mx-5">
                                <label for="name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" aria-describedby="emailHelp" name="cname" required>
                            </div>
                            <div class="mb-2 mx-5">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" aria-describedby="emailHelp" name="caddress" required>
                            </div>
                            <div class="mb-2 mx-5">
                                <label for="address" class="form-label">City</label>
                                <input type="text" class="form-control" aria-describedby="emailHelp" name="ccity" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <h5 class="text-success text-center">Product Details</h5>
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="product_tbody">
                                    <tr>
                                        <td><input type="text" required name="pname[]" class="form-control"></td>
                                        <td><input type="text" required name="price[]" class="form-control price"></td>
                                        <td><input type="text" required name="qty[]" class="form-control qty"></td>
                                        <td><input type="text" required name="total[]" class="form-control total"></td>
                                        <td><input type="button" value="x" class="btn btn-danger btn-sm btn-remove"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="button" value="+ Add Row" class="btn btn-primary btn-sm"
                                                id="btn-add-row"></td>
                                        <td colspan="2" class="text-end fw-bold ">Total</td>
                                        <td><input type="text" name="grand_total" id="grand_total" class="form-control"></td>
                                    </tr>
                                </tfoot>
                            </table>
        
                        </div>
                    </div>
                    <div class="row">

                        <button type="submit" name="submit" class="btn btn-success w-50 mx-auto my-5">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-xl-1"></div>
        </div>
    </div>



    <script>
        $(document).ready(function () {

            // invoice num generate.....
            var cdate = new Date();
            var year =cdate.getFullYear();
            var month =cdate.getMonth()+1;
            var day = cdate.getDate();
            var hr =cdate.getHours();
            var min =cdate.getMinutes();
            var sec =cdate.getSeconds();

            var invoicenum = year+''+month+''+day+''+hr+''+min+''+sec;

            $('#invoice_no').val(invoicenum);

            // date picker.....

            $("#date").datepicker({
                dateFormat: "dd-mm-yy"
            });

            // Add new rows....
            $("#btn-add-row").click(function () {
                var row = "<tr> <td><input type='text' required name='pname[]' class='form-control'></td><td><input type='text' required name='price[]' class='form-control price'></td><td><input type='text' required name='qty[]' class='form-control qty'></td><td><input type='text' required name='total[]' class='form-control total'></td><td><input type='button' value='x' class='btn btn-danger btn-sm btn-remove'></td></tr>";
                $("#product_tbody").append(row);
            });

            //remove rows......
            $("body").on("click", ".btn-remove", function () {
                if (confirm("Are you sure?")) {
                    $(this).closest("tr").remove();
                    grand_total()
                }
            });

            // calculate the values....
            $("body").on("keyup", ".price", function () {
                var price = Number($(this).val());
                var qty = Number($(this).closest("tr").find(".qty").val());
                $(this).closest("tr").find(".total").val(price * qty);
                grand_total()
            });
            $("body").on("keyup", ".qty", function () {
                var qty = Number($(this).val());
                var price = Number($(this).closest("tr").find(".price").val());
                $(this).closest("tr").find(".total").val(price * qty);
                grand_total()
            });
            function grand_total() {
                var tot = 0;
                $(".total").each(function () {
                    tot += Number($(this).val())
                });
                $("#grand_total").val(tot);
            }
        });

       
    </script>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>