<?php
session_start();
//include('includes/security.php');
include('includes/header.php');
include('includes/navbar.php');
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
?>
    <link rel="stylesheet" href="bill.css">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Phone Orders
    </h6>
  </div>
  <?php
    if(isset($_POST['getdetails'])){
      $phone=$_POST['phoneid'];
      $sql="SELECT * FROM customer where customer_phone='$phone'";
      $query_run=mysqli_query($connection,$sql);
      $row=mysqli_fetch_assoc($query_run);
  ?>
  <div class="card-body">


          <div class="cars">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Address 1</th>
                  <th scope="col"></th>
                  <th scope="col">Address 2</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><?php echo $row['customer_name']; ?></th>
                  <td><?php echo $row['customer_address']; ?></td>
                  <td></td>
                  <td><?php echo $row['customer_address']; ?></td>
                </tr>

                <tr>
                  <th scope="row">ID</th>
                  <td></td>
                  <td></td>
                  <td>"<?php echo $row['idcustomer']; ?>"</td>
                </tr>

              </tbody>
            </table>
              <button style="float: right;" type="button" class="btn btn-secondary">Confirm Order!</button>
          </div>
      </div>









<!--END OF Body Content-->
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
