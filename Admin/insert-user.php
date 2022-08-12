<?php
if (isset($_POST['empregister'])) {
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");

         $name     =$_POST['name'];
         $uname    =$_POST['uname'];
         $Password =$_POST['password'];
         $email    =$_POST['email'];
         $address  =$_POST['address'];


         $destination = "UserPhoto/".$_FILES['image']['name'];
         $filename    = $_FILES['image']['tmp_name'];

         move_uploaded_file($filename, $destination);

         $query="insert into employee(name,email,user_name,password,usertype,pic) values('$name','$email','$uname','$Password','$address','$destination')";
         $ret= mysqli_query($connection,$query);

        echo '<script language="javascript">';
        echo 'alert("Registration successfully")';
        echo '</script>';
        header('Location:empregister.php');
      }

?>
