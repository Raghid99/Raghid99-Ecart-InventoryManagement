
<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="exampleModalLabel">Add Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form  method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Product Name </label>
                <input type="text" name="productname" class="form-control" placeholder="Enter Description">
            </div>
            <div class="form-group">
                <label>Expiry date</label>
                <input type="date" name="expirydate" class="form-control" placeholder="Enter the expirydate">
            </div>
            <div class="form-group">
                <label>Barcode</label>
                <input type="text" name="barcode" class="form-control" placeholder="Enter Barcode">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" placeholder="Enter the Price">
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="action" id="action"value="Insert" class="btn btn-primary"/>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

  <!-- DataTales Example  && ADD Button-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">DataTables Example
      <button type="button" name="add" id="add" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
        Add Product
      </h6>
      </button>
    </div>
    <!--Dialog for the form to enter-->

        <!--    End of Form   -->
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Expiry Date</th>
              <th>Barcode</th>
              <th>Price</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Product Name</th>
              <th>Expiry Date</th>
              <th>Barcode</th>
              <th>Price</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </tfoot>
          <tbody>
            <tr>
              <td class="details-control">Tiger Nixon</td>
              <td>System Architect</td>
              <td>Edinburgh</td>
              <td>61</td>
              <td>2011/04/25</td>
              <td>$320,800</td>
            </tr>
            <tr>
              <td>Garrett Winters</td>
              <td>Accountant</td>
              <td>Tokyo</td>
              <td>63</td>
              <td>2011/07/25</td>
              <td>$170,750</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->











<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
