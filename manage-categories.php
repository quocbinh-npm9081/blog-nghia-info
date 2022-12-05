<?php
    include 'admin/partials/header.php';
    $query = "SELECT * FROM categories";
    $fetch_category_result = $connection->query($query);
?>
    <section class="dashboard">
        <div class="container dashboard__container">
            <?php if(isset($_SESSION['add-category-success'])) : ?>
                <div class="alert__message success container">
                <p><?= $_SESSION['add-category-success'];
                    unset($_SESSION['add-category-success']);
                ?></p>
            </div>
            <?php endif ?>
            <aside>
                <ul>
                    <li>
                        <a href="./add-post.php">Đăng bài viết</a>
                    </li>
                    <li>
                        <a href="./dashboard.php">Quản lý bài viết </a>
                    </li>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>                   
                    <li>
                        <a href="./add-user.php">Thêm thành viên</a>
                    </li>
                    <li>
                        <a href="./manage-users.php">Quản lý thành viên</a>
                    </li>
                    <li>
                        <a href="./add-category.php">Thêm thể loại</a>
                    </li>
                    <li>
                        <a href="./manage-categories.php" class="active">Quản lý thể loại</a>
                    </li>
                    <?php endif ?>

                </ul>
            </aside>
            <main>
                <h2>QUẢN LÝ THỂ LOẠI</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($category =  mysqli_fetch_assoc($fetch_category_result)) : ?>
                        <tr>
                            <td>
                                <?= $category['title']?>
                            </td>
                            <td>
                                <a href="./edit-category.php?id=<?= $category['id']?>" class="btn sm">Chỉnh sửa</a>
                            </td>
                            <td>
                                <a href="./delete-category.php?id=<?= $category['id']?>" class="btn danger sm">Xóa</a>
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