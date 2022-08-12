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
  <h6 class="m-0 font-weight-bold text-primary">Order History
    <form style="float:right" method='post' action='invoice-db.php'>
    <select name='idorder'>
      <?php
        //show invoices list as options
        $query7 = mysqli_query($connection,"select distinct idorder from adminpanel.order where statusid like 1");
        while($invoice = mysqli_fetch_array($query7)){
          echo "<option value='".$invoice['idorder']."'>" .$invoice['idorder']. "</option>";
        }
      ?>
    </select>
    <input type='submit' value='Generate'>
  </form>
  </h6>
</div>
<?php $query="SELECT distinct idorder,customer_name, customer_phone,name,description,order_date,served_date
from adminpanel.order,customer,employee,status
where adminpanel.order.idcustomer=customer.idcustomer and adminpanel.order.user_name=employee.user_name and adminpanel.order.statusid=status.statusid";
$query_run=mysqli_query($connection,$query);?>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="width:10%;"> Order No. </th>
            <th style="width:15%;"> Customer Name </th>
            <th style="width:15%;"> Phone </th>
            <th style="width:15%;"> Served By </th>
            <th style="width:15%;"> Status </th>
            <th style="width:15%;"> Order Date </th>
            <th style="width:15%;"> Served Date </th>
          </tr>
        </thead>

        <tbody>
        <?php  if(mysqli_num_rows($query_run)>0){

            while(  $row=mysqli_fetch_assoc($query_run)){


              ?>

          <tr>
            <td><?php echo $row['idorder']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['customer_phone']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td><?php echo $row['served_date']; ?></td>
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
