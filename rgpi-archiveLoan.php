<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>

    <title>Archive Loan | Right Goods Philippines Inc.</title>

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
            <h6 class="m-0 text-uppercase text-center text primary float-end">
                ARCHIVE LOANS
                <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
                </span>
            </h6>

        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php 
        include 'lib/config.php';
        $conn = new mysqli('localhost','root','','rgpi');
        $query="SELECT * From cartorder WHERE status = 2 AND archive = 'YES'";
        $query_run=mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
    ?>
            <table class="table  table-bordered caption-top table-hover" id="datatable">
                <thead>
                    <tr class="table-primary text-dark">
                        <th scope="col" width="5%" id="head">Invoice No</th>
                        <th scope="col" width="5%" id="head">USERNAME</th>
                        <th scope="col" width="10%" id="head">PRODUCT DESCRIPTION</th>
                        <th scope="col" width="5%" id="head">PRICE</th>
                        <th scope="col" width="5%" id="head">TOTAL</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row=mysqli_fetch_assoc($query_run)) { ?>
                    <tr class="fw-bold">
                        <td><?php echo $row['invoiceNo']?></td>
                        <td><?php echo $row['username']?></td>
                        <td><?php echo $row['order_productname'] ." ".  $row['order_productqty'] ?>(qty)</td>
                        <td>&#8369; <?php echo number_format($row['order_productprice'],2) ?></td>
                        <td>&#8369;
                            <?php
                $total = 0.00;
                $total += $row["productTotal"];
                echo number_format($total,2);
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

<!---------------- END OPERATIONS MANAGER ----------------->
<?php }?>



<?php
		include 'include/scripts.php'; 
        include 'include/rgpi-footer.php';  
		
	?>
<?php }else{
	header("Location: rgpi-login.php");
} ?>