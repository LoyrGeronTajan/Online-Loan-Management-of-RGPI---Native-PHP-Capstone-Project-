<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<!DOCTYPE html>

<head>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Product Management | Right Goods Philippines Inc.</title>
    <style>
        #head {
            font-weight: bold;
            font-size: 17px;
            text-align: center;
            font-family: 'Source Sans Pro', sans-serif;
        }

        tr {
            text-align: center;
        }

        img {
            width: 10rem;
        }
    </style>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/img/favicon.ico">
</head>


<body>

    <!---------------- OPERATIONS MANAGER ----------------->
    <?php if ($_SESSION['rgpi-role'] == 'admin') {?>
    <?php include 'include/rgpi-header.php';?>
    <?php include 'include/rgpi-navbar.php'; ?>

    <?php
    // Add
    if(isset($_POST['btn-add-product']))
    {
        $product_image = $_FILES["add_product_image"]['name'];
        $product_category = $_POST['category'];
        $product_name = $conn -> real_escape_string(ucwords($_POST['product_name']));
        $product_price = $_POST['product_price'];

     
        if (file_exists("assets/img/new-product/" . $_FILES["add_product_image"]['name'])) {
            $store = $_FILES["add_product_image"]['name'];
            echo "Image Already Exists. '.$store.'";
        }
        else
        {
            include "lib/config.php";

            $conn = new mysqli('localhost','root','','rgpi');
            $query = "INSERT INTO addnewproduct (`category`,`productName`,`productImage`,`productPrice`) VALUES ('$product_category','$product_name','$product_image','$product_price')";
            $query_run = mysqli_query($conn,$query);
    
                if ( $query_run) 
                {
                    move_uploaded_file($_FILES["add_product_image"]['tmp_name'], "assets/img/new-product/" . $_FILES["add_product_image"]['name']);
                    echo '
                    <script>
                    swal({
                        title: "Product Added!",
                        timer: 3000,
                        icon: "success",
                        
                    }).then(function() {
                        window.location = "rgpi-addnewproduct.php";
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
                        timer: 3000,
                        icon: "error",
                        
                    }).then(function() {
                        window.location = "rgpi-addnewproduct.php";
                    });
        
                    </script>
                    ';
                    exit();
                }
        }
    }
    // Delete
    if (isset($_POST['btn-delete-product'])) 
    {
        $product_id = $_POST['btn_delete_id'];
        $conn = new mysqli('localhost','root','','rgpi');
        $query = "DELETE FROM addnewproduct WHERE id='$product_id' ";
        $query_run = mysqli_query($conn,$query);

        if ($query_run) 
        {
            echo '
            <script>
            swal({
                title: "Deleted!",
                timer: 3000,
                icon: "success",
                
            }).then(function() {
                window.location = "rgpi-addnewproduct.php";
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
                timer: 3000,
                icon: "error",
                
            }).then(function() {
                window.location = "rgpi-addnewproduct.php";
            });

            </script>
            ';
           
            exit();
        }

    }

    // Edit
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
        }
    }
    ?>

    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-header ">
           
                

                <div class=" col-sm-12 col-md-12 col-lg-12 fw-bold text-center text primary">
                    <button type="button" class="btn btn-sm btn-outline-success mb-2 float-sm-start" data-bs-toggle="modal" data-bs-target="#addnewproduct" data-bs-toggle="tooltip" title="Add Product">
                        <i class="far fa-plus-square"></i>
                    </button>
                    <h6 class="float-end">PRODUCT MANAGEMENT
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
                $query="Select * From addnewproduct ORDER BY category";
                $query_run=mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0) {
            ?>
                <table class="table table-bordered table-hover" id="datatable">
                    <thead>
          
                        <tr class="table-primary text-dark">
                                <th>PRODUCT CATEGORY</th>
                                <th>DESCRIPTION</th>
                                <th>IMAGE</th>
                                <th>PRICE</th>
                                <th>ACTION</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($row=mysqli_fetch_assoc($query_run)) { ?>
                        <tr>
                            <td><?= $row['category'] ?></td>
                            <td><?= $row['productName'] ?></td>
                            <td><?= "<img class='img-fluid' src='assets/img/new-product/".$row['productImage']."' >"; ?></td>
                            <td>&#8369; <?= $row['productPrice'] ?></td>

                            <td>
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#edit<?= $row['id']?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete<?= $row['id'] ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
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
    <?php
    include "lib/config.php";
    $result = mysqli_query($conn, 'Select * From addnewproduct ORDER BY category');
    while ($data = mysqli_fetch_array($result))
    {
      include 'include/add-new-product-modals.php';
      
    }
    ?>








    <!---------------- END OPERATIONS MANAGER ----------------->

    <?php } ?>

    <?php
		include 'include/rgpi-footer.php';  
		include 'include/scripts.php'; 
	?>
    <?php
    }
    else
    {
	header("Location: rgpi-login.php");
    } ?>
