
<?php
include('security.php');

if(isset($_POST['login_btn']))
{
    $user_name = mysqli_real_escape_string($connection, $_POST["user_name"]);
    $password_login = mysqli_real_escape_string($connection, $_POST["passwordd"]);
    //$user_name = $_POST['user_name'];
    //$password_login = $_POST['passwordd'];
    $password_login=md5($password_login);
    $query = "SELECT * FROM employee WHERE user_name='$user_name' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);
/*
   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['Uname'] = $user_name;
        header('Location: index.php');
   }
   else
   {
        $_SESSION['status'] = "Username / Password is Invalid";
        header('Location: login.php');
   }
*/
$usertypes = mysqli_fetch_array($query_run);


if($usertypes['usertype'] == "admin")
{
    $_SESSION['Uname'] = $user_name;
    header('Location:Admin/index.php');
}
else if($usertypes['usertype'] == "delivery")
{
    $_SESSION['Uname'] = $user_name;
    header('Location:Delivery/delivery-index.php');
}
else if($usertypes['usertype'] == "inStore")
{
    $_SESSION['Uname'] = $user_name;
    header('Location:InStore/instore-index.php');
}

else
{
    $_SESSION['status'] = "Username / Password is Invalid";
    header('Location: login.php');
}
}
?>
