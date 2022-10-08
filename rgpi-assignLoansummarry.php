<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>
    <title>Assign KAE | Right Goods Philippines Inc.</title>
</head>



<!---------------- OPERATIONS MANAGER----------------->
<?php if ($_SESSION['rgpi-role'] == 'admin') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>

<div class="container-fluid">

    <div class="card-body">

<?php
include 'lib/config.php';
/*EDIT BUTTON */
if (isset($_POST['btn-choose-kae'])) 
{
    
    $invoiceNo = $_POST['invoiceNo'];
    $kaeList = $_POST['kaeList'];
    $date = $_POST['dateAssigned'];


    $conn = new mysqli('localhost','root','','rgpi');
        $query = "UPDATE invoice SET 
            kaeName='$kaeList',
            dateAssigned = '$date'
             WHERE invoiceNo = '$invoiceNo';
        ";
        $query_run = mysqli_query($conn,$query);


        if ($query_run) 
        {
            include 'lib/config.php';
            //SQL QUERY
            $query1 = "UPDATE cartorder SET status = 2 WHERE invoiceNo = '$invoiceNo'; ";
            $query_run1 = mysqli_query($conn,$query1);
            echo '
            <script>
            swal({
                title: "Success!",
                timer: 3000,
                icon: "success",
                
            }).then(function() {
                window.location = "rgpi-loansummary.php";
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
                window.location = "rgpi-loansummary.php";
            });

            </script>
            ';
            
            exit();
        }
    
}
?>
        <?php
         include 'lib/config.php';

         if (isset($_POST['btn-edit-product']))
         {
             
            $product_id = $_POST['edit_id'];
            $query = "SELECT * FROM invoice WHERE invoiceNo='$product_id' ";
            $query_run = mysqli_query($conn,$query);
    
            foreach($query_run as $row) :
            ?>
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title">Assign to Key Accounts Executive</h5>
                </div>
                <div class="card-body">
                <!-- START FORM -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form mb-3">
                        <input type="hidden" name="invoiceNo" value="<?php echo $row['invoiceNo']?>">

                        <input type="hidden" name="dateAssigned" value="<?php echo date("Y-m-d")?>" />

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
                        <a href="rgpi-loansummary.php" class="btn btn-sm btn-secondary">Cancel</a>
                        <button type="submit" name="btn-choose-kae" class="btn btn-sm btn-outline-success"
                            id="btn">Assign</button>
                    </div>
                </form><!-- END FORM -->
                </div>
            </div>

        <?php
            endforeach;
    
        }
    ?>

    </div>
</div>
<?php }?>
<!---------------- END OPERATIONS MANAGER----------------->


<?php
		include 'include/scripts.php'; 
        include 'include/rgpi-footer.php';  
		
	?>
<?php }else{
	header("Location: rgpi-login.php");
} ?>