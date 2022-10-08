<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

    <title>Overdue Accounts | Right Goods Philippines Inc.</title>

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
<?php if ($_SESSION['rgpi-role'] == 'user') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/kae-navbar.php'; ?>


<div class="container-fluid">
    <?php
            if (isset($_POST['btn-update-invoice'])) {
                include 'lib/config.php';
                $delivered = date('m-d-Y', strtotime( $_POST['dateDelivered']));
                $terms = $_POST['term'];
                $duedate = date('m-d-Y', strtotime($_POST['dueDate']));

                $sql = "UPDATE invoice SET
                        dateDelivered = '$delivered',
                        terms = '$terms',
                        dueDate = '$duedate'
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
                }
            }
        ?>

    <div class="card mt-3">
        <div class="card-header ">
            <h6 class="m-0 fw-bold text-center text primary float-end">
                OVERDUE ACCOUNTS
                <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
                </span>
            </h6>
            
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php 
            include 'lib/config.php';
            $symbol="(";
            $symbol1=")";
            $conn = new mysqli('localhost','root','','rgpi');
            $query=" SELECT invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateDelivered,invoice.dueDate, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
            
            WHERE invoice.kaeName =  '".$_SESSION['rgpi-username']."' AND CURRENT_TIMESTAMP > invoice.dueDate  AND invoice.status = 'notpaid'
            GROUP BY cartorder.invoiceNo;
            ";

            
            $query_run=mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
        ?>

            <table class="table table-bordered caption-top table-hover" id="datatable">
                <thead>
                    <tr class="table-primary text-dark">
                        <th>KAE</th>
                        <th>Invoice No</th>
                        <th>USERNAME </th>
                        <th>ACCOUNT NAME </th>
                        <th>ORDERED DATE</th>
                        <th>DATE DELIVERED</th>
                        <th>APPROVED TERM</th>
                        <th>DUE DATE</th>
                        <th>DAYS OVERDUE</th>
                        <th>TOTAL AMOUNT</th>
                    </tr>
                </thead>
                <tbody>


                    <?php 
                        $total = 0.00;
                        $subTotal = 0.12;
                        $result = 0.00;
                        $grandTotal = 0.00;
                        while ($row=mysqli_fetch_assoc($query_run)) { ?>
                    <?php
                        /********** Count Number of Terms **************/
                        date_default_timezone_set('Asia/Manila');
                                $dueDate = date($row['dueDate']);
                                $deliveryDate = date($row['dateDelivered']);
                                //$today = date('Y-m-d');
                               
                                $due = strtotime($dueDate);
                                $deliver = strtotime($deliveryDate);
                                $today = strtotime('today');

                                
                                $Overduediff = $due - $today; // overdue
                                $overdue = abs(floor($Overduediff / (60 * 60 * 24)));


                                $Termsdiff = $deliver - $due; // terms
                                $terms = abs(floor($Termsdiff / (60 * 60 * 24)));

                        ?>
                    <tr>
                        <td><?php echo $row['kaeName']?></td>
                        <td><?php echo $row['invoiceNo']?></td>
                        <td><?php echo $row['invoiceUsername']?></td>
                        <td><?php echo $row['invoiceCompany']?></td>
                        <td><?php echo $row['create_date']?></td>

                        <td><?php echo $row['dateDelivered']?></td>
                        <td class="fw-bold text-warning"><?php echo $terms?></td>
                        <td><?php echo $row['dueDate']?></td>
                        <td class="fw-bold text-danger">
                        <?php
                            if ($deliveryDate == null && $dueDate == null) {
                               echo 0;
                            }
                            else if($today > $due) {
                                echo $overdue;
                            }
                          
                            ?>
                        </td>




                        <?php
                            //$total += $row['Total_Balance'];
                            $result = $row['Total_Balance'] * $subTotal;
                            $grandTotal = $row['Total_Balance'] + $result;
                            ?>
                        <td>&#8369; <?php echo number_format($grandTotal,2)?></td>



                    </tr>




                    <?php } ?>





        </div>

        </tbody>
        </table>
    </div>
</div>
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







