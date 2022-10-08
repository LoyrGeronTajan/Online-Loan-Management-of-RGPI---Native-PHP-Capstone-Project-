<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>
    <title>Newcomer Profile | Right Goods Philippines Inc.</title>
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

                <h6 class="float-end">NEWCOMERS' PROFILE
                    <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI. </span>
                </h6>
                
                
                <form action="newcommerPdf.php" method="POST" target="_blank">

                    <button type="submit" name="btn-print-newcommer"
                        class="btn btn-sm btn-info d-flex justify-content-center">
                        EXPORT DATA</button>
                </form>
            </div>


        </div>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <?php
            /********************** DEFAULT PRODUCT MANAGEMENT ***********************/
                include 'lib/config.php';
                $conn = new mysqli('localhost','root','','rgpi');
                $query="SELECT * From tbl_newcommer WHERE status ='pending' ORDER BY create_at";
                $query_run=mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0) {
            ?>
            <table class="table table-bordered table-hover " id="datatable">
                <thead>
                    <tr class="table-primary text-dark">
                        <th>Company Name</th>
                        <th>Business Permit</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact Information</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>


                    <?php while ($row=mysqli_fetch_assoc($query_run)) { ?>
                    <th scope="row"></th>
                    <tr class="fw-bold align-middle">
                        <td class="align-middle"><?php echo $row['newcommer_company'] ?></td>

                        <td class="align-middle">
                           <a href="assets/img/newcommer-permit/<?php echo $row['newcommer_businessPermit']?>">
                                    <img src="assets/img/newcommer-permit/<?php echo $row['newcommer_businessPermit']?>"
                                        $width="960" $height="300" alt="">
                                </a>
                        </td>

                        <td class="align-middle"><?php echo $row['newcommer_address']  ?></td>
                        <td class="align-middle"><?php echo $row['newcommer_email']  ?></td>
                        <td class="align-middle"><?php echo $row['newcommer_contact']  ?></td>

                        <td class="align-middle btn-group">
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['newcommer_id']?>" />

                                <input type="hidden" name="newcommer_email"
                                    value="<?php echo $row['newcommer_email']?>">

                                <input type="hidden" name="newcommer_company"
                                    value="<?php echo $row['newcommer_company']?>">

                                <input type="hidden" name="newcommer_address"
                                    value="<?php echo $row['newcommer_address']?>">

                                <input type="hidden" name="newcommer_contact"
                                    value="<?php echo $row['newcommer_contact']?>">

                                <button type="submit" name="btn-approve-newcommer" class="btn btn-sm btn-outline-success"
                                    data-bs-toggle="tooltip" title="Approve Newcommer">
                                    <i class="far fa-thumbs-up"></i>
                                </button>
                            </form>
                        
                            <form action="" method="POST">
                                <input type="hidden" name="id"
                                    value="<?php echo $row['newcommer_id']?>" />
                                <button type="submit" name="btn-delete-newcommer" class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="tooltip" title="Delete Newcomer">
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
    if (isset($_POST['btn-approve-newcommer'])) 
    {
        $id = $_POST['id'];
        $email = $_POST['newcommer_email'];
        $company = $_POST['newcommer_company'];
        $address = $_POST['newcommer_address'];
        $contact = $_POST['newcommer_contact'];


        
        //SQL QUERY
        $query1 = "UPDATE tbl_newcommer SET status = 'approved' WHERE newcommer_id = '$id'; ";
        $query_run1 = mysqli_query($conn,$query1);

        if ($query_run1) 
        {
            
            echo '
                <script>
                swal({
                    title: "Approve!",
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
                    title: "Error!",
                    timer: 10000,
                    icon: "error",
                    
                }).then(function() {
                    window.location = "rgpi-newcommer.php";
                });
    
                </script>
            ';

        }
    }
    
    
    if (isset($_POST['btn-delete-newcommer'])) 
    {
        $id = $_POST['id'];
    
        echo $id;


        
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
                    title: "Error!",
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