<?php
    require 'admin/config/database.php';
    if(isset( $_GET['id'])){
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM posts WHERE id=$id";
        $result = $connection->query($query);
        $post = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) ==1){
            $post_thumbnail_name = $post['thumbnail'];
            $post_thumbnail_name_path = './assets/images/posts' .$post_thumbnail_name;
           // delete image if available
           if($post_thumbnail_name_path){
                unlink($post_thumbnail_name_path);
           }
        }

        //FOR LATER
        //fetch all thumbnails of user's posts and delete them

        //delete user form database
        $delete_post_query = "DELETE FROM posts WHERE id=$id";
        $delete_post_result = $connection->query($delete_post_query);
        if(mysqli_errno($connection)){
            $_SESSION['delete-post-msg'] = "Không thể xóa bài viết này !";
        }else{
            $_SESSION['delete-post-msg-success'] = "Xóa bài viết thành công !";

        }
    }
    header('location: ' . ROOT_URL . '/dashboard.php');
    die();



?> 