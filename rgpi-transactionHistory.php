<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

  <title>Transaction History | Right Goods Philippines Inc.</title>

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

  <div class="card mt-3">
    <div class="card-header ">
      <h6 class="m-0 fw-bold text-center text primary float-end">
        Transaction History
        <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
        </span>
      </h6>
    </div>
  </div>
  <div class="card-body">

    <?php
            if (isset($_POST['btn-transactionHistory'])) 
            {
              include 'lib/config.php';
            
              $product_id = $_POST['edit_id'];
              $username = $_POST['username'];
            ?>

      <div class="table-responsive">
                        <?php 
                            include 'lib/config.php';
                            $conn = new mysqli('localhost','root','','rgpi');
                            $invoice=" SELECT DISTINCT tbl_member.id, invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.datePaid, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice 
                            JOIN cartorder 
                            ON cartorder.invoiceNo = invoice.invoiceNo
                            JOIN tbl_member
                            ON tbl_member.username = invoice.invoiceUsername
                                                      
                                        WHERE tbl_member.id = '$product_id' AND invoice.status = 'paid'
                                        GROUP BY invoice.invoiceNo
                            ";

                            
                            $invoice_query_run=mysqli_query($conn, $invoice);

                            if (mysqli_num_rows($invoice_query_run) > 0) {
                        ?>
                        <table class="table table-borderless caption-top table-hover" id="dataTable">
                          <thead>
                            <tr class="table-primary text-dark">
                            <!-- <th scope="col">Member Id</th> -->
                              <th scope="col">Invoice No</th>
                              <th scope="col">USERNAME </th>
                              <th scope="col">COMPANY NAME </th>
                              <th scope="col">DATE PAID </th>
                              <th scope="col">TOTAL AMOUNT</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                $total = 0.00;
                                $subTotal = 0.12;
                                $result = 0.00;
                                $grandTotal = 0.00;
                                while ($row=mysqli_fetch_assoc($invoice_query_run)) { ?>
                            <tr>
                            <!-- <td class="align-middle"><?php echo $row['id']?></td> -->
                              <td class="align-middle"><?php echo $row['invoiceNo']?></td>
                              <td class="align-middle"><?php echo $row['invoiceUsername']?></td>
                              <td class="align-middle"><?php echo $row['invoiceCompany']?></td>
                              <td class="align-middle"><?php echo $row['datePaid']?></td>
                              <?php
                                    //$total += $row['Total_Balance'];
                                    $result = $row['Total_Balance'] * $subTotal;
                                    $grandTotal = $row['Total_Balance'] + $result;
                                    ?>
                              <td class="align-middle">&#8369; <?php echo number_format($grandTotal,2)?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <a href="rgpi-creditlimit.php">
                          <button class="btn btn-sm btn-danger float-end"> Back</button>
                        </a>
                        <?php
                      }
                        else 
                        {
                          echo '<div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
                          <div class="card mb-5">
                          
                            <div class="card-shadow text-center">
                              <div class="card-body">
                                <img src="assets/img/emptyuser.gif" class="img-fluid" alt="gif" style=" width: 150px; height: 150px;">
                                <h6 class="card-title fw-bold">
                                </h6>
                              </div>
                            </div>
                          </div>
                          </div>';
                        }
                        ?>
                    </div>
            <?php
            
        }
          else 
          {
              echo "\n No Transaction history";
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