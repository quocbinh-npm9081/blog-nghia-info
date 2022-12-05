<?php
    include 'admin/partials/header.php';
    if(isset($_GET['id'])){
        $param_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);        
        $query = "SELECT * FROM users WHERE id='$param_id'";
        $fetch_user_result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($fetch_user_result);
    }else{
        header('location: '.ROOT_URL.'/manage-users.php');
        die();
    }


?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>CHỈNH SỬA THÀNH VIÊN</h2>
            <!-- <?php if(isset($_SESSION['edit-user-msg'])) : ?>
                <div class="alert__message error">
                    <p><?= $_SESSION['edit-user-msg'];
                        unset($_SESSION['edit-user-msg']);
                    ?></p>
                </div>
            <?php endif ?> -->
            <form action="<?=ROOT_URL?>/edit-user-logic.php" method="post" class="form">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <input type="text" name="userName" value="<?= $user['username'] ?>" placeholder="Tên của bạn">
                    <select name="userRole">
                        <option value="2">Tác giả</option>
                        <option value="1">Quản trị viên</option>
                    </select>
                <button type="submit" name="submit" class="btn">Cập nhập</button>
            </form>
        </div>
    </section>
</body>

</html>