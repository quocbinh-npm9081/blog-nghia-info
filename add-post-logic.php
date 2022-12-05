<?php
    require 'admin/config/database.php';
    if(isset($_POST['submit'])){
        $author_id = $_SESSION['user-id'];
        $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
        $thumbnail = $_FILES['thumbnail'];
        var_dump($thumbnail);
        $is_featured= $is_featured == 1 ?: 0;
        //validate form data
        if(!$title){
            $_SESSION['add-post-msg'] = "Vui lòng nhập tiêu đề !";
        }else if(!$category_id){
            $_SESSION['add-post-msg'] = "Vui chọn thể loại !";
        }else if(!$body){
            $_SESSION['add-post-msg'] = "Nội dung không được bỏ trống !";
        }else if(!$thumbnail['name']){
            $_SESSION['add-post-msg'] = "Vui lòng chọn ảnh bài viết !";
        }else{    
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extention = explode('.', $thumbnail['name']);
            $extention = end($extention);
            if (in_array($extention , $allowed_files)) {
                $time = time();
                $thumbnail_name = $time . $thumbnail['name']; 
                $thumbnail_tmp_name = $thumbnail['tmp_name'];
                $thumbnail_size = $thumbnail['size'];
                $thumbnail_destination_path = 'assets/images/posts/' . $thumbnail_name;
                if($thumbnail_size <= 7000000){
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);

                }else{
                    $_SESSION['add-post-msg'] = "Kích thước ảnh quá lớn !";
                }
            }else{
                $_SESSION['add-post-msg'] = "Định dạng ảnh không hợp lệ !";
            }

        }
            //redirect
        if(isset($_SESSION['add-post-msg'])){
            $_SESSION['add-post-data'] = $_POST;
            header('location: ' . ROOT_URL . '/add-post.php');
            die();
        }else{
            if($is_featured == 1){
                $zero_all_is_featured_query = "UPDATE  posts SET is_featured=0";
                $zero_all_is_featured_result = mysqli_query($connection,$zero_all_is_featured_query);
            }
            $query = "INSERT INTO `posts` (`title`, `body`, `thumbnail`, `category_id`, `author_id`, `is_featured`)  VALUES ('" . $title . "', '".$body."', '".$thumbnail_name."', '".$category_id."', '".$author_id."', '".$is_featured."')";
            $result = mysqli_query($connection, $query);

            if(!mysqli_errno($connection)){
                $_SESSION['add-post-success'] = "Tạo bài viết thành công !";
                    header('location: ' . ROOT_URL . '/dashboard.php' );
                    die();
            }else{
                header('location: ' . ROOT_URL . '/add-post.php' );
                die();
            }          
        }
    }else{        
        header('location: ' . ROOT_URL . '/add-post.php' );
        die();
    }
  
?>