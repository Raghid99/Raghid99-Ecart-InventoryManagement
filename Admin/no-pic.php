
<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>


<style>
.float{
float:left;
margin-right: 95px;
margin-top: 3px;
}
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
        <h5 class="modal-title"  id="exampleModalLabel">Add Image For the Items</h5>
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
        ALL Items
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="products.php">ALL</a>
        <a class="dropdown-item" href="no-pic.php">Items With No Image</a>
      </div>
    </div>
    </div>
  <div class="card-body">
      <div class="grid-container">
<?php

$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
$query1="SELECT * FROM product WHERE pic IS NULL;";
$query_run=mysqli_query($connection,$query1);
if(mysqli_num_rows($query_run)>0){
while($row=mysqli_fetch_assoc($query_run)){
?>

        <div class="grid-item">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="<?php echo $row['pic']; ?>" alt="<?php echo $row['productname']." Image.";?>">
          <div class="card-body">
            <h5 class="card-title text-gray-900"><?php echo $row['productname']; ?></h5>
            <p class="card-text"><?php echo"Category: ".$row['category']."</br>Description: ".$row['des']?></p>
              <input type="button" data-toggle="modal"data-target="#addImg" class="btn btn-success disabled" value="<?php echo "LBP ". $row['price']; ?>"/>
              <form method="POST" enctype="multipart/form-data" >
              <input type="file" name="image" style="margin-top:4px;"/>
              <input type="hidden" name="pic_id" value="<?php echo $row['id'];?>"/>
              <button type="submit" name="add-btn" class="btn btn-outline-success" style="float:right;">Add Image<?php// echo $row['status']; ?></button>
            </form>
          </div>
        </div>
      </div>



      <?php
      }

      }
      else {echo "No Product content";}
      ?>
          </div>
</div>
<!--Body Card-->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");

  $updtid=$_POST['pic_id'];


         $destination = "ProductPhoto/".$_FILES['image']['name'];
         $filename    = $_FILES['image']['tmp_name'];

        move_uploaded_file($filename, $destination);

         $query="UPDATE product SET pic='$destination' where id='$updtid' ";
         $ret= mysqli_query($connection,$query);
        //header("Location:products.php");


}
?>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
