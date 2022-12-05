<?php
    require 'admin/config/database.php';

    if(isset($_POST['submit'])){
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$title){
            $_SESSION['add-category-msg'] = "Tiêu đề không được bỏ trống !"; 
        }
        if(!$description){
            $_SESSION['add-category-msg'] = "Mô tả không được bỏ trống !"; 
        }
      
    }
    if(isset($_SESSION['add-category-msg'])){
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . '/add-category.php');
        die();
    }else{
        //insert category into database
        $query = "INSERT INTO `categories` (`title`, `description`) VALUES ('". $title ."', '" . $description . "') ";

        $result = mysqli_query($connection,$query);
        if(mysqli_errno($connection)){
           $_SESSION['add-category-msg'] = "Lỗi server !"; 
           header('location: ' . ROOT_URL . '/add-category.php');
           die();
        }else{
            $_SESSION['add-category-success'] = "Thêm thể loại thành công !"; 
            header('location: ' . ROOT_URL . '/manage-categories.php');
            die();
        }
    }
?>