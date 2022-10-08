
<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

    <title>Archive Paid Transaction | Right Goods Philippines Inc.</title>


</head>


<?php if ($_SESSION['rgpi-role'] == 'user') { ?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/kae-navbar.php'; ?>



<?php }else { ?>

<!---------------- OPERATIONS MANAGER --------------->
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>

<div class="container-fluid">

    <div class="card mt-3">
        <div class="card-header ">
            <h6 class="m-0 fw-bold text-center text primary float-end">
                ARCHIVE PAID TRANSACTION
                <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
                </span>
            </h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="datatable">
                <thead>
                    <tr class="table-primary text-dark">
                        <th>Invoice No</th>
                        <th>KAE</th>
                        <th>USERNAME </th>
                        <th>ACCOUNT NAME </th>
                        <th>DATE PAID </th>
                        <th>AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include 'lib/config.php';
                    $conn = new mysqli('localhost','root','','rgpi');
                    $query=" SELECT invoice.invoiceId, invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.datePaid, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
                    WHERE  invoice.status = 'paid' and invoice.archive = 'YES'
                    GROUP BY cartorder.invoiceNo
                    ";  
                    $query_run=mysqli_query($conn, $query);

                    if (mysqli_num_rows($query_run) > 0) 
                    { 
                        $total = 0.00;
                        $subTotal = 0.12;
                        $result = 0.00;
                        $grandTotal = 0.00;
                        while ($row=mysqli_fetch_assoc($query_run)) 
                        { 
                            ?>

                                <tr class="fw-bold">
                                    <td><?php echo $row['invoiceNo']?></td>
                                    <td><?php echo $row['kaeName']?></td>
                                    <td><?php echo $row['invoiceUsername']?></td>
                                    <td><?php echo $row['invoiceCompany']?></td>
                                    <td><?php echo $row['datePaid']?></td>

                                    <?php
                                        //$total += $row['Total_Balance'];
                                        $result = $row['Total_Balance'] * $subTotal;
                                        $grandTotal = $row['Total_Balance'] + $result;
                                    ?>
                                    <td>&#8369; <?php echo number_format($grandTotal,2)?></td>
                                </tr>
                            <?php 
                        } 
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
                </tbody>
            </table>
            <!-- <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary text-dark">
                        <th>Invoice No</th>
                        <th>KAE</th>
                        <th>USERNAME </th>
                        <th>ACCOUNT NAME </th>
                        <th>DATE PAID </th>
                        <th>AMOUNT</th>
                    </tr>
                </thead>

            <tbody>
                <?php 
                include 'lib/config.php';
                $conn = new mysqli('localhost','root','','rgpi');
                $query=" SELECT invoice.invoiceId, invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.datePaid, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
                WHERE  invoice.status = 'paid' and invoice.archive = 'YES'
                GROUP BY cartorder.invoiceNo
                ";  
                $query_run=mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0) 
                { 
                    $total = 0.00;
                    $subTotal = 0.12;
                    $result = 0.00;
                    $grandTotal = 0.00;
                    while ($row=mysqli_fetch_assoc($query_run)) 
                    { 
                        ?>

                            <tr class="fw-bold">
                                <td><?php echo $row['invoiceNo']?></td>
                                <td><?php echo $row['kaeName']?></td>
                                <td><?php echo $row['invoiceUsername']?></td>
                                <td><?php echo $row['invoiceCompany']?></td>
                                <td><?php echo $row['datePaid']?></td>

                                <?php
                                    //$total += $row['Total_Balance'];
                                    $result = $row['Total_Balance'] * $subTotal;
                                    $grandTotal = $row['Total_Balance'] + $result;
                                ?>
                                <td>&#8369; <?php echo number_format($grandTotal,2)?></td>
                            </tr>
                        <?php 
                    } 
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
            </tbody>
            </table> -->
    </div>
    
</div>
</div>



<!---------------- End OPERATIONS MANAGER --------------->
<?php } ?>


<?php
            include 'include/scripts.php'; 
            include 'include/rgpi-footer.php';  
            
        ?>
<?php }else{
        header("Location: rgpi-login.php");
    } ?>