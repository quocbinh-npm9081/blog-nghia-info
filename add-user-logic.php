<?php
    require 'admin/config/database.php';
    if(isset($_POST['submit'])){
       
        $userName = filter_var($_POST['userName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
        $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
        $confirmPassword = filter_var($_POST['confirmPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       
        $is_admin = filter_var($_POST['userRole'], FILTER_SANITIZE_NUMBER_INT);

        $avatar = $_FILES['avatar'];
      
        // echo $userName, $email,$password,$confirmPassword;
        if(!$userName){
       
            $_SESSION['add-user-msg'] = "Vui lòng nhập tên của bạn";            
      
        }else if(!$email){
        
            $_SESSION['add-user-msg'] = "Vui lòng nhập email của bạn";            
       
        }else if(!$is_admin){
        
            $_SESSION['add-user-msg'] = "Vui lòng chọn phân quyền";            
       
        }else if(!$password){
        
            $_SESSION['add-user-msg'] = "Vui lòng nhập mật khẩu của bạn";            
     
        }else if(strlen($password) < 8 || strlen($confirmPassword) < 8){
           
            $_SESSION['add-user-msg'] = "Vui lòng nhập mật khẩu nhiều hơn 8 kí tự";            
      
        }else if(!$avatar['name']){
      
            $_SESSION['add-user-msg'] = "Vui lòng chọn ảnh đại diện";            
      
        }else{
            if($password!=$confirmPassword){
            
                $_SESSION['add-user-msg'] = "Mật khẩu không giống nhau";            
         
            }else{

                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                $user_check_query = "SELECT * FROM users WHERE username='$userName' OR email='$email' ";
                $user_check_result = $connection->query($user_check_query);
         
                $row_count = mysqli_num_rows($user_check_result);
                if( $row_count > 0){
             
                    $_SESSION['add-user-msg'] = "Taì khoản đã tồn tại !";
              
                }else{
                    //rename avata
                  
                    $time = time();
                   
                    $avatar_name = $time . $avatar['name'];
                    $avatar_tmp_name = $_FILES['avatar']['tmp_name'];

                    $avatar_destination_path = 'assets/images/' . $avatar_name;

                    // make sure file is an image
                   
                    $allowed_files = ['png', 'jpg', 'jpeg'];
                    
                    $extention = explode('.', $avatar_name);
                  
                    $extention = end($extention);
                    if(in_array($extention, $allowed_files )){
                        //make sure image is not long too large 
                    
                        if($avatar['size'] < 7000000){
                            move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                        }else{
                      
                            $_SESSION['add-user-msg'] = 'Kính thước hình ảnh quá lớn.';
                      
                        }
                  
                    }else{
                      
                        $_SESSION['add-user-msg'] = 'Định dạng ảnh không hợp lệ';
                    
                    }
                }
            }
        }
           
          
           
            

        if(isset($_SESSION['add-user-msg'])){
           
            $_SESSION['add-user-data'] = $_POST;
            
            header('location: '.ROOT_URL.'/add-user.php');
           
            die();

        }else{
            //insert new user into users table

            $insert_user_query= "INSERT INTO `users` (`username`, `email`, `password`, `avatar`, `is_admin`) VALUES ('".$userName."', '".$email."', '".$hash_password."', '".$avatar_name."',$is_admin)";
            $insert_query_result = $connection->query($insert_user_query);

            if(!mysqli_error($connection)){
           
                $_SESSION['add-user-msg-sussess'] = 'Đăng kí thành công';
           
                header('location: '.ROOT_URL.'/manage-users.php');
          
                die();
            }
        }
    }else{
       
        header('location: ' . ROOT_URL . '/add-user.php');
       
        die();
    }
  
?>