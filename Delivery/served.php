
<?php
session_start();
if(isset($_POST['served-btn'])){
  $connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
  $updtid=$_POST['update_id'];
  $statusid=1;
  $username=$_SESSION['Uname'];
  $query10="UPDATE adminpanel.order SET statusid='$statusid', user_name='$username' WHERE adminpanel.order.idorder='$updtid'";
  mysqli_query($connection,$query10);
  header('Location:delivery-index.php');
}

 ?>
