
<?php
session_start();
//include('includes/security.php');
include('includes/header.php');
include('includes/navbar.php');
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");


?>

  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Orders To be Prepared for Store
      <form style="float:right" method='post' action='invoice-db.php'>
			<select name='idorder'>
				<?php
					//show invoices list as options
					$query7 = mysqli_query($connection,"select distinct idorder from adminpanel.order where statusid like 0 and adminpanel.order.orderfor like 'store'");
					while($invoice = mysqli_fetch_array($query7)){
						echo "<option value='".$invoice['idorder']."'>" .$invoice['idorder']. "</option>";
					}
				?>
			</select>
			<input type='submit' value='Generate'>
    </form>
    </h6>
  </div>

  <?php $query5="SELECT distinct idorder, customer_name, customer_address,customer_phone,description,order_date
           FROM adminpanel.order,customer,status
           WHERE adminpanel.order.idcustomer=customer.idcustomer and adminpanel.order.statusid=status.statusid and  adminpanel.order.statusid like 0 and adminpanel.order.orderfor like 'store'";
  $query_run=mysqli_query($connection,$query5);?>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="width:15%;"> Order No. </th>
            <th style="width:15%;"> Customer Name </th>
            <th style="width:15%;"> Phone </th>
            <th style="width:15%;"> Address </th>
            <th style="width:15%;"> Status </th>
            <th style="width:15%;"> Order Date </th>
            <th style="width:10%;"> Show Details </th>
          </tr>
        </thead>

        <tbody>
        <?php  if(mysqli_num_rows($query_run)>0){

            while(  $row=mysqli_fetch_assoc($query_run)){
            //  $_GLOBAL['z']=$row['idorder'];
            //  $customer_name=$row['customer_name'];
            //  $customer_phone=$row['customer_phone'];
            //  $customer_address=$row['customer_address'];
            //  $date=$row['order_date'];

              ?>

          <tr>
            <td><?php echo$row['idorder']; ?> </td>
            <td><?php echo $row['customer_name']; ?>  </td>
            <td><?php echo $row['customer_phone']; ?>  </td>
            <td><?php echo $row['customer_address']; ?>  </td>
            <td><?php echo $row['description']; ?>  </td>
            <td><?php echo $row['order_date']; ?>  </td>

            <td>

                  <form  method="post" action="details.php">
                  <input type="hidden" name="detail_id" value="<?php echo $row['idorder']; ?>">
                  <button type="submit" name="idorder"  style="float:right;padding-right: 5px;padding-left: 5px;" class="btn btn-danger"> DETAILS </button>
                  </form>
                  <form  method="post" action="served.php">
                  <input type="hidden" name="update_id" value="<?php echo $row['idorder']; ?>">
                  <button type="submit" name="served-btn" style="float:left;margin-top:8px;padding-right: 5px;padding-left: 5px;"   class="btn btn-success btn-circle btn-sm "><i class="fas fa-check"></i> </button>
                  </form>
            </td>
          </tr>




          <?php
          //$idd=$row['idorder'];
        //  $idorder[]=$idd;
          //$idd=$row['idorder'];


        }
     }
     else {echo "No content";}
    //  print_r($idorder);
      ?>
        </tbody>
      </table>
    </div>
<!--modal-->
  </div>
</div>

</div>
<!-- /.container-fluid -->




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
