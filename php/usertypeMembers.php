<?php  

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    
    $sql = "SELECT * FROM usertype ORDER BY role DESC";
    $res = mysqli_query($conn, $sql);
}else{
	header("Location: rgpi-login.php");
} 