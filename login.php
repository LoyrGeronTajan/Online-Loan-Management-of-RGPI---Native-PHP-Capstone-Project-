<?php
use CapstoneProject\Member;
session_start();

if (! empty($_POST["login-btn"])) {
    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();
    $loginResult = $member->loginMember();
}

if (isset($_SESSION["locked"]))
{
    $difference = time() - $_SESSION["locked"];
    if ($difference > 10)
    {
        unset($_SESSION["locked"]);
        unset($_SESSION["login_attempts"]);
    }
}
?>
<html>

<head>


    <title>Login Form | Right Goods Philippines Inc.</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/registration.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/img/favicon.ico">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>

    <script language="javascript" text="text/javascript">
        window.history.forward(1);
    </script>
</head>

<body>
    <div class="container register">
        <!--Start Container-->
        <div class="row">
            <!--Start Row-->
            <div class="col-md-3 register-left">
                <img src="assets/img/icon2.png" alt="" class="img-fluid" style="min-height: 5%; min-width: 50%;">
                <p>Right Goods Philippines Inc.</p>
                <a href="newcommer-registration.php"><input type="button" name="" value="Sign Up" /></a>  
            </div>

            <div class="col-md-9 register-right">


                <div class="tab-content" id="myTabContent">
                    <?php if(!empty($loginResult)){?>
                    <div class="alert alert-danger" role="alert">
                        <div class="error-msg"><?php echo $loginResult;?> <button class="btn-sm btn-danger float-right"
                                type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">X</span></button></div>
                    </div>
                    <?php }?>

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                        <form action="" class="shadow pb-5 rounded" name="sign-up" method="POST"
                            onsubmit="return signupValidation()">
                            <!--Start Form-->
                            <h3 class="register-heading">Login Form</h3>
                            <div class="row register-form">
                                <div class="col-md-12">

                                    <div class="form-group">

                                        <div class="form-group">
                                            <span class="required error" id="fullname-info"></span>
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="Username *" required>
                                        </div>
                                        <div class="form-group">
                                            <span class="required error" id="company-info"></span>
                                            <input type="password" name="login-password" class="form-control"
                                                id="login-password" placeholder="Password *" required>
                                            
                                            
                                        </div>
                                        
                                        <a href="forgot.php" >Forgot Password?</a>

                                        <div class="mb-3">
                                            <?php
                                       
						/**** LIMIT LOGIN ATTEMPTS *****/
						/**** DISABLED LOGIN BUTTON *****/

						// In sign-in form submit button
						if(!isset($_SESSION["login_attempts"]))
						{
							$_SESSION["login_attempts"] = 0;
                            
							?>

                            <center><input class="btn btn-primary" type="submit" name="login-btn" id="login-btn" value="Login"></center>

                            <?php
						}
						else
						{
							if ($_SESSION["login_attempts"] > 4)
							{
								$_SESSION["locked"] = time();
								echo "<p class='text-danger'>You've reached maximum attempts. Refresh after 10 seconds </p>";
                                
                            }
							else
							{
							
							?>

                            <center><input class="btn btn-primary" type="submit" name="login-btn" id="login-btn" value="Login"></center>

                            <?php
							
							}

							
								
						}
						?>


                            </div>
                        </div>


                        </form>
                        <!--End Form-->


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--End Row-->




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script>
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 10000);



        function loginValidation() {
            var valid = true;
            $("#username").removeClass("error-field");
            $("#password").removeClass("error-field");

            var UserName = $("#username").val();
            var Password = $('#login-password').val();

            $("#username-info").html("").hide();

            if (UserName.trim() == "") {
                $("#username-info").html("required.").css("color", "#ee0000").show();
                $("#username").addClass("error-field");
                valid = false;
            }
            if (Password.trim() == "") {
                $("#login-password-info").html("required.").css("color", "#ee0000").show();
                $("#login-password").addClass("error-field");
                valid = false;
            }
            if (valid == false) {
                $('.error-field').first().focus();
                valid = false;
            }
            return valid;


        }
    </script>

    <?php
        include 'include/scripts.php';
?>
</body>

</html>