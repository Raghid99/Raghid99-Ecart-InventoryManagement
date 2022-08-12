<?php

//action.php

include('includes/connect.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		//$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
		$pname=$_POST["productname"];
		$result1 = $connect->query("SELECT productname FROM product WHERE productname ='$pname'");
		if($result1->rowCount() == 0) {
     // row not found, do stuff...
		$query = "
		INSERT INTO product (productname,barcode,price,category,des) VALUES ('".$_POST["productname"]."', '".$_POST["barcode"]."','".$_POST["price"]."','".$_POST["category"]."','".$_POST["des"]."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
		}
		else{	echo '<p>The Item Already Exists...</p>';}
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM product WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['productname'] = $row['productname'];
			$output['barcode'] = $row['barcode'];
			$output['price'] = $row['price'];
			$output['brand'] = $row['brand'];
			$output['category'] = $row['category'];
			$output['des'] = $row['des'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE product
		SET productname = '".$_POST["productname"]."',
		barcode = '".$_POST["barcode"]."',
		price = '".$_POST["price"]."',
		category = '".$_POST["category"]."',
		des = '".$_POST["des"]."'
		WHERE id = '".$_POST["hidden_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM product WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}

?>
