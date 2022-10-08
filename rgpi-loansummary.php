<?php 
    session_start();	
    include "lib/config.php";
    if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

    <head>

        <title>Summary of Ordered Loans | Right Goods Philippines Inc.</title>

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
        <!-- Add Product Modal -->
        <div class="modal fade" id="kaemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">
                            <p class="text-primary">Assign KAE</p>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>




                    <div class="modal-body">
                        <!-- START FORM -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form mb-3">

                                <?php
                                include 'lib/config.php';
                                $sql = "SELECT * FROM usertype WHERE role='user' ORDER BY name ";

                        

                                if($result = mysqli_query($conn, $sql)) {
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)){
                                            
                                            $dbselected = $row['id'];
                                            
                                            
                                        }
                                        mysqli_free_result($result);
                                    }
                                }
                        
                                
                                $options = mysqli_query($conn,$sql);
                                echo '<select name="kaeList" class="lead form-select form-select-lg-mb-3 text-muted text-uppercase">';
                                
                                foreach($options as $option){
                                    if($dbselected == $option) {
                                        echo "<option selected='selected' value='".$option["username"]."'>".$option["name"]."</option>";
                                    }
                                    else {
                                        echo "<option value='".$option["username"]."'>".$option["name"]."</option>";
                                    }
                                }
                                echo "</select>";
                                

                                
                            ?>

                            </div>

                            <div class="modal-footer mb-3">
                                <button type="button" class="btn btn-danger btn-rounded mt-3"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" name="btn-choose-kae" class="btn btn-success btn-rounded mt-3"
                                    id="btn">Add</button>
                            </div>


                        </form><!-- END FORM -->
                    </div>

                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header ">
                <h6 class="m-0 text-center text primary float-end">
                    SUMMARY OF ORDERED LOANS
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
            $query=" SELECT invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date, invoice.dateAssigned FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo WHERE invoice.status = 'notpaid' GROUP BY cartorder.invoiceNo;;

            ";

            
            $query_run=mysqli_query($conn, $query);

            if (mysqli_num_rows($query_run) > 0) {
        ?>

                <table class="table table-bordered caption-top table-hover" id="dataTable">
                    <thead>
                        <tr class="table-primary text-dark">
                            <th scope="col" width="5%" id="head">KAE</th>
                            <th scope="col" width="5%" id="head">Invoice No</th>
                            <th scope="col" width="5%" id="head">USERNAME </th>
                            <th scope="col" width="5%" id="head">ACCOUNT NAME </th>
                            <th scope="col" width="5%" id="head">ORDERED DATE</th>
                            <th scope="col" width="5%" id="head">DATE ASSIGNED</th>
                            <th scope="col" width="5%" id="head">TOTAL AMOUNT</th>

                            <th scope="col" width="5%" id="head">ACTION</th>
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
                            <td><?php echo $row['kaeName']?></td>
                            <td><?php echo $row['invoiceNo']?></td>
                            <td><?php echo $row['invoiceUsername']?></td>
                            <td><?php echo $row['invoiceCompany']?></td>
                            <td><?php echo $row['create_date']?></td>
                            <td><?php echo $row['dateAssigned']?></td>
                            <?php
                            //$total += $row['Total_Balance'];
                            $result = $row['Total_Balance'] * $subTotal;
                            $grandTotal = $row['Total_Balance'] + $result;
                            ?>
                            <td>&#8369; <?php echo number_format($grandTotal,2)?></td>

                            <td class="align-middle">
                                <form action="rgpi-assignLoansummarry.php" method="POST">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['invoiceNo']?>" />

                                    

                                <button 
                                    type="submit" 
                                    name="btn-edit-product" 
                                    class="btn btn-sm btn-outline-success"
                                    data-bs-toggle="tooltip" 
                                    title="Assign Transaction">
                                    <i class="fas fa-users"></i>
                                </button>
                                </form>
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
        echo "\n No Customer Loans Found!";
    }
    ?>

    </div>







    <?php }?>
    <!---------------- END OPERATIONS MANAGER ----------------->
    <?php ?>

    <?php
            include 'include/scripts.php'; 
            include 'include/rgpi-footer.php';  
            
        ?>
    <?php }else{
        header("Location: rgpi-login.php");
    } ?>