<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

    <title>Accounts Handle | Right Goods Philippines Inc.</title>

</head>

<!---------------- KEY ACCOUNTS EXECUTIVE ----------------->
<?php if ($_SESSION['rgpi-role'] == 'user') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/kae-navbar.php'; ?>


<div class="container-fluid">

    <div class="card mt-3">
        <div class="card-header ">
            <h6 class="m-0 fw-bold text-center text primary float-end">
            ACCOUNTS HANDLE
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
            $query="SELECT invoice.kaeName, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateAssigned, tbl_member.fullname, tbl_member.address, tbl_member.phone, tbl_member.email 
            FROM invoice LEFT JOIN tbl_member ON tbl_member.username = invoice.invoiceUsername
                        WHERE invoice.kaeName =  '".$_SESSION['rgpi-username']."'
                        GROUP BY invoice.invoiceNo
            ";

            
            $query_run=mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
        ?>

            <table class="table table-bordered caption-top table-hover" id="datatable">
                <thead>
                    <tr class="table-primary text-dark">
                        <th>USERNAME </th>
                        <th>ACCOUNT NAME </th>
                        <th>DATE ASSIGNED</th>
                        <th>CONTACT INFORMATION</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row=mysqli_fetch_assoc($query_run)) { ?>

                    <tr>               
                        <td><?php echo $row['invoiceUsername']?></td>
                        <td><?php echo $row['invoiceCompany']?></td>
                        <td><?php echo $row['dateAssigned']?></td>
                        <td><?php echo $row['address'] . " | " . $row['email']  ." | ". $row['phone'] ?></td>
                        
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


<?php }?>
<!---------------- END KEY ACCOUNTS EXECUTIVE ----------------->


<?php
            include 'include/scripts.php'; 
            include 'include/rgpi-footer.php';  
            
        ?>
<?php }else{
        header("Location: rgpi-login.php");
    } ?>