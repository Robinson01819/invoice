<?php
$con = new mysqli("localhost","root","","invoice_db");

if($con){
    echo "connect success";
}
else{
    echo "error".$con->error;
}

$sql1= "SELECT * FROM  `product` WHERE sid=9";
$result =mysqli_query($con,$sql1);

if($result){
    print_r($result);
    while($row = mysqli_fetch_assoc($result)){
            $pname = $row['pname'];
            $price = $row['price'];
            $qty = $row['qty'];
            $total = $row['total'];

        echo $pname."<br>";

        $product_info=[
            [
                'name'=>$row['pname'],
                'price'=>$row['price'],
                'qty'=>$row['qty'],
                'total'=>$row['total'],
            ]
        ];
        

    }
}

?>