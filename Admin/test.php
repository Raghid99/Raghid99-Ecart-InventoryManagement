
<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<link rel="stylesheet" href="jquery-ui.css">
<script src="jquery.min.js"></script>
<script src="jquery-ui.js"></script>

        <div class="container-fluid">

          <!-- DataTales Example  && ADD Button-->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Product Data
			       <button type="button" name="add" id="add" class="btn btn-success btn-xs">
               Add Product
             </button>
           </h6>
           <form method="post" enctype="multipart/form-data">
             <span  style="float:right;margin-top:0px;">
            <label>Select Excel File</label>
            <input type="file" name="excel" />
            <input type="submit" name="import" class="btn btn-info" value="Import" />
          </span>
           </form>
			</div>

			<div class="table-responsive" id="user_data">
			</div>
		</div>
  </div>


		<div id="user_dialog" title="Add Data">
			<form method="post" id="user_form">
				<div class="form-group">
					<label>Enter product name</label>
					<input type="text" name="productname" id="productname" class="form-control" />
					<span id="error_first_name" class="text-danger"></span>
				</div>
        <div class="form-group">
          <label>Enter barcode</label>
          <input type="text" name="barcode" id="barcode" class="form-control" />
          <span id="error_first_name" class="text-danger"></span>
        </div>
        <div class="form-group">
          <label>Enter price</label>
          <input type="text" name="price" id="price" class="form-control" />
          <span id="error_first_name" class="text-danger"></span>
        </div>
        <div class="form-group">
          <label>Enter Category Name</label>
          <input type="text" name="category" id="category" class="form-control" />
          <span id="error_last_name" class="text-danger"></span>
        </div>
        <div class="form-group">
          <label>Enter the Description</label>
          <input type="text" name="des" id="des" class="form-control" />
          <span id="error_last_name" class="text-danger"></span>
        </div>
				<div class="form-group">
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
				</div>
			</form>
		</div>

		<div id="action_alert" title="Action">

		</div>

		<div id="delete_confirmation" title="Confirmation">
		<p>Are you sure you want to Delete this data?</p>
		</div>

    </body>
</html>




<script>
$(document).ready(function(){

	load_data();

	function load_data()
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data)
			{
				$('#user_data').html(data);
			}
		});
	}

	$("#user_dialog").dialog({
		autoOpen:false,
		width:400
	});

	$('#add').click(function(){
		$('#user_dialog').attr('title', 'Add Data');
		$('#action').val('insert');
		$('#form_action').val('Insert');
		$('#user_form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#user_dialog").dialog('open');
	});

	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var error_first_name = '';
		var error_last_name = '';
		if($('#productname').val() == '')
		{
			error_first_name = 'Product Name is required';
			$('#error_first_name').text(error_first_name);
			$('#productname').css('border-color', '#cc0000');
		}
		else
		{
			error_first_name = '';
			$('#error_first_name').text(error_first_name);
			$('#productname').css('border-color', '');
		}
		if($('#category').val() == '')
		{
			error_last_name = 'Category is required';
			$('#error_last_name').text(error_last_name);
			$('#category').css('border-color', '#cc0000');
		}
		else
		{
			error_last_name = '';
			$('#error_last_name').text(error_last_name);
			$('#category').css('border-color', '');
		}

		if(error_first_name != '' || error_last_name != '')
		{
			return false;
		}
		else
		{
			$('#form_action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#user_dialog').dialog('close');
					$('#action_alert').html(data);
					$('#action_alert').dialog('open');
					load_data();
					$('#form_action').attr('disabled', false);
				}
			});
		}

	});

	$('#action_alert').dialog({
		autoOpen:false
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#productname').val(data.productname);
        $('#barcode').val(data.barcode);
        $('#price').val(data.price);
        $('#category').val(data.category);
        $('#des').val(data.des);
				$('#user_dialog').attr('title', 'Edit Data');
				$('#action').val('update');
				$('#hidden_id').val(id);
				$('#form_action').val('Update');
				$('#user_dialog').dialog('open');
			}
		});
	});

	$('#delete_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var action = 'delete';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id, action:action},
					success:function(data)
					{
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
	});

});
</script>
<!--IMPORTING EXCEL FILE TO THE DATABASE  -->
<?php
$connect = mysqli_connect("localhost", "root", "Robin.hood99", "adminpanel");
$output = '';
if(isset($_POST["import"]))
{
$_extension=explode(".", $_FILES["excel"]["name"]);
 $extension = end($_extension); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("lib/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
    {

    $productname = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $barcode = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $price = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $brand = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $category = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
    $status = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
    $des= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());


    $query = "INSERT INTO product(productname,barcode,price,brand,category,status,des) VALUES ('".$productname."',  '".$barcode."', '".$price."', '".$brand."','".$category."','".$status."','".$des."')";
    mysqli_query($connect, $query);
  }
 }
}
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}
?>




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
<?php
//include('includes/scripts.php');
include('includes/footer.php');
?>
