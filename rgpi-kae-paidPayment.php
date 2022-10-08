<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

    <title>Paid Transaction | Right Goods Philippines Inc.</title>

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



<!---------------- OPERATIONS MANAGER----------------->
<?php if ($_SESSION['rgpi-role'] == 'admin') { ?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>

                 




<div class="container-fluid">

    <div class="card mt-3">
        <div class="card-header ">
            <h6 class="m-0 fw-bold text-center text primary float-end">
                PAID TRANSACTION
                <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
                </span>
            </h6>

            <form action="paidPdf.php" method="POST" target="_blank">

                <button type="submit" name="btn-print-paid"
                    class="btn btn-sm btn-info d-flex justify-content-center">EXPORT DATA
                </button>
            </form>
        </div>
    </div>

    <?php

    if(isset($_POST['btn-archiveAll'])) 
    {
        include 'lib/config.php';
   

        $sql1 = "UPDATE invoice SET
                        archive = 'YES'
                ";
        $sql_run1 = mysqli_query($conn,$sql1);
                        
        if($sql_run1)
        {
            echo '
            <script>
            swal({
                title: "Success!",
                timer: 3000,
                icon: "success",
                
            }).then(function() {
                window.location = "rgpi-archivePaid.php";
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
                window.location = "rgpi-archivePaid.php";
            });

            </script>
            ';
        }

    }
?>

    <div class="card-body">
        <div class="table-responsive">
        <form action="" method="POST">
       
            <button class="btn btn-sm btn-outline-success float-end mb-3" type="submit" name="btn-archiveAll" data-bs-toggle="tooltip" title="Move all to archive">
                <i class="far fa-file-archive"></i>
            </button>   

        </div>
        </form>
            <?php 
            include 'lib/config.php';
    
            $conn = new mysqli('localhost','root','','rgpi');
            $query="SELECT invoice.invoiceId, invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.datePaid, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
            
            WHERE  invoice.status = 'paid' and invoice.archive = 'NO'
            GROUP BY cartorder.invoiceNo
            ";

            
            $query_run=mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
        ?>

            <table class="table table-bordered caption-top table-hover" id="datatable">
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
                        $total = 0.00;
                        $subTotal = 0.12;
                        $result = 0.00;
                        $grandTotal = 0.00;
                        while ($row=mysqli_fetch_assoc($query_run)) { ?>
                    <tr>

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

                   


                    <?php } ?>

        </div>

        </tbody>
        </table>
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





<!---------------- End OPERATIONS MANAGER--------------->
<?php } ?>


<?php
            include 'include/scripts.php'; 
            include 'include/rgpi-footer.php';  
            
        ?>
<?php }else{
        header("Location: rgpi-login.php");
    } ?>