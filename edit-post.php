<?php
include 'admin/partials/header.php';
if(isset($_GET['id'])){
    $post_id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query_post = "SELECT * FROM posts WHERE id = $post_id";
    $result_post=mysqli_query($connection, $query_post);
    $post = mysqli_fetch_assoc($result_post);
    $title =  $post['title'] ;
    $body =  $post['body'];
    $category_id =  $post['category_id'];
    $query_categories = "SELECT * FROM categories";
    $result = $connection->query($query_categories);
}
?>
    <section class="form__section" style="padding-top: 5rem">
        <div class="container form__section-container">
            <h2>ĐĂNG BÀI VIẾT</h2>
            <?php if(isset($_SESSION['edit-post-msg'])) : ?>
            <div class="alert__message error">
                <p><?= $_SESSION['edit-post-msg']; unset($_SESSION['edit-post-msg']);?></p>
            </div>
            <?php endif ?>
            
            <form action="<?= ROOT_URL?>/edit-post-logic.php" method="post" enctype="multipart/form-data" class="form">
                <input type="hidden" name="id" value="<?= $post_id  ?>" >
                <input type="hidden" name="previous_thumbnail" value="<?= $post['thumbnail'] ?>">
                <input type="text" name="title" value="<?= $title ?>" placeholder="Tiêu đề">
                <select name="category" id="input" class="form-control" required="required">
                    <?php while($category = mysqli_fetch_assoc($result)) :?>
                        <option value="<?= $category['id']?>"><?= $category['title']?></option>                    
                    <?php endwhile?>
                </select>
                <textarea name="body" id=""  cols="30" rows="15" placeholder="Nội dung">
                    <?= $body ?>
                </textarea>   
                <?php if(isset($_SESSION['user_is_admin'])) :?>
             
                <div class="form__control inline">
                    <input type="checkbox" name="is_featured" id="is_featured" checked style="width: unset!important;">
                    <label for="is_featured">Featured</label>
                </div>
                <?php endif?>

                <div class="form__control">
                    <label for="thumbnail">Thay đổi ảnh</label>
                    <input type="file" id="thumbnail" name="thumbnail">
                </div>
                <button type="submit" name="submit" class="btn">Cập nhập</button>
            </form>
        </div>

    </section>

</body>

</html>