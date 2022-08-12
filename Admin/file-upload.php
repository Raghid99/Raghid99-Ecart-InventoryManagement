<?php
$con=mysqli_connect('localhost','root','Robin.hood99','adminpanel');

if(mysqli_connect_errno())
{
	echo 'Failed to connect to database'.mysqli_connect_error();
}

$uploadfile=$_FILES['uploadfile']['tmp_name'];

require 'lib/PHPExcel.php';
require_once 'lib/PHPExcel/IOFactory.php';

$objExcel=PHPExcel_IOFactory::load($uploadfile);
foreach($objExcel->getWorksheetIterator() as $worksheet)
{
	$highestrow=$worksheet->getHighestRow();

	for($row=0;$row<=$highestrow;$row++)
	{
		$productname=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
		$expirydate=$worksheet->getCellByColumnAndRow(1,$row)->getValue();
    $barcode=$worksheet->getCellByColumnAndRow(2,$row)->getValue();
    $price=$worksheet->getCellByColumnAndRow(3,$row)->getValue();
    $quantity=$worksheet->getCellByColumnAndRow(4,$row)->getValue();
		if($productname!='')
		{
			$insertqry="INSERT INTO `product`( `productname`, `expirydate`,'barcode','price','quantity') VALUES ('$productname','$expirydate','$barcode','$price','$quantity')";
			$insertres=mysqli_query($con,$insertqry);
		}
	}
}
header('Location: index0.php');
?>
