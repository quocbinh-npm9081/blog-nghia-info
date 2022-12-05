<?php
    require 'admin/config/database.php';
    if(isset($_POST['submit'])){
        $userName = filter_var($_POST["userName"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST["password"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(!$userName){
            $_SESSION['signin-msg'] = "Vui lòng nhập tên đăng nhập hoặc email !";
        }else if(!$password){
            $_SESSION['signin-msg'] = "Vui lòng nhập mật khẩu !";
        }else{
            //fetch user from database
            $fetch_user_query = "SELECT * FROM users WHERE username='$userName' OR email='$userName' ";
            $fetch_user_result = $connection->query($fetch_user_query);
            if(mysqli_num_rows($fetch_user_result) == 1){
                $user_record = mysqli_fetch_assoc($fetch_user_result);
                $db_password = $user_record['password'];
                //compare from password with database password
                if(password_verify($password,$db_password)){
                    // set session for acces control
                    $_SESSION['user-id'] = $user_record['id'];
                    //set session if user is admin
                    if($user_record['is_admin']==1 ){
                        $_SESSION['user_is_admin'] = true;
                       header('location: '. ROOT_URL . '/dashboard.php');
                        
                    }
                    //log user in
                   header('location: '. ROOT_URL . '/index.php');

                }else{
                    $_SESSION['signin-msg'] = "Mật khẩu không chính xác !";

                }
                
            }else{
                $_SESSION['signin-msg'] = "Thông tin đăng nhập sai !";
            }
        }
        if(isset($_SESSION['signin-msg'])){
            $_SESSION['signin-data'] = $_POST;
            header('location: '.ROOT_URL. '/signin.php');
            die();
        }
    }else{

       header('location: '.ROOT_URL. '/signin.php');
        die();
    }
?>