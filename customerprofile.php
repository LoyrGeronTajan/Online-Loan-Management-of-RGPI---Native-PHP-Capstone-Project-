<?php
    include 'include/navigation.php';
    include 'include/security.php';
?>

<head>
  <title>Customer Profile | Right Goods Philippines Inc.</title>
  <link rel="stylesheet" href="assets/css/customerProfile.css">
</head>
<?php
include 'lib/config.php';

if (isset($_POST['btn-update-userprofile'])) 
{
  $user_fullname = $_POST['user_fullname'];

  $user_company = $conn -> real_escape_string($_POST['user_companyname']);
  $user_address = $conn -> real_escape_string($_POST['user_companyaddress']);
  $user_phone = $_POST['user_phone'];
  $user_email = $_POST['user_email'];


  $conn = new mysqli('localhost','root','','rgpi');
  $query = "UPDATE tbl_member SET 
      fullname='$user_fullname',
      company='$user_company', 
      address='$user_address',
      phone='$user_phone',
      email='$user_email'
       WHERE username = '".$_SESSION['username']."'
  ";
  $query_run = mysqli_query($conn,$query);

  if ($query_run) 
  {
    echo '
    <script>
    swal({
        title: "Success!",
        timer: 3000,
        icon: "success",
        
    }).then(function() {
        window.location = "customerprofile.php";
    });

    </script>
    '; 

  }
}
/************************************************************************/

if (isset($_POST['btn-update-usercredential'])) 
{
 
    $user_username = $_POST['user_username'];
    $user_oldpassword = $_POST['user_oldpassword'];
    $user_newpassword = $_POST['user_newpassword'];
    $user_confirmpassword = $_POST['user_confirmpassword'];

    $password_query = mysqli_query($conn,"select password from tbl_member where id='".$_SESSION['id']."'");

    $password_row = mysqli_fetch_array($password_query);
    $database_password = $password_row['password'];
	  
      if ($user_newpassword !== $user_confirmpassword)
        {
          echo '
          <script>
          swal({
              title: "Password do not match!",
              timer: 3000,
              icon: "error",
              
          }).then(function() {
              window.location = "customerprofile.php";
          });
      
          </script>
          '; 
          
        }
      else
        {
          $user_oldpassword = password_hash($user_oldpassword, PASSWORD_DEFAULT);
          $user_newpassword = password_hash($user_newpassword, PASSWORD_DEFAULT);

          $update_pwd = mysqli_query($conn,"update tbl_member set password='$user_newpassword' where id='".$_SESSION['id']."'");
          echo '
          <script>
          swal({
              title: "Success!",
              timer: 3000,
              icon: "success",
              
          }).then(function() {
              window.location = "customerprofile.php";
          });
      
          </script>
          '; 
        }
}

if (isset($_POST['request'])) 
{
  
  $id = $_POST['id'];
  $conn = new mysqli('localhost','root','','rgpi');
  $query = "UPDATE tbl_member SET requestCreditlimit = 'request' WHERE id = '$id'";
  $query_run = mysqli_query($conn,$query);

  if ($query_run) {
    echo '<script>
          swal({
              
              title: "Request Submitted",
              icon: "success",
              timer: 5000,
              
          })
      </script>';  

      header("Refresh:1; url=customerprofile.php");
  } else {
     echo '<script>
          swal({
              
              title: "Something went wrong",
              icon: "error",
              timer: 5000,
              
          })
      </script>';  

      header("Refresh:1; url=customerprofile.php");
  }

 

       

}

?>



