<?php
    require 'admin/config/database.php';
    if(isset( $_GET['id'])){
        $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM users WHERE id=$id";
        $result = $connection->query($query);
        $user = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) ==1){
            var_dump($user);
            $avatar_name = $user['avatar'];
            $avatar_path = './assets/images' .$avatar_name;
           // delete image if available
           if($avatar_path){
                unlink($avatar_path);
           }
        }

        //FOR LATER
        //fetch all thumbnails of user's posts and delete them

        //delete user form database
        $delete_user_query = "DELETE FROM users WHERE id=$id";
        $delete_user_result = $connection->query($delete_user_query);
        if(mysqli_errno($connection)){
            $_SESSION['delete-user-msg'] = "Không thể xóa người dừng này !";
        }else{
            $_SESSION['delete-user-msg-success'] = "Xóa người đung thành công !";

        }
    }
    header('location: ' . ROOT_URL . '/manage-users.php');
    die();


?>