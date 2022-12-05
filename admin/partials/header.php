<?php
    require 'admin/config/database.php';
    if(isset($_SESSION['user-id'])){
        $id =filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
        $fetch_user_query = "SELECT avatar FROM users WHERE id='$id'";
        $fetch_user_result = $connection->query($fetch_user_query);
        $avatar = mysqli_fetch_assoc($fetch_user_result)['avatar'];
    }else{
        header('location: '.ROOT_URL. '/signin.php');
        die();
    }
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
    <nav>
        <div class="container nav__container">
            <a href="./index.php" class="nav__logo">Nghia info</a>
            <ul class="nav_items">
                <li><a href="index.php">Blog</a></li>
              
                <?php if(isset($_SESSION['user-id'])) : ?>

                <li class="nav_profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . '/assets/images/' . $avatar  ?>" alt="my avatar">
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>/dashboard.php">dashboard</a></li>
                        <li>
                            <a href="<?= ROOT_URL ?>/logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
                <?php else : ?>
                    <li><a href="<?= ROOT_URL ?>/signin.php">Đăng nhập</a></li>
                    <li><a href="<?= ROOT_URL ?>/signup.php">Đăng kí</a></li>
                <?php endif  ?>
            </ul>
            <div class="hamburger hamburger-open">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">&lt;!--!  Atomicons Free 1.00 by @atisalab License - https://atomicons.com/license/ (Icons: CC BY 4.0) Copyright 2021 Atomicons --&gt;<line x1="20" y1="14" x2="4" y2="14"></line><line x1="20" y1="6" x2="4" y2="6"></line><line x1="20" y1="10" x2="4" y2="10"></line><line x1="20" y1="18" x2="4" y2="18"></line></svg>
            </div>

            <div class="hamburger hamburger-close">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="#000000" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">&lt;!--!  Atomicons Free 1.00 by @atisalab License - https://atomicons.com/license/ (Icons: CC BY 4.0) Copyright 2021 Atomicons --&gt;<circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="15" y1="15" x2="9" y2="9"></line></svg>
            </div>
        </div>

    </nav>
