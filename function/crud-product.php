<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet">

  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- FAVICON -->
  <link rel="shortcut icon" type="image/png" sizes="16x16" href="../assets/img/favicon.ico">
  <title>RGPI | Right Goods Philippines Inc.</title>
</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../rgpi-home.php">
        <div class="sidebar-brand-icon">
          <img src="../assets/img/icon2.png" class="rounded mx-auto d-block img-fluid mt-3"
            style="min-height: 5vw; width: 10vw;">
        </div>
      </a>

      <hr class="sidebar-divider mt-3 my-0">

      <li class="nav-item active">
        <a class="nav-link" href="../rgpi-home.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Operations Manager</span></a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Management
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-hand-holding-usd"></i>
          <span>Transaction</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Loan Orders</h6>
            <a class="collapse-item" href="../rgpi-transaction.php">Customers' Ordered Loans</a>
            <a class="collapse-item" href="../rgpi-loansummary.php">Summary of Ordered Loans</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../rgpi-addnewproduct.php">
          <i class="fas fa-cart-plus"></i>
          <span>Product Management</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
          aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-folder-open"></i>
          <span>Borrower's Information</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Profile:</h6>
            <a class="collapse-item" href="../rgpi-borrowersprofile.php">Customer Profile</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        USERS' CREDENTIALS
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fas fa-user-plus"></i>
          <span>USERS' CREDENTIALS</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Signup KAE:</h6>
            <a class="collapse-item" href="../rgpi-kaelist.php">Users' List</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <h6>USERNAME :</h6>
                <div class="topbar-divider d-none d-sm-block"></div>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase">
                  <?php $username = "username : "; echo $_SESSION['rgpi-name']; ?>
                </span>
                <i class="fas fa-power-off fw-bold text-danger"></i>
              </a>

              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../rgpi-logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>
        </nav>

        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-footer">
                <button class="btn-sm btn-primary" type="button" data-dismiss="modal">Cancel</button>
                <form action="../rgpi-logout.php" method="POST">
                  <button type="submit" name="logout_btn" class="btn-sm btn-success">Logout</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
          AOS.init();
        </script>
        <script src="../vendor/jquery/jquery-3.3.1.js"></script>
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/jquery/sweetalert2.all.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>


        <script src="js/sb-admin-2.min.js"></script>
        <script src="../vendor/chart.js/Chart.min.js"></script>
        <script src="../js/demo/chart-area-demo.js"></script>
        <script src="../js/demo/chart-pie-demo.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>


<?php
    include "../lib/config.php";
    /* ADD PRODUCT */
    if(isset($_POST['btn-add-product']))
    {
        $product_image = $_FILES["product_image"]['name'];
        $product_category = $_POST['category'];
        $product_name = $conn -> real_escape_string(ucwords($_POST['product_name']));
        $product_price = $_POST['product_price'];

     
        if (file_exists("../assets/img/new-product/" . $_FILES["product_image"]['name'])) {
            $store = $_FILES["product_image"]['name'];
            echo "Image Already Exists. '.$store.'";
        }
        else
        {
            include "../lib/config.php";

            $conn = new mysqli('localhost','root','','rgpi');
            $query = "INSERT INTO addnewproduct (`category`,`productName`,`productImage`,`productPrice`) VALUES ('$product_category','$product_name','$product_image','$product_price')";
            $query_run = mysqli_query($conn,$query);
    
                if ( $query_run) 
                {
                    move_uploaded_file($_FILES["product_image"]['tmp_name'], "../assets/img/new-product/" . $_FILES["product_image"]['name']);
                    echo '
      
                    <div class="container-fluid">
                    <div class="card" >
                    <div class="card-body">
                        <div class="col-sm-12 col-md-12 col-lg-12 alert alert-success align-middle">
                            <h6 class="fw-bold text-center">
                            Product has been added!</h6>
                        </div>
                        <a href="../rgpi-addnewproduct.php">
                        <button type="button" class="btn-sm btn-primary float-end p-3">Go back to Product Management</button> 
                        </a>
                    </div>
                    </div>
                    </div>
                    ';
                    exit();
                }
                else
                {

                    echo '
                    <div class="container-fluid">
                    <div class="card" >
                    <div class="card-body">
                        <div class="col-sm-12 col-md-12 col-lg-12 alert alert-danger align-middle">
                            <h6 class="fw-bold text-center">
                            Product not uploaded!</h6>
                        </div>
                        <a href="../rgpi-addnewproduct.php">
                        <button type="button" class="btn-sm btn-primary float-end p-3">Go back to Product Management</button> 
                        </a>
                    </div>
                    </div>
                    </div>
                    ';
                    exit();
                }
        }
    }

    /* DELETE PRODUCT BUTTON */
    if (isset($_POST['btn-delete-product'])) 
    {
        $product_id = $_POST['btn_delete_id'];
        $conn = new mysqli('localhost','root','','rgpi');
        $query = "DELETE FROM addnewproduct WHERE id='$product_id' ";
        $query_run = mysqli_query($conn,$query);

        if ($query_run) 
        {
            echo '
            <div class="container-fluid">
            <div class="card" >
            <div class="card-body">
                <div class="col-sm-12 col-md-12 col-lg-12 alert alert-success align-middle">
                    <h6 class="fw-bold text-center">
                    Product has been deleted!</h6>
                </div>
                <a href="../rgpi-addnewproduct.php">
                <button type="button" class="btn-sm btn-primary float-end p-3">Go back to Product Management</button> 
                </a>
            </div>
            </div>
            </div>
            ';
            exit();
        }
        else
        {
            echo '
            <div class="container-fluid">
            <div class="card" >
            <div class="card-body">
                <div class="col-sm-12 col-md-12 col-lg-12 alert alert-success align-middle">
                    <h6 class="fw-bold text-center">
                    Product has not deleted!</h6>
                </div>
                <a href="../rgpi-addnewproduct.php">
                <button type="button" class="btn-sm btn-primary float-end p-3">Go back to Product Management</button> 
                </a>
            </div>
            </div>
            </div>
            ';
           
            exit();
        }

    }
?>
<?php 
    include '../include/scripts.php';
    include '../include/rgpi-footer.php'; 
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/af-2.4.0/b-2.2.3/fc-4.1.0/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/af-2.4.0/b-2.2.3/fc-4.1.0/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>