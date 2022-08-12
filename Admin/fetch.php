<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php

//fetch.php


include('includes/connect.php');

$query = "SELECT * FROM product";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$total_row = $statement->rowCount();
$output = '
<div class="card-body">
	<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
	<tr>
		<th>Product Name</th>
		<th>Barcode</th>
		<th>Price</th>
		<th>Category</th>
		<th>Description</th>
		<th>Edit/Delete</th>
	</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Product Name</th>
			<th>Barcode</th>
			<th>Price</th>
			<th>Category</th>
			<th>Description</th>
			<th>Edit/Delete</th>
		</tr>
	</tfoot>
';
if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tbody>
		<tr>
			<td width="15%">'.$row["productname"].'</td>
			<td width="15%">'.$row["barcode"].'</td>
			<td width="15%">'.$row["price"].'</td>
			<td width="15%">'.$row["category"].'</td>
			<td width="20%">'.$row["des"].'</td>
			<td width="10%">
				<button type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$row["id"].'">Edit</button>
				<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>
			</td>
		</tr>
		</tbody>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">Data not found</td>
	</tr>
	';
}
$output .= '</table>      </div>
    </div>
  </div>
	</div>
	<!-- /.container-fluid -->

	</div>
	<!-- End of Main Content -->';
echo $output;
?>

<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
