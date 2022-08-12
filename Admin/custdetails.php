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
  <h6 class="m-0 font-weight-bold text-primary">Customer Information
  </h6>
</div>
<?php $query="SELECT customer_name,customer_phone,customer_email,Address,Address2,Description,City,Country from customer,location where  customer.locationID=location.LocationID";
$query_run=mysqli_query($connection,$query);?>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="width:10%;">Customer Name</th>
            <th style="width:10%;">Phone</th>
            <th style="width:10%;">Email</th>
            <th style="width:15%;">Address</th>
            <th style="width:15%;">Address2</th>
            <th style="width:20%;">Description</th>
            <th style="width:10%;">City</th>
            <th style="width:10%;">Country</th>
          </tr>
        </thead>

        <tbody>
        <?php  if(mysqli_num_rows($query_run)>0){

            while(  $row=mysqli_fetch_assoc($query_run)){


              ?>

          <tr>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['customer_phone']; ?></td>
            <td><?php echo $row['customer_email']; ?></td>
            <td><?php echo $row['Address']; ?></td>
            <td><?php echo $row['Address2']; ?></td>
            <td><?php echo $row['Description']; ?></td>
            <td><?php echo $row['City']; ?></td>
            <td><?php echo $row['Country']; ?></td>
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
