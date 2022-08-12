<?php
session_start();
//include('includes/security.php');
include('includes/header.php');
include('includes/navbar.php');
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
?>
<a href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/hover.css"/>
<style>
.hvr-bob:hover {
  margin: .4em;
  padding: 1em;
  cursor: pointer;
  background: white;
  text-decoration: none;
  color: #666;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-font-smoothing: antialiased;
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4 ">
      <div class="card border-left-primary shadow h-100 py-2  ">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Employees</div>
              <?php
              $sql1="SELECT COUNT(idemployee) as total FROM employee";
              $rslt1=mysqli_query($connection,$sql1);
              $r1=mysqli_fetch_assoc($rslt1);
              //$r1=mysqli_num_fields($rslt1);

              ?>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4>Total Employees: <?php echo $r1['total'];?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4 ">
      <div class="card border-left-info shadow h-100 py-2  ">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Served Order</div>
              <?php
              $sql2="SELECT COUNT(distinct idorder) as nb ,description from adminpanel.order,status WHERE adminpanel.order.statusid=status.statusid and  description like 'served'";
              $rslt2=mysqli_query($connection,$sql2);
              $r2=mysqli_fetch_assoc($rslt2);
              //$r1=mysqli_num_fields($rslt1);

              ?>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4>Served Orders: <?php echo $r2['nb'];?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <?php
    $sql3="SELECT COUNT(distinct idorder) as nb ,description from adminpanel.order,status WHERE adminpanel.order.statusid=status.statusid and  description like 'waiting'";
    $rslt3=mysqli_query($connection,$sql3);
    $r3=mysqli_fetch_assoc($rslt3);
    //$r1=mysqli_num_fields($rslt1);

    ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Wainting Orders</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <h4>  Waiting Orders: <?php echo $r3['nb'];?></h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>



  </div>

  <!-- Content Row -->








  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
