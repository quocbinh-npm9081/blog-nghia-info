<?php
include 'admin/partials/header.php';
unset($_SESSION['add-category-data']);
?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>THÊM THỂ LOẠI</h2>
      
            <?php if(isset($_SESSION['add-category-msg'])) : ?>
            <div class="alert__message error">
                <p><?= $_SESSION['add-category-msg'];
                    unset($_SESSION['add-category-msg']);
                ?></p>
            </div>
            <?php endif ?>
            <form action="<?=ROOT_URL?>/add-category-logic.php" method="post" class="form">
                <input type="text" name="title" placeholder="Tiêu đề">
                <textarea name="description" id="" cols="30" rows="10" placeholder="Mô tả"></textarea>

                <button type="submit" name="submit" class="btn">Thêm</button>
            </form>
        </div>

    </section>

</body>

</html>