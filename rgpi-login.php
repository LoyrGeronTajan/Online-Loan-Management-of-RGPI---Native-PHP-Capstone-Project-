<?php 
   session_start();
   if (!isset($_SESSION['rgpi-username']) && !isset($_SESSION['rgpi-id'])) {   

	if (isset($_SESSION["locked"]))
{
    $difference = time() - $_SESSION["locked"];
    if ($difference > 10)
    {
        unset($_SESSION["locked"]);
        unset($_SESSION["adminlogin_attempts"]);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login | Right Goods Philippines Inc.</title>
	<!-- Custom CSS -->
	<link rel="stylesheet" href="assets/css/registration.css">

	<!-- FAVICON -->
	<link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/img/favicon.ico">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<?php include 'include/rgpi-header.php';?>
</head>

<body>

	<div class="container register">
		<!--Start Container-->
		<div class="row">
			<!--Start Row-->
			<div class="col-md-3 register-left">
				<img src="assets/img/icon2.png" alt="" class="img-fluid" style="min-height: 5%; min-width: 50%;">
				<p>Right Goods Philippines Inc.</p>
			</div>

			<div class="col-sm-9 register-right">


				<div class="tab-content" id="myTabContent">

					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<form class="shadow p-3 rounded" action="php/usertypeLogin.php" method="post">
							<h1 class="text-center p-3">LOGIN</h1>

							<?php if (isset($_GET['error'])) { ?>
							<div class="alert alert-danger" role="alert">
								<?=$_GET['error']?>
							</div>
							<?php } ?>

							<div class="mb-3">
								<label for="username" class="form-label">Username</label>
								<input type="text" class="form-control" name="username" id="username">
							</div>

							<div class="mb-3">
								<label for="password" class="form-label">Password</label>
								<input type="password" name="password" class="form-control" id="password">
							</div>

							<div class="mb-1">
								<label class="form-label">Select User Type:</label>
							</div>
							<select class="form-select mb-3" name="role" aria-label="Default select example">
								<option selected value="user">Key Accounts Executives</option>
								<option value="admin">Operations Manager</option>
							</select>
							
							<a href="rgpi-forgot.php" >Forgot Password?</a>

							<?php
                                            /**** LIMIT LOGIN ATTEMPTS *****/
                                            /**** DISABLED LOGIN BUTTON *****/

                                            //echo $_SESSION["adminlogin_attempts"];
                                            
                                            // In sign-in form submit button
                                            if(!isset($_SESSION["adminlogin_attempts"]))
                                            {
                                                $_SESSION["adminlogin_attempts"] = 0;
                                                ?>

							<center>
								<button type="submit" class="btn btn-sm btn-primary">LOGIN</button>
							</center>

							<?php
                                            }
                                            else
                                            {
                                                if ($_SESSION["adminlogin_attempts"] > 4)
                                                {
                                                    $_SESSION["locked"] = time();
                                                    echo "<p class='text-danger'>You've reached maximum attempts. Refresh after 10 seconds </p>";
                                                }
                                                else
                                                {
                                                
                                                ?>

							<center>
								<button type="submit" class="btn btn-sm btn-primary">LOGIN</button>
							</center>

							<?php
                                                
                                                }

                                                
                                                    
                                            }
                                            ?>

                        



						</form>
						
						


						<!--End Form-->


					</div>
				</div>

			</div>
		</div>
	</div>




	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<script>
		window.setTimeout(function () {
			$(".alert").fadeTo(500, 0).slideUp(500, function () {
				$(this).remove();
			});
		}, 10000);
	</script>

	<?php
        include 'include/scripts.php';
	?>
</body>

</html>
<?php }else{
	header("Location: rgpi-home.php");
} ?>