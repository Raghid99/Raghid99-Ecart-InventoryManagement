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
</style>




<div class="container-fluid">
  <!-- Page Heading -->

  <!-- DataTales Example  && ADD Button-->
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown button
      </button>
      <button style="float:right;"data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Restock</button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="products.php">All</a>
        <a class="dropdown-item" href="unavailable-product.php">Unavailable</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>

    </div>
  <div class="card-body">
<?php

$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
$query2="SELECT * FROM product WHERE status='unavailable'";
$query_run=mysqli_query($connection,$query2);
if(mysqli_num_rows($query_run)>0){
while($row=mysqli_fetch_assoc($query_run)){
?>

      <div class="float">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="<?php echo $row['pic']; ?>" alt="<?php echo $row['productname']." Image.";?>">
          <div class="card-body">
            <h5 class="card-title text-gray-900"><?php echo $row['productname']; ?></h5>
            <p class="card-text"><?php echo"Category: ".$row['category']."</br>Description: ".$row['des']?></p>
              <input type="button" data-toggle="modal"data-target="#addImg" class="btn btn-success disabled" value="<?php echo "LBP ". $row['price']; ?>"/>
              <button type="button" style="margin-left:22px;" class="btn btn-outline-success"><?php echo $row['status']; ?></button>
          </div>
        </div>
      </div>


      <?php
      }

      }
      else {echo "No Product content";}
      ?>
</div>
<!--Body Card-->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php
if(isset($_POST["insert"]))
 {
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
      $query = "UPDATE  product SET pic= '".$file."' WHERE id = '".$_POST["hidden_id"]."' ";
      if(mysqli_query($connect, $query))
      {
           echo '<script>alert("Image Inserted into Database")</script>';
      }
 }

?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table-bordered">
          <tr>
            <th>Name</th>
            <th>Price</th>
          </tr>
      <?php
      $query3="SELECT *  FROM product WHERE status='unavailable'";
      $query_run=mysqli_query($connection,$query2);

      if(mysqli_num_rows($query_run)>0){
      while($row=mysqli_fetch_assoc($query_run)){
      ?>

          <tr>
          <td><?php echo $row['productname']?></td>
          <td><?php echo $row['price']?></td>
        </tr>
        <?php
      }

    }
    else {echo "No content";}

    ?>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Generate PDF</button>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
     $('#insert').click(function(){
          var image_name = $('#image').val();
          if(image_name == '')
          {
               alert("Please Select Image");
               return false;
          }
          else
          {
               var extension = $('#image').val().split('.').pop().toLowerCase();
               if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
               {
                    alert('Invalid Image File');
                    $('#image').val('');
                    return false;
               }
          }
     });
});
</script>






<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
