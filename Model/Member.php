<?php
namespace CapstoneProject;

use mysqli;

class Member
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->ds = new DataSource();
    }

    /**
     * to check if the username already exists
     *
     * @param string $username
     * @return boolean
     */
    public function isUsernameExists($username)
    {
        $query = 'SELECT * FROM tbl_member where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * to check if the email already exists
     *
     * @param string $email
     * @return boolean
     */
    public function isEmailExists($email)
    {
        $query = 'SELECT * FROM tbl_member where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * to signup / register a user
     *
     * @return string[] registration status message
     */
    public function registerMember()
    {
     
        $isUsernameExists = $this->isUsernameExists($_POST["username"]);
        $isEmailExists = $this->isEmailExists($_POST["email"]);
        
        $password = $_POST["signup-password"];
        $confirmpassword = $_POST["confirm-password"];
        
        if ( $confirmpassword!==$password) {
            $response = array(
                "status" => "error",
                "message" => "Password Doesn't Match."
            );
        }
        
        if ($isUsernameExists) {
            $response = array(
                "status" => "error",
                "message" => "Username already exists."
            );
            header("Refresh:2; url=registration.php");
        } else if ($isEmailExists) {
            $response = array(
                "status" => "error",
                "message" => "Email already exists."
            );
            header("Refresh:2; url=registration.php");
        } 
        
       
         else {
             
        
       
            if (! empty($_POST["signup-password"])) {

                // PHP's password_hash is the best choice to use to store passwords
                // do not attempt to do your own encryption, it is not safe
                $hashedPassword = password_hash($_POST["signup-password"], PASSWORD_DEFAULT);
                
                
            }

            // if (! empty($_FILES["product_image"]["name"])) {

               
            //      move_uploaded_file($_FILES["product_image"]['tmp_name'], "assets/img/newcommer-permit/" . $_FILES["product_image"]['name']);
            
                
            // }

            //move_uploaded_file($_FILES["product_image"]['tmp_name'], "assets/img/newcommer-permit/" . $_FILES["product_image"]['name']);

            include 'lib/config.php';
            $query = 'INSERT INTO tbl_member (username, password, email, fullname, company, address, phone, permit) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
            $paramType = 'ssssssss';
            $paramValue = array(
                $_POST["username"],
                $hashedPassword,
                $_POST["email"],
                $_POST["fullname"],
                $_POST["company"],
                $_POST["address"],
                $_POST["phone"],
                $_POST["image"]
            );

        

            
             $memberId = $this->ds->insert($query, $paramType, $paramValue);

            //  if($query_run)
            //  {
            //      move_uploaded_file($_FILES["image"]['tmp_name'], "assets/img/newcommer-permit/" . $_FILES["image"]['name']);
            //  }

             

               
                 //move_uploaded_file($_FILES["image"]['tmp_name'], "assets/img/newcommer-permit/" . $_FILES["image"]['name']);
            
                
            
             
            
            if (! empty($memberId)) {

                
                
                
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                   
                );

                 header("Refresh:1; url=login.php");
            }
           
            
        }
        
        return $response;
    }

    public function getMember($username)
    {
        $query = 'SELECT * FROM tbl_member where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    /**
     * to login a user
     *
     * @return string
     */
    public function loginMember()
    {
        $memberRecord = $this->getMember($_POST["username"]);
        $loginPassword = 0;
        if (! empty($memberRecord)) {
            if (! empty($_POST["login-password"])) {
                $password = $_POST["login-password"];
            }
            $hashedPassword = $memberRecord[0]["password"];
            $loginPassword = 0;
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
            else
            {   
                /**** LIMIT LOGIN ATTEMPTS *****/
                $_SESSION["login_attempts"] += 1;
            }
        } else {
            /**** LIMIT LOGIN ATTEMPTS *****/
            $_SESSION["login_attempts"] += 1;
            
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            // login sucess so store the member's username in
            // the session
            session_start();
            $_SESSION["username"] = $memberRecord[0]["username"];
            $_SESSION['id'] = $memberRecord[0]["id"];
            session_write_close();
            $url = "./customer-home.php";
            header("Location: $url");
        } else if ($loginPassword == 0) {
            
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }

}

