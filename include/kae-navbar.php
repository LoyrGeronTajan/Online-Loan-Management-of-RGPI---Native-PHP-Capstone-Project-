
            <?php 
            /************* User Name ******************/
				include "lib/config.php";

				$query = "SELECT * FROM usertype WHERE username = '".$_SESSION['rgpi-username']."'";
        		$result = mysqli_query($conn, $query);
				$username = mysqli_fetch_array($result);
			?>


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3 mb-3" href="rgpi-home.php">
        <div class="sidebar-brand-icon">
            <img src="assets/img/icon2.png" class="img-fluid mt-3">
        </div>
    </a>

    <hr class="sidebar-divider mt-4 my-0">

    <li class="nav-item active">
        <a class="nav-link" href="rgpi-home.php">
            <i class="fas fa-user-cog fa-sm fa-fw"></i>
            <span>Key Accounts Executive</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Management
    </div>

    <li class="nav-item">

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-dollar-sign fa-sm fa-fw"></i>
            <span>Transaction</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Loan Orders</h6>
                <a class="collapse-item" href="rgpi-kae-transaction.php">AR Collections</a>
                <a class="collapse-item" href="rgpi-kae-activeAccount.php">Accounts Handle</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="far fa-user fa-sm fa-fw"></i>
            <span>Critical Accounts</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Accounts</h6>
                <a class="collapse-item" href="rgpi-kae-overdue.php">Overdue Account</a>
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
                        <h6>KAE</h6>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase">
                            <?php echo $username['name']; ?>
                        </span>

                        <?php echo "<img src='assets/img/employee/".$username['userImage']."' class='img-profile rounded-circle' >"?>
                        <p class="text-danger"></p>
                        <i class="fas fa-cog fa-sm fa-fw mr-2 text-danger"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#kaeInformation">
                            <i class="fas fa-user-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Information
                        </a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changepassword">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="rgpi-logout.php" data-toggle="modal" data-target="#logoutModal">
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

        <?php include 'include/kae-modals.php' ;?>

        <?php
                include "lib/config.php";
                if (isset($_POST['btn-update-userprofile'])) 
                {
                  $user_image = $_FILES["user_image"]['name'];
                  $user_name = $_POST['user_name'];
                  $user_email = $conn -> real_escape_string($_POST['user_email']);

                  $product_image_query = "SELECT * FROM usertype WHERE username = '".$_SESSION['rgpi-username']."'";
                  $product_image_query_run = mysqli_query($conn,$product_image_query);
                      foreach ($product_image_query_run as $imageRow) 
                      {
                          //echo $imageRow['productImage'];
              
                          if ($user_image == NULL) 
                          {
                              //Update with existing image;
                              $imageData = $imageRow['userImage'];
                          }
                          else
                          {
                              //Update with old product image to new product image
                              if ($img_path = "/assets/img/employee/" . $imageRow['userImage']) 
                              {
                                  realpath($img_path);
                                  $imageData = $user_image;
                                  
                              }
                          }
                      }
                  $query = "UPDATE usertype SET 
                      userImage='$user_image',
                      name='$user_name',
                      email='$user_email'
                       WHERE username = '".$_SESSION['rgpi-username']."'
                  ";
                  $query_run = mysqli_query($conn,$query);
                
                  if ($query_run) 
                  {     
                        
                    if ($user_image == NULL) 
                    {
                        //Update existing image;
                        
                        echo '
                            <script>
                            swal({
                                title: "Updated Successfully!",
                                timer: 3000,
                                icon: "success",
                                
                            }).then(function() {
                                window.location = "rgpi-home.php";
                            });

                            </script>
                        ';
                    }
                    else
                    {
                        //Update with old product image to new product image
                        move_uploaded_file($_FILES["user_image"]['tmp_name'], "assets/img/employee/" . $_FILES["user_image"]['name']);
                        
                        echo '
                            <script>
                            swal({
                                title: "Updated Successfully!",
                                timer: 3000,
                                icon: "success",
                                
                            }).then(function() {
                                window.location = "rgpi-home.php";
                            });

                            </script>
                        ';
                    } 
                  }
                  else
                    {
                        echo '
                            <script>
                            swal({
                                title: "Error!",
                                timer: 3000,
                                icon: "error",
                                
                            }).then(function() {
                                window.location = "rgpi-home.php";
                            });

                            </script>
                        ';
                    }
                }

                if (isset($_POST['btn-update-usercredential'])) 
                {
                    $user_username = $_POST['user_username'];
                    $user_oldpassword = $_POST['user_oldpassword'];
                    $user_newpassword = $_POST['user_newpassword'];
                    $user_confirmpassword = $_POST['user_confirmpassword'];

                    $password_query = mysqli_query($conn,"SELECT password from usertype where id='".$_SESSION['rgpi-id']."'");

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
                                window.location = "rgpi-home.php";
                            });

                            </script>
                        ';
                        
                        }
                    else
                        {
                        $user_oldpassword = md5($user_oldpassword);
                        $user_newpassword = md5($user_newpassword);

                        $update_pwd = mysqli_query($conn,"UPDATE usertype set password='$user_newpassword' where id='".$_SESSION['rgpi-id']."'");
                        echo '
                            <script>
                            swal({
                                title: "Success!",
                                timer: 3000,
                                icon: "success",
                                
                            }).then(function() {
                                window.location = "rgpi-home.php";
                            });

                            </script>
                        ';
                        }
                }
            ?>