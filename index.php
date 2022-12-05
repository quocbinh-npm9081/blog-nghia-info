<?php
include 'admin/partials/header.php';
    $featured_query = "SELECT * FROM posts WHERE is_featured=1 LIMIT 1";
    $result = mysqli_query($connection, $featured_query);
    $post_is_featured = mysqli_fetch_assoc($result);
    $category_id =  $post_is_featured['category_id'];
    $author_id =  $post_is_featured['author_id'];
    $create_at =  $post_is_featured['date_time'];

?>
    <?php if(mysqli_num_rows($result) == 1):?>
  
    <section class="featured">
        <div class="container featured__container">       
            <div class="post__thumbail">
                <img src="./assets/images/posts/<?= $post_is_featured['thumbnail'] ?>" alt="">
            </div>
            <div class="post__info">
                <?php
                    // fetch category
                    $query_category = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $query_category);
                    $category = mysqli_fetch_assoc($category_result);
                    // fetch user
                    $query_user = "SELECT * FROM users WHERE id=$author_id";
                    $user_result = mysqli_query($connection, $query_user);
                    $user = mysqli_fetch_assoc($user_result);
                ?>
                <a href="" class="category__button"><?=  $category["title"]?></a>
                <h2 class="post__title">
                    <a href="post.php">
                        <?=  $post_is_featured['title']?>
                    </a>
                </h2>
                <p class="post_body">
                    <?= substr( $post_is_featured['body'], 0 ,300) . '...'?>
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./assets/images/avatar2.jpg" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?=  $user['username']?></h5>
                        <small><?= $create_at?></small>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php endif ?>
    <section class="posts">
        <div class="container posts__container">
            <?php
                $query_posts = "SELECT * FROM posts";
                $result = mysqli_query($connection,$query_posts);
                $posts = mysqli_fetch_assoc($result);

            ?>
            <?php while($post = mysqli_fetch_assoc($result)) :?>
            <article class="post">
                <div class="post__thumbail">
                    <img src="./assets/images/posts/<?= $post["thumbnail"]?>" alt="">
                </div>
                <div class="post__info">
                <?php
                    // fetch category
                    $category_id=$post['category_id'];
                    $query_category = "SELECT * FROM categories WHERE id=$category_id";
                    $category_result = mysqli_query($connection, $query_category);
                    $category = mysqli_fetch_assoc($category_result);
                    // fetch user
                    $author_id=$post['author_id'];
                    $query_user = "SELECT * FROM users WHERE id=$author_id";
                    $user_result = mysqli_query($connection, $query_user);
                    $user = mysqli_fetch_assoc($user_result);
                ?>
                    <a href="Wild category" class="category_button"><?=  $category['title']?></a>
                    <h3 class="post_title">
                        <a href="post.php?id=<?= $post['id']?>" style="display: block ; white-space: nowrap; width: 220px; overflow: hidden; text-overflow:ellipsis; ">
                            <?= $post["title"]?>
                        </a>
                    </h3>
                    <p class="post__body">
                    <?=  substr($post["body"], 0 ,200)?>...

                    </p>
                    <div class="post_author">
                        <div class="post__author-avatar">
                            <img src="./assets/images/<?= $user['avatar']?>" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>
                                By: <?= $user['username']?>
                            </h5>
                            <small><?=  $post["date_time"]?></small>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile ?>


        </div>

    </section>

</body>

</html>