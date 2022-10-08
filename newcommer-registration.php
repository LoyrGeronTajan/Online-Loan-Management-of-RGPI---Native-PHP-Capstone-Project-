<?php session_start(); ?>
<html>

<head>
    <title>Registration Form | Right Goods Philippines Inc.</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/registration.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

</head>

<body>
    <div class="container register">
        <!--Start Container-->
        <div class="row">
            <!--Start Row-->
            <div class="col-md-3 register-left">
                <img src="assets/img/icon2.png" alt="" class="img-fluid" style="min-height: 5%; min-width: 50%;">

                <p> Right Goods Philippines Inc.</p>
                <a href="index.php"><input type="button" name="" value="Login" /><br /></a>
            </div>

            <div class="col-md-9 register-right">

                <div class="tab-content" id="myTabContent">


                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <!-- START FORM -->
                        <form action="newcommer-registration.php" method="POST" enctype="multipart/form-data">
                            <h3 class="register-heading">Newcomer's Registration Form</h3>


                            <div class="row register-form">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <span class="required error" id="company-info"></span>
                                        <input type="text" class="form-control" placeholder="Company Name *"
                                            name="newcommer-company" id="newcommer-company" required>
                                    </div>


                                    <div class="form-group">
                                        <span class="required error" id="address-info"></span>
                                        <input type="text" class="form-control" placeholder="Address *"
                                            name="newcommer-address" id="newcommer-address" required>
                                    </div>

                                    <div class="form-group">
                                        <span class="required error" id="company-info"></span>
                                        <input type="tel"   pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" class="form-control" placeholder="Phone Number (0000-000-0000)" 
                                            name="newcommer-contact" id="newcommer-company" required>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <span class="required error" id="email-info"></span>
                                        <input class="form-control" type="email" placeholder="Email Address *"
                                            name="newcommer-email" id="newcommer-email" required>
                                    </div>

                                    <div class="form-group">
                                        <span class="required error" id="permit-info"></span>

                                        <input class="form-control form-control-sm" type="file" name="product_image"
                                            id="product_image" accept="image/png, image/gif, image/jpeg" required />
                                        <label for="formFileSm" class="form-label text-muted">Business Permit</label>

                                        <br>

                                        <button class="btn btn-sm btn-primary mt-5" type="submit"
                                            name="newcommer-signup-btn" id="newcommer-signup-btn">
                                            SUBMIT
                                        </button>
                                    </div>

                                </div>
                        </form>
                        <!-- END FORM -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--End Row-->
    </div>
    <!--End Container-->


    <!-- Font Awesome scripts -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script>
        function signupValidation() {
            var valid = true;

            $("#newcommer-company").removeClass("error-field");
            $("#newcommer-tin").removeClass("error-field");
            $("#newcommer-bir").removeClass("error-field");
            $("#newcommer-address").removeClass("error-field");
            $("#newcommer-username").removeClass("error-field");
            $("#newcommer-email").removeClass("error-field");
            $("#newcommer-signup-password").removeClass("error-field");
            $("#newcommer-confirm-password").removeClass("error-field");

            var company = $("#newcommer-company").val();
            var tin = $("#newcommer-tin").val();
            var bir = $("#newcommer-bir").val();
            var address = $("#newcommer-address").val();
            var UserName = $("#newcommer-username").val();
            var email = $("#newcommer-email").val();
            var Password = $('#newcommer-signup-password').val();
            var ConfirmPassword = $('#newcommer-confirm-password').val();
            var emailRegex =
                /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

            $("#username-info").html("").hide();
            $("#email-info").html("").hide();

            if (company.trim() == "") {
                $("#company-info").html("required.").css("color", "#ee0000").show();
                $("#newcommer-company").addClass("error-field");
                valid = false;
            }

            if (tin.trim() == "") {
                $("tin-info").html("required.").css("color", "#ee0000").show();
                $("newcommer-tin").addClass("error-field");
                valid = false;
            }

            if (address.trim() == "") {
                $("#address-info").html("required.").css("color", "#ee0000").show();
                $("#newcommer-address").addClass("error-field");
                valid = false;
            }

            if (bir.trim() == "") {
                $("bir-info").html("required.").css("color", "#ee0000").show();
                $("newcommer-bir").addClass("error-field");
                valid = false;
            }
            if (UserName.trim() == "") {
                $("#username-info").html("required.").css("color", "#ee0000").show();
                $("#newcommer-username").addClass("error-field");
                valid = false;
            }
            if (email == "") {
                $("#email-info").html("required").css("color", "#ee0000").show();
                $("#newcommer-email").addClass("error-field");
                valid = false;
            } else if (email.trim() == "") {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
                $("#newcommer-email").addClass("error-field");
                valid = false;
            } else if (!emailRegex.test(email)) {
                $("#email-info").html("Invalid email address.").css("color", "#ee0000")
                    .show();
                $("#newcommer-email").addClass("error-field");
                valid = false;
            }
            if (Password.trim() == "") {
                $("#password-info").html("required.").css("color", "#ee0000").show();
                $("#newcommer-signup-password").addClass("error-field");
                valid = false;
            }
            if (ConfirmPassword.trim() == "") {
                $("#confirm-password-info").html("required.").css("color", "#ee0000").show();
                $("#newcommer-confirm-password").addClass("error-field");
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
            return valid;
        }
    </script>
</body>

</html>

<?php
    /* ADD BUTTON */
if(isset($_POST['newcommer-signup-btn']))
{
    include "lib/config.php";
    $businessPermit = $_FILES["product_image"]['name'];
    $newcommerCompany = $conn -> real_escape_string($_POST['newcommer-company']);
    $newcommerContact = $_POST['newcommer-contact'];
    $newcommerAddress = $conn -> real_escape_string($_POST['newcommer-address']);
    $newcommerEmail = $_POST['newcommer-email'];

 

        

        $conn = new mysqli('localhost','root','','rgpi');
        $query = "INSERT INTO tbl_newcommer (`newcommer_email`,`newcommer_contact`,`newcommer_company`,`newcommer_businessPermit`,`newcommer_address`) VALUES ('$newcommerEmail','$newcommerContact','$newcommerCompany','$businessPermit','$newcommerAddress')";
        $query_run = mysqli_query($conn,$query);
            
        if ($query_run) 
            {
                move_uploaded_file($_FILES["product_image"]['tmp_name'], "assets/img/newcommer-permit/" . $_FILES["product_image"]['name']);

                echo '
                <script>
                swal({
                    title: "Success!",
                    icon: "success",
                    text: "You have been redirected to access the RGPI.",
                    timer: 10000,
                    
                    
                }).then(function() {
                    window.location = "registration.php";
                });

    
                </script>
                ';
                exit();
            }

    
}
?>