<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');

?>



<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Insert An Image
    </h6>
  </div>
<div class="card-body">


  <form method="POST" enctype="multipart/form-data" >
    <input type="file" name="image"/>
    <input  type="submit" id="button" class="btn btn-primary">

  </form>
  <a href="products.php" class="btn btn-secondary">Close</a>
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");

  $updtid=$_POST['pic_id'];


         $destination = "ProductPhoto/".$_FILES['image']['name'];
         $filename    = $_FILES['image']['tmp_name'];

        move_uploaded_file($filename, $destination);

         $query="UPDATE product SET pic='$destination' where id='$updtid' ";
         $ret= mysqli_query($connection,$query);

}
?>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
