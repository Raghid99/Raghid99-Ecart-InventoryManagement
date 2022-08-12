<?php
require('fpdf182/fpdf.php');
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
$query9="SELECT adminpanel.order.idorder,customer_name,customer_address,customer_phone,order_date,productname,quantity,price
from adminpanel.order,product,customer
where adminpanel.order.id=product.id and adminpanel.order.idcustomer=customer.idcustomer and adminpanel.order.idorder=".$_POST['idorder'];
$result=mysqli_query($connection,$query9);
//$inv = mysqli_fetch_array($result);
$sql3="SELECT customer_name,customer_phone,Address,Address2,Description,City,Country FROM customer,location,adminpanel.order Where customer.LocationID=location.LocationID and adminpanel.order.idcustomer=customer.idcustomer and adminpanel.order.idorder=".$_POST['idorder'];
$result2=mysqli_query($connection,$sql3);
$dtls=mysqli_fetch_assoc($result2);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 5, 'Address:', 0, 0);
$pdf->Cell(58, 5,  $dtls['Address'], 0, 0);
$pdf->Cell(25, 5, 'CName:', 0, 0);
//$inv = mysqli_fetch_array($result);
$pdf->Cell(52, 5, $dtls['customer_name'], 0, 1);
$pdf->Cell(55, 5, 'Address2:', 0, 0);
$pdf->Cell(58, 5, $dtls['City'].' - '.$dtls['Country'], 0, 0);
$pdf->Cell(25, 5, 'Phone', 0, 0);
$pdf->Cell(52, 5, $dtls['customer_phone'], 0, 1);
$pdf->Cell(55, 5, 'Description:', 0, 0);
$pdf->Cell(58, 5, $dtls['Description'], 0, 1);
$pdf->Line(10, 30, 200, 30);
$pdf->Ln(10);

$pdf->Cell(55, 5, 'Item Name', 0, 0);
$pdf->Cell(58, 5, 'Quantity', 0, 0);
$pdf->Cell(59, 5, 'Price', 0, 1);
$total=0;
while($invoice=mysqli_fetch_assoc($result)){
$pdf->Cell(55, 5, $invoice['productname'], 0, 0);
$pdf->Cell(58, 5, $invoice['quantity']."x", 0, 0);
$pdf->Cell(59, 5, $invoice['price'], 0, 1);
$total+=$invoice['quantity']*$invoice['price'];
}


$pdf->Line(10, 240, 200, 240);
$pdf->Ln(2);

$pdf->Cell(58, 35, 'Total:', 0, 0);
$pdf->Cell(59, 35, 'LBP     '.number_format($total), 0, 1);
//$pdf->Cell(59, 0, 'Served By:', 0, 0);
//$pdf->Cell(59, 0, 'Name', 0, 1);

//$pdf->Cell(58, 5, ': 0', 0, 1);
//$pdf->Cell(55, 5, 'Product Service Charge', 0, 0);
//$pdf->Cell(58, 5, ': 0', 0, 1);
//$pdf->Cell(55, 5, 'Product Delivery Charge', 0, 0);
//$pdf->Cell(58, 5, ': 0', 0, 1);
//$pdf->Line(10, 60, 200, 60);
//$pdf->Ln(10);//Line break
//$pdf->Cell(55, 35, 'Paid by', 0, 0);
//$pdf->Cell(58, 35, ': Nawaraj Shah', 0, 1);
//$pdf->Line(155, 75, 195, 75);
//$pdf->Ln(5);//Line break
//$pdf->Cell(140, 5, '', 0, 0);
//$pdf->Cell(50, 5, ': Signature', 0, 1, 'C');
$pdf->Output();
?>
