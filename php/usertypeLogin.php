<?php  
session_start();
include "../lib/config.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$role = test_input($_POST['role']);

	if (empty($username)) {
		header("Location: ../rgpi-login.php?error=User Name is Required");
	}else if (empty($password)) {
		header("Location: ../rgpi-login.php?error=Password is Required");
	}else {

		// Hashing the password
		$password = md5($password);

		if (password_verify($password, $pwdHashed)) {
		}
		else
		{   
			/**** LIMIT LOGIN ATTEMPTS *****/
			$_SESSION["adminlogin_attempts"] += 1;
		}


        
        $sql = "SELECT * FROM usertype WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
        	// the user name must be unique
        	$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password && $row['role'] == $role) {
        		$_SESSION['rgpi-name'] = $row['name'];
        		$_SESSION['rgpi-id'] = $row['id'];
        		$_SESSION['rgpi-role'] = $row['role'];
        		$_SESSION['rgpi-username'] = $row['username'];

        		header("Location: ../rgpi-home.php");

        	}else {
				$_SESSION["adminlogin_attempts"] += 1;
        		header("Location: ../rgpi-login.php?error=Incorrect Username or password");
        	}
        }else {
        	header("Location: ../rgpi-login.php?error=Incorrect Username or password");
        }

	}
	
}else {
	header("Location: ../index.php");
}