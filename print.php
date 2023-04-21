<?php
include "<fpdf185/fpdf.php";

ob_start();
// $info=[
//       'customer'=>,
//       'address'=>,
//       'city'=>,
//       'invoice_no'=>,
//       'invoice_date'=>,
//       'total_amt'=>'

// ];

// $product_info=[

// ];

$con = new mysqli("localhost", "root", "", "invoice_db");
$id = $_GET['id'];
$sql = "SELECT * FROM `customer` WHERE sid = '$id'";
$result=mysqli_query($con,$sql);
if($result){
    $row = mysqli_fetch_assoc($result);
    
$info=[
    'customer'=>$row['cname'],
    'address'=>$row['caddress'],
    'city'=>$row['ccity'],
    'invoice_no'=>$row['invoice_no'],
    'invoice_date'=>date("d-m-y",strtotime($row['invoice_date'])),
    'total_amt'=>$row['grand_total'],

];
}
$product_info=[];
$sql= "SELECT * FROM `product` WHERE sid = '$id'";

$result = mysqli_query($con,$sql);
if($result){
    while($row=mysqli_fetch_assoc($result)){
    $product_info=[
        [
            'name'=>$row["pname"],
            'price'=>$row['price'],
            'qty'=>$row['qty'],
            'total'=>$row['total']
        ],
        
    ];
}
}

class pdf extends fpdf
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(50, 10, "ABC Enterprices", 0, 1);
        $this->SetFont('Arial', '', 14);
        $this->Cell(50, 7, "North Street", 0, 1);
        $this->Cell(50, 7, "Tirunelveli-627354", 0, 1);
        $this->Cell(50, 7, "Phone: 6379873628", 0, 1);


        $this->SetY(10);
        $this->SetX(-35);
        $this->SetFont('Arial','B',18);
        $this->Cell(50,10,"INVOICE");
 
        $this->Line(0,48,210,48);
     
    }

    function bill($info,$product_info){
        $this->SetY(55);
        $this->SetX(10);
        $this->Cell(60,10,"Bill TO:",0,1);
        $this->SetFont('Arial','',12);
        $this->Cell(50,7,$info['customer'],0,1);
        $this->Cell(50,7,$info['address'],0,1);
        $this->Cell(50,7,$info['city'],0,1);

        $this->SetY(55);
        $this->SetX(-65);
        $this->Cell(50,7,'Invoice No:'.$info['invoice_no']);

        $this->SetY(63);
        $this->SetX(-65);
        $this->Cell(50,7,'Invoice Date:'.$info['invoice_date']);

        $this->SetY(95);
        $this->SetX(10);
        $this->SetFont('Arial','B',12);
        // $this->Cell(15, 10, "S.No", 1, 0, "C");
        $this->Cell(70, 10, "Product Name", 1, 0, "C");
        $this->Cell(40, 10, "Price", 1, 0, "C");
        $this->Cell(25, 10, "Qty", 1, 0, "C");
        $this->Cell(45, 10, "Total", 1, 1, "C");


            $con = new mysqli("localhost", "root", "", "invoice_db");

        $id = $_GET['id'];
        $sql= "SELECT * FROM `product` WHERE sid = '$id'";

        $result = mysqli_query($con,$sql);
        if($result){
         while($row=mysqli_fetch_assoc($result)){
                $this->Cell(70,10,$row['pname'],"LR",0);
                $this->Cell(40,10,$row['price'],"R",0,"R");
                $this->Cell(25,10,$row['qty'],"R",0,"C");
                $this->Cell(45,10,$row['total'],"R",1,"R");

         }}
        // foreach($product_info as $row){
        //     $this->Cell(70,10,$row['name'],"LR",0);
        //     $this->Cell(40,10,$row['price'],"R",0,"R");
        //     $this->Cell(25,10,$row['qty'],"R",0,"C");
        //     $this->Cell(45,10,$row['total'],"R",1,"R");
        // }
        for($i=0;$i<12-count($product_info);$i++)
        {
            $this->Cell(70,10,"","LR",0);
            $this->Cell(40,10,"","R",0,"R");
            $this->Cell(25,10,"","R",0,"C");
            $this->Cell(45,10,"","R",1,"R");
        }
        $this->Cell(135,10,"Total",1,0,"R");
        $this->Cell(45,10,$info['total_amt'],1,1,"R");

    }

    function Footer(){
        $this->SetY(-35);
        $this->SetFont("Arial","B",12);
        $this->Cell(0,10,"For ABC COMPUTERS",0,1,"R");
        $this->Ln(5);
        $this->SetFont("Arial","",12);
        $this->Cell(0,10,"Authorised Signature",0,1,"R");
        $this->SetFont("Arial","",10);
        $this->Cell(0,10,"This is a Computer Generated invoice",0,1,"C");



    }

}
$pdf = new pdf("P", "mm", "A4");
$pdf->AddPage();
$pdf->bill($info,$product_info);
$pdf->Output();


ob_end_flush();


?>