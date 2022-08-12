
<?php
session_start();
//include('includes/security.php');
include('includes/header.php');
include('includes/navbar.php');
$u_name=$_SESSION['Uname'];
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
$sql="SELECT * FROM employee Where user_name='$u_name'";
$result=mysqli_query($connection,$sql);
$info=mysqli_fetch_assoc($result);
?>
<style>
.layout{
  margin-left: 500px;
}
</style>
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit your Profile
    </h6>
  </div>
<div class="card-body">
  <div class="layout">
  			<div class="row main">
  				<div class="main-login main-center">
  				<h3>Edit Your Profile</h5>
  					<form method="POST">
              <div class="form-row">
                 <div class="form-group col-md-6">
                   <label for="inputEmail4">Name</label>
                   <input type="name" class="form-control"  name="name"  value="<?php echo $info['name'];?>">
                 </div>
                 <div class="form-group col-md-6">
                   <label for="inputPassword4">UserName</label>
                   <input type="name" class="form-control" name="uname"   value="<?php echo $info['user_name'];?> ">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputAddress">Password</label>
                 <input type="password" class="form-control"name="password1"  value="<?php echo $info['password'];?>">
               </div>
               <div class="form-group">
                 <label for="inputAddress2">Confirm Password</label>
                 <input type="password" class="form-control" name="password2"  value="<?php echo $info['password'];?>">
               </div>
               <div class="form-group">
                 <label for="inputAddress2">Email</label>
                 <input type="email" class="form-control" name="email" value="<?php echo $info['email'];?>">
               </div>
  						<div class="form-group ">
                	<input  type="hidden" name="edit_id" value="<?php echo $info['idemployee']; ?>" >
  							<input  type="submit" name="edit_btn" value="Edit"  id="button" class="btn btn-primary btn-lg btn-block login-button">
  						</div>
  					</form>
  				</div>
  			</div>
  		</div>
      <?php
        if(isset($_POST['edit_btn'])){
              if($_POST['password1']==$_POST['password2']){
                  $updt=$_POST['edit_id'];
                $sql2="UPDATE employee SET name='".$_POST['name']."',
                                            email='".$_POST['email']."',
                                            user_name='".$_POST['uname']."',
                                            password='".$_POST['password1']."'
                                            Where idemployee='$updt'";
                mysqli_query($connection,$sql2);
              }
              else echo"Check The Password";
        }
       ?>

</div>
</div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
