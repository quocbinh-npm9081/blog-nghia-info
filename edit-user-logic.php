<?php
    require 'admin/config/database.php';

    if(isset($_POST['submit'])){
        //get form data
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $userName = filter_var($_POST['userName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $is_admin = filter_var($_POST['userRole'], FILTER_SANITIZE_NUMBER_INT);
        //check for valid input
        if(!$userName){
            $_SESSION['edit-user-msg'] = "Vui lòng nhập tên đầy đủ !";
        }else{
            $query = "UPDATE users SET username='$userName', is_admin=$is_admin WHERE id=$id LIMIT 1";
            echo $query;
            $result = $connection->query($query);
            if(mysqli_errno($connection)){
                $_SESSION['edit-user-msg'] = "Lỗi server !";
            }else{
                $_SESSION['edit-user-msg-success'] = "Cập nhập thàng công !";
            }
        }  
    }
    header('location: '.ROOT_URL. '/manage-users.php');
    die(); 
?>