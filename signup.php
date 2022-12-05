<?php 
    require 'admin/config/constants.php';
    //get back form data if there was
    $userName = $_SESSION['signup-data']['userName'] ?? null;
    $email = $_SESSION['signup-data']['email'] ?? null;
    $password = $_SESSION['signup-data']['password'] ?? null;
    $confirmPassword = $_SESSION['signup-data']['confirmPassword'] ?? null;
    unset($_SESSION['signup-data']);
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
            <h2>ĐĂNG KÍ</h2>
            <?php if(isset($_SESSION['signup-msg'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['signup-msg'];
                        unset($_SESSION['signup-msg']);
                    ?>
                </p>
            </div>
            <?php endif ?>
          
            <form action="<?= ROOT_URL ?>/signup-login.php" method="post" enctype="multipart/form-data" class="form">
                <input type="text" placeholder="Tên của bạn" value="<?= $userName ?>" name="userName">
                <input type="text" placeholder="Email" value="<?= $email ?>" name="email">
                <input type="password" placeholder="Mật khẩu" value="<?= $password?>" name="password">
                <input type="password" placeholder="Xác nhận mật khẩu" value="<?= $confirmPassword?>" name="confirmPassword">
                <div class="form__control">
                    <label for="avatar">Ảnh đại diện</label>
                    <input type="file" id="avatar" name="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Đăng kí</button>
                <small>Bạn đã có tài khoản? <a href="./signin.php">Đăng nhập</a></small>
            </form>
        </div>

    </section>

</body>

</html>