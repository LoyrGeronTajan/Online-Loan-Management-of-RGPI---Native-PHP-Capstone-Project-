<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Edit Product | Right Goods Philippines Inc.</title>
</head>



<!---------------- OPERATIONS MANAGER ----------------->
<?php if ($_SESSION['rgpi-role'] == 'admin') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>

<div class="container-fluid">
    <div class="card">

        <div class="bg-primary card-header">
            <h4 class="text-center text-white">
                Edit Products | Right Goods Philippines Inc.
                </button>
            </h4>
        </div>
    </div>
    <div class="card-body">
        <?php
include 'lib/config.php';
/*EDIT BUTTON */
if (isset($_POST['btn-update-product'])) 
{
    
    $product_id = $_POST['edit_product_id'];
    $product_category = $_POST['edit_product_category'];
    $product_name = $conn -> real_escape_string($_POST['edit_product_name']);
    $product_image = $_FILES["product_image"]['name'];
    $product_price = $_POST['edit_product_price'];

    
    $conn = new mysqli('localhost','root','','rgpi');
    $product_image_query = "SELECT * FROM addnewproduct WHERE id='$product_id'";
    $product_image_query_run = mysqli_query($conn,$product_image_query);
        foreach ($product_image_query_run as $imageRow) 
        {
            //echo $imageRow['productImage'];

            if ($product_image == NULL) 
            {
                //Update with existing image;
                $imageData = $imageRow['productImage'];
            }
            else
            {
                //Update with old product image to new product image
                if ($img_path = "assets/img/new-product/" . $imageRow['productImage']) 
                {
                    unlink($img_path);
                    $imageData = $product_image;
                }
            }
        }

        $conn = new mysqli('localhost','root','','rgpi');
        $query = "UPDATE addnewproduct SET 
            productName='$product_name',
            category='$product_category',
            productImage='$imageData', 
            productPrice='$product_price' WHERE id = '$product_id'
        ";
        $query_run = mysqli_query($conn,$query);


        if ($query_run) 
        {
            if ($product_image == NULL) 
            {
                //Update existing image;
                echo '
                <script>
                    swal({
                        title: "Product Updated!",
                        timer: 3000,
                        icon: "success",

                    }).then(function() {
                        window.location = "rgpi-addnewproduct.php";
                    });
            
                </script>        
                ';
                echo '
                
                ';
             
                exit();
            }
            else
            {
                //Update with old product image to new product image
                move_uploaded_file($_FILES["product_image"]['tmp_name'], "assets/img/new-product/" . $_FILES["product_image"]['name']);
                
                echo '
                <script>
                    swal({
                        title: "Product Updated!",
                        timer: 3000,
                        icon: "success",

                    }).then(function() {
                        window.location = "rgpi-addnewproduct.php";
                    });
            
                </script>   
                ';
                exit();
            }
            
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
                window.location = "rgpi-addnewproduct.php";
            });
    
        </script>   
                ';
            header('Loaction:rgpi-editproduct.php?message=notupdated');
            exit();
        }
}
?>
        <?php
         include 'lib/config.php';

         if (isset($_POST['btn-edit-product']))
         {
            $product_id = $_POST['edit_id'];
            $query = "SELECT * FROM addnewproduct WHERE id='$product_id' ";
            $query_run = mysqli_query($conn,$query);
            foreach($query_run as $row) :
    ?>
        <form action="rgpi-editproduct.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="edit_product_id" value="<?php echo $row['id'];?>">

            <div class="form-floating mb-3">
                <input type="file" name="product_image" value="<?php echo $row['productImage'];?>"
                    class="form-control" />
                <label for="">Product Image</label>
            </div>

            <div class=" mb-3"> <label for="exampleFormControlSelect1" class="text-muted">Product Category</label>
                <select name="edit_product_category" class="form-control">
                    <option value="<?php echo $row['category']?>"><?php echo $row['category']?></option>
                    <option value="1">1 : Baby Care</option>
                    <option value="2">2 : Fabric Care</option>
                    <option value="3">3 : Family Care</option>
                    <option value="4">4 : Feminine Care</option>
                    <option value="5">5 : Grooming</option>
                    <option value="6">6 : Hair Care</option>
                    <option value="7">7 : Home Care</option>
                    <option value="8">8 : Oral Care</option>
                    <option value="9">9 : Perosnal Health Care</option>
                    <option value="10">10 : Skin & Personal Care</option>
                </select>
               
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="edit_product_name" class="form-control"
                    value="<?php echo $row['productName'];?>" />
                <label for="">Product Description</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="any" name="edit_product_price" value="<?php echo $row['productPrice'];?>"
                    class="form-control" />
                <label for="">Price</label>
            </div>

            <a href="rgpi-addnewproduct.php" class="btn btn-danger">Cancel</a> &nbsp;
            <button type="submit" name="btn-update-product" class="btn btn-success">Update</button>
        </form>
        <?php
            endforeach;
    
        }
    ?>

    </div>
</div>
<?php }?>
<!---------------- END OPERATIONS MANAGER ----------------->


<?php
		include 'include/scripts.php'; 
        include 'include/rgpi-footer.php';  
		
	?>
<?php }else{
	header("Location: rgpi-login.php");
} ?>