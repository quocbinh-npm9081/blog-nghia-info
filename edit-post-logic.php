<?php
    require 'admin/config/database.php';
    if(isset($_POST['submit'])){
        $author_id = $_SESSION['user-id'];
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
        $previous_thumbnail_name =  filter_var($_POST['previous_thumbnail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $thumbnail = $_FILES['thumbnail'];
        $is_featured= $is_featured == 1 ?: 0;
        //validate form data
        if(!$title){
            $_SESSION['edit-post-msg'] = "Vui lòng nhập tiêu đề !";
        }else if(!$category_id){
            $_SESSION['edit-post-msg'] = "Vui chọn thể loại !";
        }else if(!$body){
            $_SESSION['edit-post-msg'] = "Nội dung không được bỏ trống !";
        }else{      
            if($thumbnail['name']){
                $previous_thumbnail_path = "assets/images/posts/" .  $previous_thumbnail_name;
                if($previous_thumbnail_path){
                    unlink($previous_thumbnail_path);
                }
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
                        $_SESSION['edit-post-msg'] = "Kích thước ảnh quá lớn !";
                    }
                }else{
                    $_SESSION['edit-post-msg'] = "Định dạng ảnh không hợp lệ !";
                }
            }
            

        }

            //redirect
        if(isset($_SESSION['edit-post-msg'])){
            $_SESSION['edit-post-data'] = $_POST;
            header('location: '.ROOT_URL.'/edit-post.php?id=' . '/' .  $id);
            die();
        }else{
            if($is_featured == 1){
                $zero_all_is_featured_query = "UPDATE  posts SET is_featured=0";
                $zero_all_is_featured_result = mysqli_query($connection,$zero_all_is_featured_query);
            }
            $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
            $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);

            if(!mysqli_errno($connection)){
                $_SESSION['edit-post-success'] = "Cập nhập bài viết thành công !";
                     header('location: ' . ROOT_URL . '/dashboard.php' );                   
            }else{
               header('location: ' . ROOT_URL . '/edit-post.php?id=' . '/' .  $id );
            }          
        }
    }else{        
        header('location: ' . ROOT_URL . '/edit-post.php?id='  . '/' .  $id);
        die();
    }
  
?>