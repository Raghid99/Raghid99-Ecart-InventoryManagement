<?php
session_start();
//include('includes/security.php');
include('includes/header.php');
include('includes/navbar.php');
$connection = mysqli_connect("localhost","root","Robin.hood99","adminpanel");
?>
    <link rel="stylesheet" href="bill.css">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Phone Orders
    </h6>
  </div>


  <div class="card-body">

      <!-- BODY CONTENT-->
      <div class="grid">
          <div class="userDetails">
              <h2 style="text-align: center;">
                  Customer Details
              </h2>
              <ul class="nav nav-tabs nav-fill" id="customers" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link active" id="old-tab" data-toggle="tab" href="#oldcust" role="tab" aria-controls="old-customer" aria-selected="true">Returning customer</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="new-tab" data-toggle="tab" href="#newcust" role="tab" aria-controls="new-customer" aria-selected="false">New customer</a>
                  </li>
              </ul>
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="oldcust" role="tabpanel" aria-labelledby="home-tab">
                      <form method="post" action="fetchcus.php">
                        <input size="35" type="text" class="form-control" name="phoneid"  aria-describedby="emailHelp" placeholder="Enter Phone">
                        <div id="showids"></div>
                        <br>
                        <center>
                            <button type="button" name="getdetails" style="margin-bottom:10px;" class="btn btn-outline-info">Get details</button>
                        </center>
                  </form>
                        <div id="alertSuccess"></div>
                        <div class="modal-footer">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="newcust" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                                </div>
                                <input type="text" id="emailnew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                                </div>
                                <input type="text" id="namenew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Date of Birth</span>
                                </div>
                                <input type="date" id="dobnew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Contact</span>
                                    <span class="input-group-text" id="inputGroup-sizing-default">(+91)</span>
                                </div>
                                <input type="text" id="contactnew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
                                </div>
                                <input type="text" id="addressnew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div style="display: none;" class="alert alert-info alert-dismissible fade show new-customer-alert" role="alert"><center>
                                All details must be present!<br>Enter details of the new customer and click on 'Save'</center>
                            </div>
                        </div>
                        <div id="alertSuccessNew"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-info" onclick="saveNew()">Save</button>
                        </div>
                    </div>
                </div>
            </div>


      </div>









<!--END OF Body Content-->
    </div>
<!--modal-->
  </div>
</div>

</div>
<!-- /.container-fluid -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
