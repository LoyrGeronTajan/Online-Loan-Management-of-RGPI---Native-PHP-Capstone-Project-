<?php 
   session_start();	
   include "lib/config.php";

   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

<head>
    <title>List of KAE | Right Goods Philippines Inc.</title>
</head>


<!---------------- OPERATIONS MANAGER ----------------->
<?php if ($_SESSION['rgpi-role'] == 'admin') {?>
<?php include 'include/rgpi-header.php';?>
<?php include 'include/rgpi-navbar.php'; ?>

<?php
    
    if(isset($_POST['btn-add-usertype']))
    {
        include "lib/config.php";

        $usertypeRole = $_POST['role'];
        $usertypeFname = $_POST['fname'];
        $usertypeUid = $_POST['username'];
        $usertypeEmail = $_POST['email'];
        $usertypeImage = $_FILES['kae-image']['name'];
        


        $hashedPassword = md5($_POST['password']);

        $query = "INSERT INTO usertype (`role`,`username`,`password`,`name`,`email`,`userImage`) VALUES ('$usertypeRole','$usertypeUid','$hashedPassword','$usertypeFname','$usertypeEmail','$usertypeImage')";

        $query_run = mysqli_query($conn,$query);

        if($query_run)
        {  
            move_uploaded_file($_FILES["kae-image"]['tmp_name'], "assets/img/employee/" . $_FILES['kae-image']['name']);

            echo '         
            <script>
            swal({
                title: "Success!",
                timer: 3000,
                icon: "success",
                
            }).then(function() {
                window.location = "rgpi-kaelist.php";
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
                window.location = "rgpi-kaelist.php";
            });

            </script>
            ';
        }
    }

    /**** DELETE USERS' ******/

    if (isset($_POST['btn-delete-kae'])) 
    {
        $product_id = $_POST['kae_delete_id'];

        $conn = new mysqli('localhost','root','','rgpi');
        $query = "DELETE FROM usertype WHERE id='$product_id' ";
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
                window.location = "rgpi-kaelist.php";
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
                window.location = "rgpi-kaelist.php";
            });

            </script>
            ';
        
            exit();
        }

    }
?>






<div class="container-fluid">

    <div class="card mt-3">
        <div class="card-header ">
            <div class=" col-sm-12 col-md-12 col-lg-12 fw-bold text-center text primary">
                <button 
                type="button" 
                class="btn btn-sm btn-outline-success float-sm-start" data-toggle="modal"
                data-bs-toggle="modal" data-bs-target="#addkae">
                    Add new KAE
                </button>
                <h6 class="float-end">LIST OF USERS
                    <span style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.
                    </span>
                </h6>
            </div>
        </div>
    </div>



    <div class="card-body">
        <div class="table-responsive">

            <?php
            
                include 'lib/config.php';
                $conn = new mysqli('localhost','root','','rgpi');
                $query = "SELECT * From usertype ORDER BY role='user'";
                $query_run = mysqli_query($conn,$query);

                if (mysqli_num_rows($query_run) > 0) 
                {
            ?>


            <table class="table table-bordered table-hover" id="datatable" >
                <thead align="middle">
                        <tr class="table-primary text-dark">
                        <th>Role</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody align="middle">
                    <?php while ($row = mysqli_fetch_assoc($query_run)) { ?>

                    <tr align="center">
                        <td><?php echo $row['role'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td>
                            <div style="width: 10rem;">
                                <a href="assets/img/employee/<?php echo $row['userImage']?>">
                                    <img class="img-fluid" src="assets/img/employee/<?php echo $row['userImage']?>" alt="">
                                </a>
                            </div>
                        </td>

                       
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="kae_delete_id" value="<?php echo $row['id']?>" />
                                <button 
                                type="submit" 
                                name="btn-delete-kae"
                                class="btn btn-sm btn-outline-danger d-flex justify-content-center"
                                data-bs-toggle="tooltip" 
                                title="Delete KAE">
                                    
                                <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                        <!-- </td> -->
                    </tr>

                    <?php } ?>

                </tbody>
            </table>

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
                          <h6 class="card-title fw-bold">Empty List 
                          </h6>
                        </div>
                      </div>
                    </div>
                    </div>';  
                }
                ?>
    </div>
</div>
</div>

<script>
    $('#btn').on('click', function () {
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            type: 'success'
        })

    })
</script>








<?php }?>
<!---------------- END OPERATIONS MANAGER ----------------->


<?php
        
		include 'include/scripts.php'; 
        include 'include/rgpi-footer.php';  
		include 'include/add-kae-modals.php';
	?>
<?php }else{
	header("Location: rgpi-login.php");
} ?>