<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

  <title> AR Collections | Right Goods Philippines Inc.</title>

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

<!---------------- KEY ACCOUNTS EXECUTIVE ----------------->
<?php if ($_SESSION['rgpi-role'] == 'user') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/kae-navbar.php'; ?>


<div class="container-fluid">
  <?php
            if (isset($_POST['btn-update-invoice'])) {

                include 'lib/config.php';

                $invoice = $_POST['invoice'];

                $delivered = date('Y-m-d', strtotime( $_POST['dateDelivered']));
                //$terms = $_POST['term'];
                $duedate = date('Y-m-d', strtotime($_POST['dueDate']));

                $sql = "UPDATE invoice SET
                        dateDelivered = '$delivered',
                       
                        
                        dueDate = '$duedate'
                        WHERE invoiceNo = '$invoice';
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
                      window.location = "rgpi-kae-transaction.php";
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
                      window.location = "rgpi-kae-transaction.php";
                  });
      
                  </script>
                  ';
                    exit();
                }
            }
        ?>

  <div class="card mt-3">
    <div class="card-header ">
      <h6 class="m-0 fw-bold text-center text primary float-end">
        AR COLLECTIONS
        <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
        </span>
      </h6>
    </div>
  </div>
  <div class="card-body">

    <?php
            if (isset($_POST['btn-edit-invoice'])) 
            {
           
            include 'lib/config.php';
            
            $product_id = $_POST['edit_id'];

            $conn = new mysqli('localhost','root','','rgpi');
            $query=" SELECT invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateDelivered,invoice.dueDate, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date 
            FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
            WHERE invoice.invoiceNo='$product_id' AND invoice.kaeName =  '".$_SESSION['rgpi-username']."'
            GROUP BY invoice.invoiceNo;

            ";

            
            $query_run=mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
                foreach($query_run as $row) :
        ?>

    <!-- START FORM -->
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <h6 class="heading-small text-muted mb-4">Customer Invoice information</h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group focused">
                <label class="form-control-label" for="input-username">Invoice No</label>
                <input type="text" name="invoice" id="input-username" class="form-control form-control-alternative"
                  value="<?php echo $row['invoiceNo']?>" readonly>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email">Username</label>
                <input type="email" id="input-email" class="form-control form-control-alternative"
                  value="<?php echo $row['invoiceUsername']?>" readonly>
              </div>
            </div>
          </div>
        </div>


        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group focused">
                <label class="form-control-label" for="input-username">Company</label>
                <input type="text" id="input-username" class="form-control form-control-alternative"
                  value="<?php echo $row['invoiceCompany']?>" readonly>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email">Ordered Date </label>
                <input type="email" id="input-email" class="form-control form-control-alternative"
                  value="<?php echo $row['create_date']?>" readonly>
              </div>
            </div>
          </div>
        </div>

        <?php
                    $subTotal = 0.12;
                    $result = 0.00;
                    $grandTotal = 0.00;

                    //$total += $row['Total_Balance'];
                    $result = $row['Total_Balance'] * $subTotal;
                    $grandTotal = $row['Total_Balance'] + $result;
                ?>

        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group focused">
                <label class="form-control-label" for="input-username">Total Amount</label>
                <input type="text" id="input-username" class="form-control form-control-alternative"
                  value="&#8369; <?php echo number_format($grandTotal,2);?>" readonly>
              </div>
            </div>

          </div>
        </div>

        <hr class="my-4">

        <!-- Address -->
        <h6 class="heading-small text-muted mb-4">Set transaction </h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group focused">
                <label class="form-control-label" for="input-username">Date Delivered</label>
                <input type="date" value="<?php echo $row['dateDelivered']?>" name="dateDelivered"
                  class="form-control form-control-alternative"  required>
              </div>
            </div>
            <!-- <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="input-email">Approved Terms</label>
                <input type="number" value="<?php echo $row['terms']?>" name="term" placeholder="days *"
                  class="form-control form-control-alternative"  required>
              </div>
            </div> -->
            <div class="col-lg-6">
              <div class="form-group focused">
                <label class="form-control-label" for="input-first-name">Due Date</label>
                <input type="date" value="<?php echo $row['dueDate']?>" name="dueDate" id="input-first-name" class="form-control form-control-alternative"
                   required>
              </div>
            </div>
          </div>

        </div>
      </div>


      <div class="modal-footer mb-3">
        <a href="rgpi-kae-transaction.php"><button type="button" class="btn btn-sm btn-secondary btn-rounded">Cancel</button> </a>
        <button type="submit" name="btn-update-invoice" class="btn btn-sm btn-outline-success btn-rounded">Update</button></div>
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
<!---------------- END KEY ACCOUNTS EXECUTIVE ----------------->


<?php
            include 'include/scripts.php'; 
            include 'include/rgpi-footer.php';  
            
        ?>
<?php }else{
        header("Location: rgpi-login.php");
    } ?>