
<?php
session_start();
//include('includes/security.php');
include('includes/header.php');
include('includes/navbar.php');

?>
<style>
.layout{
  margin-left: 500px;
}
</style>

<script type="text/javascript">


	function RegisterValid()
	{


    var Name     =Registerform.name;
    var Uname    =Registerform.uname;
    var Password =Registerform.password;
    var email    =Registerform.email;
    //var phone    =Registerform.phone;
  //  var dob      =Registerform.dob;
    //var gender   =Registerform.gender;
    var address  =Registerform.address;


    if (Name.value == "")
    {
        window.alert("Please enter your name.");
        Name.focus();
        return false;
    }

    if (!/^[a-zA-Z]*$/g.test(Name.value)) {
        alert("Invalid Characters For Name");
        Name.focus();
        return false;
    }

    if (Uname.value == "")
    {
        window.alert("Please enter your username.");
        Uname.focus();
        return false;
    }
    if (Password.value == "")
    {
        window.alert("Please enter your Password.");
        Password.focus();
        return false;
    }

    if (email.value == "")
    {
        window.alert("Please enter your email.");
        email.focus();
        return false;
    }

     if (!validateCaseSensitiveEmail(email.value))
    {
        window.alert("Please enter a valid e-mail address.");
        email.focus();
        return false;
    }

    if (address.value == "")
    {
        window.alert("Please provide The Type of User");
        address.focus();
        return false;
    }



    return true;
}


function validateCaseSensitiveEmail(email)
{
 var reg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
 if (reg.test(email)){
 return true;
}
 else{
 return false;
 }
}

</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

         $name     =$_POST['name'];
         $uname    =$_POST['uname'];
         $Password =$_POST['password'];
         $password = md5($Password);
         $email    =$_POST['email'];
         $address  =$_POST['address'];



         $destination = "UserPhoto/".$_FILES['image']['name'];
         $filename    = $_FILES['image']['tmp_name'];

         move_uploaded_file($filename, $destination);

         $query="insert into employee(name,email,user_name,password,usertype,pic) values('$name','$email','$uname','$password','$address','$destination')";
         $ret= mysqli_query($connection,$query);

        echo '<script language="javascript">';
        echo 'alert("Registration successfully")';
        echo '</script>';
}
?>

<div class="container-fluid">

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Empolyee Data to be registered

    </h6>
  </div>
  <div class="card-body">
<div class="layout">
			<div class="row main">
				<div class="main-login main-center">
				<h3>Registration For Login</h5>
					<form method="POST" enctype="multipart/form-data"  name="Registerform"  onsubmit="return RegisterValid();" >
            <div class="form-row">
               <div class="form-group col-md-6">
                 <label>Name</label>
                 <input type="name" class="form-control"  name="name" id="name" placeholder="Name">
               </div>
               <div class="form-group col-md-6">
                 <label>UserName</label>
                 <input type="name" class="form-control" name="uname" id="uname"   placeholder="user name to Login...">
               </div>
             </div>
             <div class="form-group">
               <label>Password</label>
               <input type="password" class="form-control"name="password" id="password" placeholder="password">
             </div>
             <div class="form-group">
               <label >Email</label>
               <input type="text" class="form-control"name="email" id="email" placeholder="@example.com">
             </div>
             <div class="form-group">
               <label >Type Of User</label>
               <input type="text" class="form-control" name="address" placeholder="Delivery, InStore...">
             </div>
             <div class="form-group">
               <label>Picture for the employee</label>
               <div>
                 <div class="input-group">

                   <input type="file" name="image">
                 </div>
               </div>
             </div>

						<div class="form-group ">
							<input  type="submit"  id="button" class="btn btn-primary btn-lg btn-block login-button">
						</div>

					</form>
				</div>
			</div>
		</div>

  </div>
</div>

</div>

</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
