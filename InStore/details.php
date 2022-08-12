<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Orders Details To be Prepared
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
<div class="card-body">
  <?php
    if(isset($_POST['idorder'])){
      $idd=$_POST['detail_id'];
      $query6="SELECT adminpanel.order.idorder, productname,quantity,price
              FROM adminpanel.order,product
              WHERE adminpanel.order.id=product.id
              and adminpanel.order.idorder='$idd'";
              $query_run2=mysqli_query($connection,$query6);
              ?>
              <table class="table table-bordered">
                <tr>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>

          <?php
              foreach ($query_run2 as $row2) {
                ?>
                <tr>
                <td><?php echo $row2['productname'];?></td>
                <td><?php echo $row2['quantity']."x" ;?></td>
                <td><?php echo $row2['price'];?></td>
                </tr>
                <?php
                 }
              ?>
          </table>

        <?php

    }

  ?>
  <a href="instore-index.php" class="btn btn-secondary">Close</a>
  </div>
</div>

</div>
<!-- /.container-fluid -->








<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
