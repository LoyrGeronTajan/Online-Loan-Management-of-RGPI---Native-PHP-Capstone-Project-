<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>
    <title>Customers' Profile | Right Goods Philippines Inc.</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<!---------------- OPEARATIONS MANAGER ----------------->
<?php if ($_SESSION['rgpi-role'] == 'admin') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>

<div class="container-fluid">
    <?php
        if(isset($_POST['btn-delete-profile']))
        {
            $customerId = $_POST['delete_id'];

            include 'lib/config.php';
            
            $sql = "DELETE FROM tbl_member WHERE id='$customerId'";
            $sql_run = mysqli_query($conn,$sql);

            if ($sql_run)
            {
                echo '
                <script>
                swal({
                    title: "Success!",
                    timer: 3000,
                    icon: "success",
                    
                }).then(function() {
                    window.location = "rgpi-borrowersprofile.php";
                });
    
                </script>
                ';
            }
            
        }
    ?>

    <div class="card mt-3">
        <div class="card-header ">
            <h6 class="m-0 text-center text primary float-end">
                Set Credit Limit
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
        $query="SELECT * From tbl_member WHERE creditLimit = '' and status = 'approve';";
        $query_run=mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
    ?>
            <table class="table table-bordered table-hover" id="datatable">
                <thead>
                    <tr class="table-primary text-dark">
                        <th>USERNAME</th>
                        <th>CREDIT LIMIT</th>
                        <th>NAME</th>
                        <th>COMPANY NAME</th>
                        <th>EMAIL</th>
                        <th>CONTACT</th>
                        <th>ADDRESS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row=mysqli_fetch_assoc($query_run)) { ?>
                    <tr class="fw-bold" scope="row">
                        <td><?php echo $row['username']?></td>
                        <td style="color: #ff4d4d;">&#8369; <?php echo number_format($row['creditLimit'],2) ?></td>
                        <td><?php echo $row['fullname']?></td>
                        <td><?php echo $row['company'] ?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['address'] ?></td>


                        <td class="align-middle btn-group">
                            <form action="rgpi-editBorrower.php" method="POST">
                                <input type="hidden" name="edit_id" value="<?php echo $row['id']?>" />
                                <button 
                                type="submit" 
                                name="btn-edit-profile" 
                                class="btn btn-sm btn-outline-info"
                                data-bs-toggle="tooltip" 
                                title="Add Credit Limit">
                                <i class="fas fa-edit"></i>
                                </button>
                            </form>

                            <form action="" method="POST">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']?>" />
                                <button 
                                type="submit" 
                                name="btn-delete-profile" 
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="tooltip" 
                                title="Delete Borrowers">
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
<!---------------- END OPEARATIONS MANAGER ----------------->


<?php
		include 'include/scripts.php'; 
        include 'include/rgpi-footer.php';  
		
	?>
<?php }else{
	header("Location: rgpi-login.php");
} ?>