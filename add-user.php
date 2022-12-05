<?php
include 'admin/partials/header.php';
$userName = $_SESSION['add-user-data']['userName'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$userRole = $_SESSION['add-user-data']['userRole'] ?? null;
unset($_SESSION['add-user-data']);

?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>THÊM THÀNH VIÊN</h2>
            <?php if(isset($_SESSION['add-user-msg'])) : ?>
            <div class="alert__message error">
                <p><?= $_SESSION['add-user-msg'];
                    unset($_SESSION['add-user-msg']);
                ?></p>
            </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>/add-user-logic.php" method="post" enctype="multipart/form-data" class="form">
                <input type="text" name="userName" value="<?= $userName?>" placeholder="Tên đăng nhập">
                <input type="text" name="email" value="<?= $email?>" placeholder="Email">
                <input type="password" name="password" placeholder="Mật khẩu">
                <input type="password" name="confirmPassword" placeholder="Xác nhận mật khẩu">
                <select name="userRole" id="">
                    <option value="2" >Tác giả</option>
                    <option value="1">Quản trị viên</option>
                </select>
                <div class="form__control">
                    <label for="avatar">Ảnh đại diện</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Tạo</button>
            </form>
        </div>

    </section>

</body>

</html>