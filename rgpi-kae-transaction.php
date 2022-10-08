<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

    <title>AR Collections | Right Goods Philippines Inc.</title>

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
            AR COLLECTIONS
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
            $query="SELECT invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateDelivered,invoice.dueDate, invoice.status, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo
            WHERE invoice.kaeName =  '".$_SESSION['rgpi-username']."' AND invoice.status = 'notpaid'
            GROUP BY cartorder.invoiceNo;
            ";

            
            $query_run=mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
        ?>

            <table class="table table-bordered caption-top table-hover" id="arcollection">
                <thead>
                    <tr class="table-primary text-dark">
                        <th>KAE</th>
                        <th>Invoice No</th>
                        <th >USERNAME </th>
                        <th >ACCOUNT NAME </th>
                        <th>ORDERED DATE</th>
                        <th >DATE DELIVERED</th>
                        <th >APPROVED TERM</th>
                        <th>DUE DATE</th>
                        <th >DAYS OVERDUE</th>
                        <th>TOTAL AMOUNT</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                  
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
                         
                            $result = $row['Total_Balance'] * $subTotal;
                            $grandTotal = $row['Total_Balance'] + $result;
                            ?>
                        <td>&#8369; <?php echo number_format($grandTotal,2)?></td>

                        <td>
                            <?php 
                               // echo $row['status'];
                                if ($row['status'] === 'paid') 
                                {
                                    echo '<i class="far fa-check-circle text-success"></i>';
                                }
                                else
                                {
                                    echo '<i class="far fa-thumbs-down text-danger"></i>';
                                }
                            ?>
                        </td>
                        
                        <td class="align-middle btn-group">
                        <?php
                            if ($deliveryDate == null && $dueDate == null) {
                               ?>
                                
                                        <form action="rgpi-kae-editTransaction.php" method="POST">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['invoiceNo']?>" />
                                            <button 
                                                type="submit" 
                                                name="btn-edit-invoice" 
                                                class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="tooltip" 
                                                title="Input date">
                                                <i class="fas fa-edit"></i>
                                        </button>
                                        </form>
                        
                               <?php
                            }
                            else if($today > $due) {
                                ?>
                         
                                        <form action="" method="POST">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['invoiceNo']?>" disabled />
                                            <button 
                                                type="button" 
                                                name="btn-edit-invoice" 
                                                class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="tooltip" 
                                                title="Disabled">
                                                <i class="fas fa-edit"></i>
                                        </button>
                                        </form>
                           
                                <?php
                            } else  {
                                ?>
                     
                                        <form action="rgpi-kae-editTransaction.php" method="POST">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['invoiceNo']?>"/>
                                            
                                            <button 
                                                type="submit" 
                                                name="btn-edit-invoice" 
                                                class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="tooltip" 
                                                title="Input date">
                                                <i class="fas fa-edit"></i>
                                        </button>
                                        </form>
                             
                                <?php
                            }
                          
                        ?>
      
                        <?php
                            if ($deliveryDate != null && $dueDate != null) {
                                ?>
                                
                                        <form action="rgpi-kae-Payment.php" method="POST">
                                            <input type="hidden" name="invoiceNo" value="<?php echo $row['invoiceNo']?>" />
                                            <button 
                                                type="submit" 
                                                name="btn-edit-invoice" 
                                                class="btn btn-sm btn-outline-success"
                                                data-bs-toggle="tooltip" 
                                                title="Input amount to pay">
                                            <i class="fas fa-money-check-alt"></i>
                                            
                                        </button>
                                        </form>
                               
                                <?php
                            } else {
                                ?>
                                  
                                        <form action="" method="POST">
                                            <input type="hidden" name="invoiceNo" value="<?php echo $row['invoiceNo']?>" disabled/>
                                            <button 
                                                type="button" 
                                                name="btn-edit-invoice" 
                                                class="btn btn-sm btn-outline-success"
                                                data-bs-toggle="tooltip" 
                                                title="Disbled">
                                            <i class="fas fa-money-check-alt"></i>
                                        </button>
                                        </form>
                               
                                <?php
                            }
                        ?>
                        </td>
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
        echo '
            <div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
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

<?php }?>
<!---------------- END OPERATIONS MANAGER ----------------->


<?php
            include 'include/scripts.php'; 
            include 'include/rgpi-footer.php';  
            
        ?>
<?php }else{
        header("Location: rgpi-login.php");
    } ?>