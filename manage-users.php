<?php
include 'admin/partials/header.php';
//fetch users from database but not current user
$current_admin_id =($_SESSION['user-id']);
$fetch_user_query = "SELECT * FROM users WHERE NOT id='$current_admin_id'";
$fetch_users_result = $connection->query($fetch_user_query);
?>
    <section class="dashboard">
        <?php if(isset($_SESSION['add-user-msg-sussess'])) : ?>
            <div class="alert__message success container">
                <p><?= $_SESSION['add-user-msg-sussess'];
                    unset($_SESSION['add-user-msg-sussess']);
                ?></p>
            </div>
        <?php elseif(isset($_SESSION['delete-user-msg-success'])) : ?>
            <div class="alert__message success container">
                <p><?= $_SESSION['delete-user-msg-success'];
                    unset($_SESSION['delete-user-msg-success']);
                ?></p>
            </div>
        <?php  elseif(isset($_SESSION['edit-user-msg-success'])) :  ?>
            <div class="alert__message success container">
                <p><?= $_SESSION['edit-user-msg-success'];
                    unset($_SESSION['edit-user-msg-success']);
                ?></p>
            </div>        
        <?php endif ?>
       
            <div class="container dashboard__container">
            <aside>
                <ul>
                    <li>
                        <a href="./add-post.php">Đăng bài viết</a>
                    </li>
                    <li>
                        <a href="./dashboard.php">Quản lý bài viết</a>
                    </li>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <li>
                        <a href="./add-user.php">Thêm thành viên</a>
                    </li>
                    <li>
                        <a href="./manage-users.php" class="active">Quản lý thành viên</a>
                    </li>
                    <li>
                        <a href="./add-category.php">Thêm thể loại</a>
                    </li>
                    <li>
                        <a href="./manage-categories.php">Quản lý thể loại</a>
                    </li>
                    <?php endif ?>

                </ul>
            </aside>
            <main>
                <h2>QUẢN LÝ THÀNH VIÊN</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Quản trị viên</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = mysqli_fetch_assoc($fetch_users_result)) :?>
                        <tr>
                            <td>
                                <?= $user['username'] ?>
                            </td>
                            <td>
                            <?= $user['is_admin'] == 1 ? 'Đúng': '--'?>
                            </td>
                            <td>
                                <a href="<?=ROOT_URL?>/edit-user.php?id=<?= $user['id']?>" class="btn sm">Chỉnh sửa</a>
                            </td>
                            <td>
                                <a href="<?=ROOT_URL?>/delete-user.php?id=<?= $user['id']?>" class="btn danger sm">Xóa</a>
                            </td>

                        </tr>
                        <?php endwhile ?>
                  
                    </tbody>
                </table>
            </main>
        </div>

    </section>

</body>

</html>