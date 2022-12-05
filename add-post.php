<?php
    include 'admin/partials/header.php';
    $query = "SELECT * FROM categories";
    $result = $connection->query($query);
    $title =  $_SESSION['add-post-data']['title'] ?? null;
    $body =  $_SESSION['add-post-data']['body']?? null;
    unset($_SESSION['add-post-data']);

?>
    <section class="form__section" style="padding-top: 5rem!important">
        <div class="container form__section-container" >
            <h2>ĐĂNG BÀI VIẾT</h2>
            <?php if(isset($_SESSION['add-post-msg'])) : ?>
            <div class="alert__message error">
                <p><?= $_SESSION['add-post-msg']; unset($_SESSION['add-post-msg'])?></p>
            </div>
            <?php endif ?>
            <form action="<?= ROOT_URL?>/add-post-logic.php" enctype="multipart/form-data" method="post" class="form">
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
                        <input type="checkbox" name="is_featured" value="1" id="is_featured"   style="width: unset!important;">
                        <label for="is_featured">Featured</label>
                    </div>
                <?php endif?>

                <div class="form__control">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" id="thumbnail" name="thumbnail">
                </div>
                <button type="submit" name="submit" class="btn">Thêm</button>
            </form>
        </div>

    </section>

</body>

</html>