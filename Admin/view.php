
<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>


<style>
.grid-container {
  display: grid;
  grid-gap: 50px 100px;
  grid-template-columns: auto auto auto;
  padding: 10px;
}
</style>




<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="exampleModalLabel">Add Product Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <!-- Page Heading -->

  <!-- DataTales Example  && ADD Button-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown button
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>

    </div>
    <div class="card-body">
        <div class="grid-container">
      <?php

      $connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
      $query1="SELECT * FROM employee";
      $query_run=mysqli_query($connection,$query1);
      if(mysqli_num_rows($query_run)>0){
      while($row=mysqli_fetch_assoc($query_run)){
      ?>
<div class="grid-item">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?php echo $row['pic'];?>" alt="<?php echo $row['name']." Image.";?>">
        <div class="card-body">
          <h5 class="card-title"><?php echo $row['name'];?></h5>
          <p class="card-text"><?php echo $row['email'];?></p>

        <form  method="POST">
        <input  type="text" size="10" name="rle" class="btn btn-primary" value ="<?php echo $row['usertype'];?>"/>
        <input type="hidden" name="update_id" value="<?php echo $row['idemployee']; ?>">
        <button type="submit" style="float:right;"  class="btn btn-primary ">Change Role</button>
        </form>
        </div>
      </div>
  </div>

            <?php
            }

            }
            else {echo "No Employee Registered yet";}
            ?>
          </div>

</div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


<!-- End of Main Content -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
$role=$_POST['rle'];
$idd=$_POST['update_id'];
$query="UPDATE employee SET usertype='$role' where idemployee='$idd' ";
$ret= mysqli_query($connection,$query);
}
?>






<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
