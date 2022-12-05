<?php
    include 'admin/partials/header.php';
    $current_user_id =  $_SESSION['user-id'] ?? null;
    $query = "SELECT id, title, category_id FROM posts WHERE author_id = $current_user_id ORDER BY id DESC";
    $posts =  mysqli_query($connection, $query);
?>
    <section class="dashboard">
        <?php if(isset($_SESSION['add-post-success'])) : ?>       
            <div class="alert__message success">
                <p><?= $_SESSION['add-post-success']; unset($_SESSION['add-post-success'])?></p>
            </div>
        <?php endif?>  
        <?php if(isset($_SESSION['edit-post-success'])) : ?>       
            <div class="alert__message success">
                <p><?= $_SESSION['edit-post-success']; unset($_SESSION['edit-post-success'])?></p>
            </div>
        <?php endif?>
        <?php if(isset($_SESSION['delete-post-msg-success'])) : ?>       
            <div class="alert__message success">
                <p><?= $_SESSION['delete-post-msg-success']; 
                unset($_SESSION['delete-post-msg-success'])?></p>
            </div>
        <?php endif?>

        <div class="container dashboard__container">    
           
           
            <aside>
                <ul>
                    <li>
                        <a href="./add-post.php">Đăng bài viết</a>
                    </li>
                    
                    <li>
                        <a href="./dashboard.php" class="active">Quản lý bài viết</a>
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
                        <a href="./manage-categories.php" >Quản lý thể loại</a>
                    </li>
                    <?php endif ?>
       
                </ul>
            </aside>
            <main>
                <h2>QUẢN LÝ BÀI VIẾT</h2>
                <table>
                     <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Thể loại</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                            <!-- get category title of each post from categories table -->
                            <?php
                                $category_id = $post['category_id'];
                                $category_query = "SELECT title FROM categories WHERE id=$category_id ";
                                $result = $connection->query($category_query);
                                $category_name = mysqli_fetch_assoc($result)['title'];
                            ?>
                        <tr>
                            <td>
                                <?= $post['title'] ?>
                            </td>
                            <td>
                                <?= $category_name?>
                            </td>
                            <td>
                                <a href="<?= ROOT_URL?>/edit-post.php?id=<?= $post['id'] ?>" class="btn sm">Chỉnh sửa</a>
                            </td>
                            <td>
                                <a href="<?= ROOT_URL?>/delete-post.php?id=<?= $post['id'] ?>" class="btn danger sm">Xóa</a>
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