<?php }else { ?>


<!---------------- Operations Manager --------------->
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>

        
<div class="container-fluid">
    <?php
            if (isset($_POST['btn-update-invoice'])) {
                include 'lib/config.php';
                $delivered = date('m-d-Y', strtotime( $_POST['dateDelivered']));
                $terms = $_POST['term'];
                $duedate = date('m-d-Y', strtotime($_POST['dueDate']));

                $sql = "UPDATE invoice SET
                        dateDelivered = '$delivered',
                        terms = '$terms',
                        dueDate = '$duedate'
                ";
                $query_run = mysqli_query($conn,$sql);

                if ($query_run) 
                {
                    echo '
                    <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12 col-md-12 col-lg-12 alert alert-success align-middle">
                            <h6 class="fw-bold text-center">
                            Successfully Update</h6>
                        </div>
                        <a href="rgpi-kae-transaction.php?action=success">
                        <button type="button" class="btn btn-primary float-end p-3">Go back to AR Collections</button> 
                        </a>
                    </div>
                    </div>
                    ';
                    exit();
                }
                else
                {
                    echo '
                    <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12 col-md-12 col-lg-12 alert alert-success align-middle">
                            <h6 class="fw-bold text-center">
                            Failed</h6>
                        </div>
                        <a href="rgpi-kae-transaction.php?action=success">
                        <button type="button" class="btn btn-primary float-end p-3">Go back to AR Collections</button> 
                        </a>
                    </div>
                    </div>
                    ';
                    exit();
                }
            }
        ?>

    <div class="card mt-3">
        <div class="card-header ">
            <h6 class="m-0 text-center text primary float-end">
                OVERDUE ACCOUNTS
                <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
                </span>
            </h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
 
            <?php 
            include 'lib/config.php';
            $symbol="(";
            $symbol1=")";
            $conn = new mysqli('localhost','root','','rgpi');
            $query=" SELECT invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateDelivered,invoice.dueDate, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
            
            WHERE CURRENT_TIMESTAMP > invoice.dueDate  AND invoice.status = 'notpaid'
            GROUP BY cartorder.invoiceNo;
            ";

            
            $query_run=mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
        ?>

            <table class="table table-bordered caption-top table-hover" id="datatable">
                <thead>
                    <tr class="table-primary text-dark">
                        <th>KAE</th>
                        <th>Invoice No</th>
                        <th>USERNAME </th>
                        <th>ACCOUNT NAME </th>
                        <th>ORDERED DATE</th>
                        <th>DATE DELIVERED</th>
                        <th>APPROVED TERM</th>
                        <th>DUE DATE</th>
                        <th>DAYS OVERDUE</th>
                        <th>TOTAL AMOUNT</th>
                    </tr>
                </thead>
                <tbody>


                    <?php 
                        $total = 0.00;
                        $subTotal = 0.12;
                        $result = 0.00;
                        $grandTotal = 0.00;
                        while ($row=mysqli_fetch_assoc($query_run)) { ?>
                    <?php
                        /********** Count Number of Terms **************/
                        date_default_timezone_set('Asia/Manila');
                                $dueDate = date($row['dueDate']);
                                $deliveryDate = date($row['dateDelivered']);
                                //$today = date('Y-m-d');
                               
                                $due = strtotime($dueDate);
                                $deliver = strtotime($deliveryDate);
                                $today = strtotime('today');

                                
                                $Overduediff = $due - $today; // overdue
                                $overdue = abs(floor($Overduediff / (60 * 60 * 24)));


                                $Termsdiff = $deliver - $due; // terms
                                $terms = abs(floor($Termsdiff / (60 * 60 * 24)));

                        ?>
                    <tr>
                        <td><?php echo $row['kaeName']?></td>
                        <td><?php echo $row['invoiceNo']?></td>
                        <td><?php echo $row['invoiceUsername']?></td>
                        <td><?php echo $row['invoiceCompany']?></td>
                        <td><?php echo $row['create_date']?></td>

                        <td><?php echo $row['dateDelivered']?></td>
                        <td class="fw-bold text-warning"><?php echo $terms?></td>
                        <td><?php echo $row['dueDate']?></td>
                        <td class="fw-bold text-danger">
                            <?php 
                            if ($deliveryDate == null && $dueDate == null) {
                                echo 0;
                             }
                             else if($today > $due) {
                                 echo $overdue;
                             }
                                
                            ?>
                        </td>




                        <?php
                            //$total += $row['Total_Balance'];
                            $result = $row['Total_Balance'] * $subTotal;
                            $grandTotal = $row['Total_Balance'] + $result;
                            ?>
                        <td>&#8369; <?php echo number_format($grandTotal,2)?></td>



                    </tr>




                    <?php } ?>





        </div>

        </tbody>
        </table>
    </div>
</div>
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



<!---------------- End KEY ACCOUNTS EXECUTIVE --------------->
    <?php } ?>


<?php
            include 'include/scripts.php'; 
            include 'include/rgpi-footer.php';  
            
        ?>
<?php }else{
        header("Location: rgpi-login.php");
    } ?>