<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>
    <title>Credit Limit Request | Right Goods Philippines Inc.</title>
    <style>
        img {
            width: 10rem;
        }
    </style>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<!---------------- OPERATIONS MANAGER ----------------->
<?php if ($_SESSION['rgpi-role'] == 'admin') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>



<div class="container-fluid">

    <div class="card mt-3">
        <div class="card-header ">

            <div class=" col-sm-12 col-md-12 col-lg-12 fw-bold text-center text primary">

                <h6 class="float-end">Customers' Credit Limit Request
                    <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI. </span>
                </h6>
            </div>


        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <?php
            /********************** DEFAULT PRODUCT MANAGEMENT ***********************/
                include 'lib/config.php';
                $conn = new mysqli('localhost','root','','rgpi');
                $query="SELECT * From tbl_member WHERE requestCreditlimit = 'request' ORDER BY id";
                $query_run=mysqli_query($conn, $query);
                

                if (mysqli_num_rows($query_run) > 0) {
            ?>



            <table class="table table-bordered table-hover " id="dataTable">
                <thead>
                    <tr class="table-primary text-dark" style="text-align: center">
                        <th scope="col" width="20%" id="head">Company Name</th>
                        <th scope="col" width="20%" id="head">Previous Credit Limit</th>
                        <th scope="col" width="20%" id="head">Email Address</th>
                        <th scope="col" width="10%" colspan="3" id="head">Action</th>
                    </tr>
                </thead>
                <tbody>


                    <?php while ($row=mysqli_fetch_assoc($query_run)) { ?>
                    <th scope="row"></th>
                    <tr class="fw-bold" style="text-align: center">
                        <td class="align-middle">
                            <?php echo $row['company'] ?>
                        </td>
                        <td class="align-middle text-secondary">&#8369; <?php echo number_format($row['creditLimit'],2)  ?></td>
                        <td class="align-middle"><?php echo $row['email']  ?></td>

                        <td class="align-middle"> 
                            <form action="rgpi-transactionHistory.php" method="post">
                                <input type="hidden"  name="edit_id" value="<?php echo $row['id']?>" />
                                <input type="hidden"  name="username" value="<?php echo $row['username']?>" />

                                    <button type="submit" name="btn-transactionHistory"
                                        class="btn btn-sm btn-outline-info"
                                        data-bs-toggle="tooltip" 
                                        title="See Transaction History"> 
                                        <i class="fas fa-history"></i>
                                    </button>
                            </form>
                        </td>

                        <td class="align-middle">
                            <form action="rgpi-creditlimitSet.php" method="post">
                                <input 
                                    type="hidden" 
                                    name="request-id"
                                    value="<?php echo $row['id']?>" />
                                <input 
                                    type="hidden" 
                                    name="request-company"
                                    value="<?php echo $row['company']?>" />    

                                <button type="submit" name="btn-approve-request" class="btn btn-sm btn-outline-success"
                                    data-toggle="modal"
                                    data-target="#request"
                                    data-bs-toggle="tooltip" title="Approve Request">
                                  
                                    <i class="far fa-thumbs-up"></i>
                                </button>
                            </form>
                        </td>

                        <td class="align-middle">
                            <form action="rgpi-creditlimit.php" method="POST">
                                <input type="hidden" name="request-id"
                                    value="<?php echo $row['id']?>" />

                                <input type="hidden" name="request-company"
                                    value="<?php echo $row['company']?>" />  
                                      
                                <button type="submit" name="btn-decline-request" class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="tooltip" title="Decline Request">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>



                        
                       

                        




                    </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>


    <?php
        }
        else 
        {
            //echo "\n No items found!";
            echo '<div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
                    <div class="card mb-5">
                    
                      <div class="card-shadow text-center">
                        <div class="card-body">
                          <img src="assets/img/emptyuser.gif" class="img-fluid" alt="gif" style=" width: 150px; height: 150px;">
                         
                        </div>
                      </div>
                    </div>
                    </div>';  
        }

    ?>

</div>








<?php }?>
<!---------------- END OPERATIONS MANAGER ----------------->


<!---------- PHP FUNCTION  --------------->
<?php
    include 'lib/config.php';
    if (isset($_POST['btn-decline-request'])) 
    {
        $id = $_POST['request-id'];
        $company = $_POST['request-company'];


        
        //SQL QUERY
        $query1 = "UPDATE tbl_member SET requestCreditlimit = 'declined' WHERE id = '$id'; ";
        $query_run1 = mysqli_query($conn,$query1);

        if ($query_run1) 
        {
            
            echo '
                <script>
                swal({
                    title: "You have been declined request of '.$company.'",
                    timer: 10000,
                    icon: "success",
                    
                }).then(function() {
                    window.location = "rgpi-creditlimit.php";
                });
    
                </script>
            ';

                exit();
        }
        else
        {
            echo '
                <script>
                swal({
                    title: "Error",
                    timer: 10000,
                    icon: "error",
                    
                }).then(function() {
                    window.location = "rgpi-creditlimit.php";
                });
    
                </script>
            ';
        }
    }
    
    
    if (isset($_POST['btn-approve-request'])) 
    {
        $id = $_POST['request-id'];
        $company = $_POST['request-company'];
    
        //echo $id;


        
        // //SQL QUERY
        $query = "UPDATE tbl_newcommer SET status = 'notapproved' WHERE newcommer_id = '$id'; ";
        $query_run = mysqli_query($conn,$query);

        if ($query_run) 
        {
            
            echo '
                <script>
                swal({
                    title: "Deleted!",
                    timer: 10000,
                    icon: "success",
                    
                }).then(function() {
                    window.location = "rgpi-newcommer.php";
                });
    
                </script>
            ';

                exit();
        }
        else
        {
            echo '
            <script>
            swal({
                title"Error!",
                timer: 10000,
                icon: "error",
                
            }).then(function() {
                window.location = "rgpi-newcommer.php";
            });

            </script>
            ';
        }
    }
    
    
    
        

?>
<?php
		include 'include/scripts.php'; 
        include 'include/rgpi-footer.php';  
		
	?>
<?php }else{
	header("Location: rgpi-login.php");
} ?>