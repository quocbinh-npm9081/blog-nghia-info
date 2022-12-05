<?php
    require 'admin/config/constants.php';
    $username = $_SESSION['signin-data']['userName'] ?? null;
    unset($_SESSION['signin-data']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nghia Info - Blog chia sẽ lập trình GenZ</title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>ĐĂNG NHẬP</h2>
            <?php if(isset($_SESSION['signin-msg'])) : ?>
                <div class="alert__message error">
                <p><?= $_SESSION['signin-msg'];
                    unset($_SESSION['signin-msg']);
                ?></p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>/signin-login.php" method="post" class="form">
                <input type="text" name="userName" autocomplete="off" value="<?=  $username ?>" placeholder="Tên đăng nhập hoặc email">
                <input type="password" name="password"  autocomplete="off"  placeholder="Mật khẩu">

                <button type="submit" name="submit" class="btn">Đăng nhập</button>
                <small>Bạn chưa có tài khoản? <a href="./signup.php">Đăng kí</a></small>
            </form>
        </div>

    </section>

</body>

</html>