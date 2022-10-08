<?php
    session_start();
    $error = array();

    include 'lib/config.php';
    include "rgpi-mail.php";

    $mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

    //something is posted
	if(count($_POST) > 0){

		switch ($mode) {
            //enter_email
			case 'enter_email':
            
                $email = $_POST['email'];

                //validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Please enter a valid email";
				}elseif(!valid_email($email)){
					$error[] = "That email was not found";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($email);
					header("Location: rgpi-forgot.php?mode=enter_code");
					die;
				}
				
			break;

            //enter_code
			case 'enter_code':

                $code = $_POST['code'];
				$result = is_code_correct($code);

				if($result == "the code is correct"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: rgpi-forgot.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				
            break;	

            //enter_password
			case 'enter_password':

                $password = $_POST['password'];
				$password2 = $_POST['re-password'];

				if($password !== $password2){
					$error[] = "Passwords do not match";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: rgpi-forgot.php");
					die;
				}else{
					
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					header("Location: rgpi-login.php");
					die;
				}
				
            break;	
			
			default:
				
			break;
		}
	}

    function send_email($email){
		
		global $conn;

		$expire = time() + (60 * 1);
		$code = rand(10000,99999);
		$email = addslashes($email);

		$query = "insert into rgpiCodes (email,code,expire) value ('$email','$code','$expire')";
		mysqli_query($conn,$query);

		//send email here
		send_mail($email,'Password reset',"Your code is " . $code);
	}

    function save_password($password){
		
		global $conn;

		$password = md5($password);
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "update usertype set password = '$password' where email = '$email' limit 1";
		mysqli_query($conn,$query);

	}

    function valid_email($email){
		global $conn;

		$email = addslashes($email);

		$query = "select * from usertype where email = '$email' limit 1";		
		$result = mysqli_query($conn,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				return true;
 			}
		}

		return false;

	}

    function is_code_correct($code){
		global $conn;

		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "select * from rgpiCodes where code = '$code' && email = '$email' order by id desc limit 1";
		$result = mysqli_query($conn,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if($row['expire'] > $expire){

					return "the code is correct";
				}else{
					return "the code is expired";
				}
			}else{
				return "the code is incorrect";
			}
		}

		return "the code is incorrect";
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGPI Forgot Password | Right Goods Philippines Incorporated</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="assets/img/favicon.ico">



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



    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <style>
        .form-gap {
            padding-top: 70px;
        }
    </style>

</head>

<body>

</body>

</html>




<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    switch ($mode) {
                    case 'enter_email':
                        
                        ?>
                        
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-2x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>Enter your email below.</p>
                            <div class="panel-body">


                                <form action="rgpi-forgot.php?mode=enter_email" id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <span style="font-size: 12px;color:red;">
                                <?php 
                                    foreach ($error as $err) {
                                        // code...
                                        echo $err . "<br>";
                                    }
                                ?>
                                </span>    

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address" class="form-control"
                                                type="email">
                                        </div>
                                    </div>
                                    

                                    <input type="submit" class="btn btn-sm btn-primary" value="Next" style="float: right;">
                                    <a href="rgpi-forgot.php">
                                        <input type="button" class="btn btn-sm btn-primary float-left" value="Start Over">
                                    </a>

                                    
                                </form>

                                

                            </div>
                            <a href="rgpi-login.php" class="btn btn-sm btn-secondary float-right">Back to rgpi-Login</a>
                        </div>
                        <?php

                    break;

                    case 'enter_code':
                    
                        ?>
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-2x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>Enter the code sent to your email</p>
                            <div class="panel-body">
    
                                <form action="rgpi-forgot.php?mode=enter_code" id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                                <span style="font-size: 12px;color:red;">
                                <?php 
                                    foreach ($error as $err) {
                                        // code...
                                        echo $err . "<br>";
                                    }
                                ?>
                                </span>    

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="code" name="code" placeholder="12345" class="form-control"
                                                type="text">
                                        </div>
                                    </div>

                                    <input type="submit" class="btn btn-sm btn-primary" value="Next" style="float: right;">
                                    <a href="rgpi-forgot.php">
                                        <input type="button" class="btn btn-sm btn-primary float-left" value="Start Over">
                                    </a>
                                    
    
                                    
                                </form>
    
                                
    
                            </div>
                        </div>
                        <?php
                        
                    break;

                    case 'enter_password':
                    
                        ?>
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-2x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>Enter your new password</p>
                            <div class="panel-body">
    
                                <form action="rgpi-forgot.php?mode=enter_password" id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                                <span style="font-size: 12px;color:red;">
                                <?php 
                                    foreach ($error as $err) {
                                        // code...
                                        echo $err . "<br>";
                                    }
                                ?>
                                </span>    

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input id="email" minlength="8" name="password" placeholder="Password" class="form-control"
                                                type="password">
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input id="email" minlength="8" name="re-password" placeholder="Repeat Password" class="form-control"
                                                type="password">
                                        </div>
                                    </div>

                                    <input type="submit" class="btn btn-sm btn-primary" value="Next" style="float: right;">
                                    <a href="rgpi-forgot.php">
                                        <input type="button" class="btn btn-sm btn-primary float-left" value="Start Over">
                                    </a>
                                    
    
                                    
                                </form>
    
                                
    
                            </div>
                        </div>
                        <?php
                        
                    break;    
                    
                    default:
                        
				    break;
		}
                  ?>

                </div>
            </div>
        </div>
    </div>
</div>