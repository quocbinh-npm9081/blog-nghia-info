<?php
include 'admin/partials/header.php';
if(isset($_GET['id'])){
    //fetch post
    $post_id= filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query_post = "SELECT * FROM posts WHERE id=$post_id";
    $result_post = mysqli_query($connection, $query_post);
    $post = mysqli_fetch_assoc($result_post);
    $author_id = $post['author_id'];

    //fetch user
    $query_user = "SELECT * FROM users WHERE id=$author_id";
    $result_user = mysqli_query($connection, $query_user);
    $user = mysqli_fetch_assoc($result_user);

}
?>

    <section class="singlepost">
        <div class="container singlepost__container">
            <h2><?= $post['title']?></h2>
            <div class="post__author">
                <div class="post__author-avatar">
                    <img src="assets/images/<?= $user['avatar']?>" alt="avata">
                </div>
                <div class="post__author-info">
                    <h5>By: <?= $user['username']?></h5>
                    <small style="color: gray;"><?= $post['date_time']?></small>
                </div>
            </div>
            <div class="singlepost__thumbnail">
                <img src="assets/images/posts/<?= $post['thumbnail']?>" alt="blog image">
            </div>
            <p>
            <?= $post['body']?>
            </p>
        </div>
    </section>
   
</body>

</html>