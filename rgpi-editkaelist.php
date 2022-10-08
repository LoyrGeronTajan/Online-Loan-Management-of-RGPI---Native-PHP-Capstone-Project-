<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>
    <title>Edit KAE | Right Goods Philippines Inc.</title>
</head>

<!---------------- OPERATIONS MANAGER----------------->
<?php if ($_SESSION['rgpi-role'] == 'admin') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>

<div class="container-fluid">
    <div class="card">

        <div class="bg-primary card-header">
            <h4 class="text-center text-white">
                Edit KAE | Right Goods Philippines Inc.
                </button>

            </h4>
        </div>
    </div>
    <div class="card-body">
        <!-- function CRUD PRODUCT -->
        <?php
/* EDIT BUTTON */
if (isset($_POST['btn-update-product'])) 
{
    $kaeid = $_POST['edit_kae_id'];
    $kaefname = $_POST['edit-fname'];
    $kaeemail = $_POST['edit-email'];

    $conn = new mysqli('localhost','root','','u594053229_rgpiDatabase');
        $query = "UPDATE usertype SET 
            name='$kaefname',
            email='$kaeemail'
            WHERE id = '$kaeid';
        ";
        $query_run = mysqli_query($conn,$query);

        if ($query_run) 
        {
            echo '
                <div class="card">
                <div class="card-body">
                    <div class="col-sm-12 col-md-12 col-lg-12 alert alert-success align-middle">
                        <h6 class="fw-bold text-center">
                        KAE updated!</h6>
                    </div>
                    <a href="rgpi-kaelist.php">
                    <button type="button" class="btn btn-primary float-end p-3">Go back to KEY ACCOUNTS EXECUTIVE</button> 
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
                <div class="col-sm-12 col-md-12 col-lg-12 alert alert-danger align-middle">
                    <h6 class="fw-bold text-center">
                    KAE not updated!</h6>
                </div>
                <a href="rgpi-kaelist.php">
                <button type="button" class="btn btn-primary float-end p-3">Go back to KEY ACCOUNTS EXECUTIVE</button> 
                </a>
            </div>
            </div>
            ';
        exit();
        }
}
?>
        <?php
            
                if (isset($_POST['btn-edit-kae'])) 
                {
                    $kaeid = $_POST['edit_id'];
                    
                    include 'lib/config.php';
                    // $role = $_POST["role"];
                    $conn = new mysqli('localhost','root','','rgpi');
                    $query = "SELECT * From usertype WHERE id = '$kaeid';";
                    $query_run = mysqli_query($conn,$query);

                    if (mysqli_num_rows($query_run) > 0) 
                    {
            ?>
        <?php while ($row = mysqli_fetch_assoc($query_run)) { ?>

        <form action="" method="post">
            <input type="hidden" name="edit_kae_id" value="<?php echo $row['id'];?>">
            <div class="form-floating mb-3">
                <input type="text" name="edit-fname" id="floatingInput" class="form-control"
                    value="<?php echo $row['name'];?>">
                <label for="floatingInput">Fullname</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="edit-email" id="floatingInput" class="form-control"
                    value="<?php echo $row['email'];?>">
                <label for="floatingInput">Email Address</label>
            </div>


            <a href="rgpi-kaelist.php" class="btn btn-primary">Cancel</a> &nbsp;
            <button type="submit" name="btn-update-product" class="btn btn-success">Update</button>
        </form>

        <?php } ?>


    </div>
    <?php
                        }
                        else
                        {
                           echo "\n No KAE found!";
                        }
                        ?>
</div>
<?php

                }
            ?>

<?php }?>
<!---------------- END OPERATIONS MANAGER----------------->


<?php
		include 'include/scripts.php'; 
        include 'include/rgpi-footer.php';  
		
	?>
<?php }else{
	header("Location: rgpi-login.php");
} ?>