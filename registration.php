<?php
use CapstoneProject\Member;
if (! empty($_POST["signup-btn"])) {
    require_once './Model/Member.php';
    $member = new Member();
    $registrationResponse = $member->registerMember();
}
?>
<html>

<head>
    <title>Registration Form | Right Goods Philippines Inc.</title>
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
    
      <style>
        .success-message{
            color:green
        }
        .error-message{
            color:red;
        }
    </style>
</head>

<body>
    <div class="container register">
        <!--Start Container-->
        <div class="row">
            <!--Start Row-->
            <div class="col-md-3 register-left">
                <img src="assets/img/icon2.png" alt="" class="img-fluid" style="min-height: 5%; min-width: 50%;">
            
                <p> Right Goods Philippines Inc.</p>
                
            </div>

            <div class="col-md-9 register-right">

                <div class="tab-content" id="myTabContent">
                    <?php if (! empty($registrationResponse["status"])) { ?>
                    <?php if ($registrationResponse["status"] == "error") { ?>
                    <div class="alert alert-danger " role="alert">
                        <div class="server-response error-msg"><?php echo $registrationResponse["message"]; ?>
                        </div>
                    </div>
                    <?php } 
                    else if ($registrationResponse["status"] == "success") 
                    {?>
                    <div class="alert alert-success " role="alert">
                        <div class="server-response success-msg"><?php echo $registrationResponse["message"];?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                        <form action="" method="post" name="sign-up" class="shadow p-3 rounded" method="POST"
                             onsubmit="return signupValidation()">
                            <!--Start Form-->
                            <h3 class="register-heading">Registration Form</h3>


                            <div class="row register-form">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <span class="required error" id="fullname-info"></span>
                                        <input type="text" class="form-control" placeholder="Full Name *"
                                            name="fullname" id="fullname" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="required error" id="company-info"></span>
                                        <input type="text" class="form-control" placeholder="Company Name *"
                                            name="company" id="company" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="required error" id="address-info"></span>
                                        <input type="text" class="form-control" placeholder="Address *" name="address"
                                            id="address" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="required error" id="phone-info"></span>
                                        <input type="tel"   pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" class="form-control" placeholder="Phone Number (0000-000-0000)"
                                            name="phone" id="phone" required>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control form-control-sm" type="file" name="image" accept="image/png, image/gif, image/jpeg" required />
                                            <label for="formFileSm" class="form-label text-muted">Business Permit</label>
                                    </div>
                                    
                                   
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="required error" id="username-info"></span>
                                        <input type="text" class="form-control" placeholder="Username *" name="username"
                                            id="username" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="required error" id="email-info"></span>
                                        <input class="form-control" type="email" placeholder="Email Address *"
                                            name="email" id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="required error" id="password-info"></span>
                                        <input type="password" name="signup-password" minlength="8" placeholder="Password *"
                                            class="form-control" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="required error" id="confirm-password-info"></span>
                                        <input class="form-control" minlength="8" placeholder="Confirm Password *" type="password"
                                            name="confirm-password" id="confirmpassword" required>
                                            <div class="form-text confirm-message"></div>
                                    </div>
                                   
                                    <input class="btn btn-primary" type="submit" name="signup-btn" id="signup-btn"
                                        value="Sign Up">
                        </form>
                        <!--End Form-->


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--End Row-->
    </div>
    <!--End Container-->



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

 <script>
//     $('#password, #confirmpassword').on('keyup', function(){

//         $('.confirm-message').removeClass('success-message').removeClass('error-message');

//         let password=$('#password').val();
//         let confirm_password=$('#confirmpassword').val();

//         if(password===""){
//             $('.confirm-message').text("Password Field cannot be empty").addClass('error-message');
//         }
//         else if(confirm_password===""){
//             $('.confirm-message').text("Confirm Password Field cannot be empty").addClass('error-message');
//         }
//         else if(confirm_password===password)
//         {
//             $('.confirm-message').text('Password Match!').addClass('success-message');
//         }
//         else{
//             $('.confirm-message').text("Password Doesn't Match!").addClass('error-message');
//         }

//     });
// </script>

  <script>
        function signupValidation() {
            var valid = true;

            $("#company").removeClass("error-field");
            $("#fullname").removeClass("error-field");
            $("#address").removeClass("error-field");
            $("#phone").removeClass("error-field");
            $("#username").removeClass("error-field");
            $("#email").removeClass("error-field");
            $("#password").removeClass("error-field");
            $("#confirmpassword").removeClass("error-field");

            var company = $("#company").val();
            var fullname = $("#fullname").val();
            var address = $("#address").val();
            var phone = $("#phone").val();
            var UserName = $("#username").val();
            var email = $("#email").val();
            var Password = $('#password').val();
            var ConfirmPassword = $('#confirmpassword').val();
            var emailRegex =
                /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

            $("#username-info").html("").hide();
            $("#email-info").html("").hide();
            
            

            if (company.trim() == "") {
                $("#company-info").html("required.").css("color", "#ee0000").show();
                $("#company").addClass("error-field");
                valid = false;
            }

            if (fullname.trim() == "") {
                $("#fullname-info").html("required.").css("color", "#ee0000").show();
                $("#fullname").addClass("error-field");
                valid = false;
            }

            if (address.trim() == "") {
                $("#address-info").html("required.").css("color", "#ee0000").show();
                $("#address").addClass("error-field");
                valid = false;
            }

            if (phone.trim() == "") {
                $("#phone-info").html("required.").css("color", "#ee0000").show();
                $("#phone").addClass("error-field");
                valid = false;
            }
            if (UserName.trim() == "") {
                $("#username-info").html("required.").css("color", "#ee0000").show();
                $("#username").addClass("error-field");
                valid = false;
            }
            if (email == "") {
                $("#email-info").html("required").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (email.trim() == "") {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
                $("#email").addClass("error-field");
                valid = false;
            } else if (!emailRegex.test(email)) {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000")
                    .show();
                $("#email").addClass("error-field");
                valid = false;
            }
            if (Password.trim() == "") {
                $("#signup-password-info").html("required.").css("color", "#ee0000").show();
                $("#signup-password").addClass("error-field");
                valid = false;
            }
            if (ConfirmPassword.trim() == "") {
                $("#confirm-password-info").html("required.").css("color", "#ee0000").show();
                $("#confirm-password").addClass("error-field");
                valid = false;
            }
            if (Password != ConfirmPassword) {
                $("#error-msg").html("Both passwords must be same.").show();
                valid = false;
            }
            if (valid == false) {
                $('.error-field').first().focus();
                valid = false;
            }
            
            $('#password, #confirmpassword').on('keyup', function(){

            $('.confirm-message').removeClass('success-message').removeClass('error-message');
    
            let password=$('#password').val();
            let confirm_password=$('#confirmpassword').val();
    
            if(password===""){
                $('.confirm-message').text("Password Field cannot be empty").addClass('error-message');
            }
            else if(confirm_password===""){
                $('.confirm-message').text("Confirm Password Field cannot be empty").addClass('error-message');
            }
            else if(confirm_password===password)
            {
                $('.confirm-message').text('Password Match!').addClass('success-message');
            }
            else{
                $('.confirm-message').text("Password Doesn't Match!").addClass('error-message');
            }

    });
            return valid;
        }
    </script>
    
</body>

</html>