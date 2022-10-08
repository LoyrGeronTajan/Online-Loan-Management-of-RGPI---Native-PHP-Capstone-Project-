<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

  <title>Borrowers Profile | Right Goods Philippines Inc.</title>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style>
    #head {
      font-weight: 600;
      text-align: center;
    }

    tr {
      text-align: center;
    }

    img {
      width: 10rem;
    }
  </style>
</head>

<!---------------- OPERATIONS MANAGER ----------------->
<?php if ($_SESSION['rgpi-role'] == 'admin') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>


<div class="container-fluid">
  <?php
            if (isset($_POST['btn-update-profile'])) {

                include 'lib/config.php';

                $limit = $_POST['limit'];
                $id = $_POST['id'];

                $sql = "UPDATE tbl_member SET
                        creditLimit = '$limit'
                        WHERE id = '$id';
                ";
                $query_run = mysqli_query($conn,$sql);

                if ($query_run) 
                {
                  echo '
                  <script>
                  swal({
                      title: "Success!",
                      timer: 3000,
                      icon: "success",
                      
                  }).then(function() {
                      window.location = "rgpi-setlimit.php";
                  });
      
                  </script>
                  ';
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
                      window.location = "rgpi-setlimit.php";
                  });
      
                  </script>
                  ';
                }
            }
        ?>

  <div class="card mt-3">
    <div class="card-header ">
      <h6 class="m-0 fw-bold text-center text primary float-end">
        Borrowers Profile
        <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
        </span>
      </h6>
    </div>
  </div>
  <div class="card-body">

    <?php
            if (isset($_POST['btn-edit-profile'])) 
            {
           
            include 'lib/config.php';
            
            $product_id = $_POST['edit_id'];

            $conn = new mysqli('localhost','root','','rgpi');
            $query=" SELECT * From tbl_member WHERE id = $product_id;

            ";            
            $query_run=mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) 
            {
                foreach($query_run as $row) :
        ?>

          <!-- START FORM -->
            <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="input-username" class="form-control form-control-alternative"
                          value="<?php echo $row['id']?>" readonly>
              <div class="modal-body">
                <h6 class="heading-small text-muted mb-4">Customer Profile</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" name="invoice" id="input-username" class="form-control form-control-alternative"
                          value="<?php echo $row['username']?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Name</label>
                        <input type="text" name="invoice" id="input-username" class="form-control form-control-alternative"
                          value="<?php echo $row['fullname']?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Company Name</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative"
                          value="<?php echo $row['company']?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email Address </label>
                        <input type="email" id="input-email" class="form-control form-control-alternative"
                          value="<?php echo $row['email']?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Contact information</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative"
                          value="<?php echo $row['phone']?>" readonly>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Address</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative"
                          value="<?php echo $row['address']?>" readonly>
                      </div>
                    </div>

                  </div>
                </div>

                <hr class="my-4">

                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Set Credit Limit </h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Credit Limit</label>
                        <input type="number" name="limit"  placeholder="<?php echo $row['creditLimit']?>"
                          class="form-control form-control-alternative"  required>
                      </div>
                    </div>
                    
                  </div>

                </div>
              </div>


              <div class="modal-footer mb-3">
              <a href="rgpi-setlimit.php"> <button type="button"  class="btn btn-sm btn-secondary btn-rounded ">Cancel</button> </a>
                <button type="submit" name="btn-update-profile" class="btn btn-sm btn-outline-success btn-rounded ">Update</button></div>
          </div>
          </form>
  <!-- END FORM -->
</div>
<?php

    endforeach;
    }
   }

    ?>

</div>

<?php }?>
<!---------------- END OPERATIONS MANAGER ----------------->

<?php
            include 'include/scripts.php'; 
            include 'include/rgpi-footer.php';  
            
        ?>
<?php }else{
        header("Location: rgpi-login.php");
    } ?>