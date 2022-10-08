<!DOCTYPE html>
<html>

<head>
    <<title>RGPI Signup | Right Goods Philippines Inc.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
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
            move_uploaded_file($_FILES["kae-image"]['tmp_name'], "assets/img/" . $_FILES['kae-image']['name']);
            echo 'successfully registered';

            header("Location: rgpi-home.php");
            exit();
        }
        else
        {
            echo 'Credentials not added';
        }
    }
?>
    <!-- START FORM -->
    <form action="rgpi-signup.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
            <div class="form-floating mb-3">
                <select class="form-select mb-3" name="role" aria-label="Default select example">
                    <option selected value="user">Key Accounts Executive</option>
                    <option value="admin">Marketing Associates</option>
                </select>
                <label for="floatingInput">Usertype</label>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control form-control-sm" type="file" name="kae-image" id="kae-image" required />
                <label for="formFileSm" class="form-label text-muted mb-3">Upload Image</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="fname" id="floatingInput" class="form-control" required>
                <label for="floatingInput">Fullname</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="email" id="floatingInput" class="form-control" required>
                <label for="floatingInput">Email Address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="username" id="floatingInput" class="form-control" required>
                <label for="floatingInput">Username</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" id="floatingInput" class="form-control" required>
                <label for="floatingInput">Password</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="pwdRepeat" id="floatingInput" class="form-control" required>
                <label for="floatingInput">Repeat Password</label>
            </div>

            <div class="modal-footer mb-3">
                <button type="submit" name="btn-add-usertype" class="btn btn-success btn-rounded mt-3"
                    id="btn">Submit</button>

                <a href="rgpi-home.php">Back</a>
            </div>
        </div>
    </form><!-- END FORM -->
</body>

</html>