<div class="main-content">
  <!-- Top navbar -->
  <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="customerprofile.php">User profile</a>
    </div>
  </nav>

  <!-- Header -->
  <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
    style="min-height: 600px; background-image: url(assets/img/unique.png); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <?php
        include 'lib/config.php';
        /****** COMPANY INFORMATION ********/
        $sql_date = "SELECT * FROM tbl_member WHERE username = '".$_SESSION['username']."'";
        $query_run = mysqli_query($conn,$sql_date);
        $username = mysqli_fetch_array($query_run);
      ?>
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class="col-lg-7 col-md-10">
          <h1 class="display-4 text-white"><?php echo "Hello " . $username['fullname']; ?></h1>
          <p class="text-white mt-0 mb-5">This is your profile page. You can manage your accounts in this interface</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--9">
    <div class="row">

      <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">USER ACCOUNT</h3>
              </div>

              <!-- MODAL EDIT BUTTON -->
              <div class="col-4 text-right">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                  data-target="#editprofile">EDIT
                  PROFILE</button>
              </div>

            </div>
          </div>

          <!-- User Information -->
          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">User information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-username">Credit Limit</label>
                    <input type="text" id="input-username" class="form-control form-control-alternative"
                      value="&#8369; <?php echo number_format($username['creditLimit']);?>" disabled>
                  </div>
                </div>

                <?php
                  if ($username['status'] == '!approve' && $username['requestCreditlimit'] == 'request') {
                   ?>
                  <div class="col-lg-6">
                    <form action="customerprofile.php" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo $username['id']?>">
                      <button type="submit"
                            name="request" 
                            class="btn btn-md btn-success text-dark float-end"
                            data-bs-toggle="tooltip" 
                            title="Request"
                            disabled>Request to increase your credit limit
                      </button>
                    </form>
                </div>
                   <?php
                  } else {
                    ?>
                      <div class="col-lg-6">
                  <form action="customerprofile.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $username['id']?>">
                    <button type="submit"
                          name="request" 
                          class="btn btn-md btn-success text-dark float-end"
                          data-bs-toggle="tooltip" 
                          title="Request">Request to increase your credit limit
                    </button>
                  </form>
                  

                </div>

                    <?php
                  }
                ?>

                
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-email">Full Name</label>
                    <input type="email" id="input-email" class="form-control form-control-alternative"
                      value="<?php echo $username['fullname'];?>" disabled>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <hr class="my-4">

          <!-- Address -->
          <h6 class="heading-small text-muted mb-4">Company Information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-username">Name</label>
                  <input type="text" id="input-username" class="form-control form-control-alternative"
                    value="<?php echo $username['company'];?>" disabled>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">Address</label>
                  <input type="email" id="input-email" class="form-control form-control-alternative"
                    value="<?php echo $username['address'];?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-first-name">Contact Information</label>
                  <input type="text" id="input-first-name" class="form-control form-control-alternative"
                    placeholder="First name" value="<?php echo $username['phone'];?>" disabled>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-last-name">Email Address</label>
                  <input type="text" id="input-last-name" class="form-control form-control-alternative"
                    placeholder="Last name" value="<?php echo $username['email'];?>" disabled>
                </div>
              </div>
            </div>
          </div>

          <hr class="my-4">

          <!-- Change Password -->
          <h6 class="heading-small text-muted mb-4">Change Password</h6>
          <div class="pl-lg-4 mb-5">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-username">Username</label>
                  <input type="text" id="input-username" class="form-control form-control-alternative"
                    value="<?php echo $username['username'];?>" disabled>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">Password</label>
                  <input type="password" id="input-email" class="form-control form-control-alternative"
                    value="<?php echo md5($username['password']);?>" disabled>
                </div>

              </div>
            </div>
            <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#changepassword">Change
              Password
            </button>
          </div>

          <hr class="my-4">

         

          <h6 class="heading-small text-muted mb-4">Transaction Information</h6>
          <div class="pl-lg-4">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">Total Loan Balance</label>
                </div>
                <button class="btn btn-sm btn-primary float-right" data-toggle="modal"
                  data-target="#loanbalance">Balance Details
                </button>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-username">Transaction History</label>
                </div>
                <button class="btn btn-sm btn-primary float-right" data-toggle="modal"
                  data-target="#transaction_history">Paid Transaction
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
    include 'include/customer-proifile-modals.php';
    include 'include/scripts.php';
    include 'include/customer-scripts.php';
    ?>