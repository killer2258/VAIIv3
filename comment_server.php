<?php
include 'post_server.php';
ob_start();

/**
 * @param $db
 */
function set_comment($db)
{
    if (isset($_POST['comment_submit'])) {
        $post_id = mysqli_real_escape_string($db, $_POST['post_id']);
        $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
        $date = mysqli_real_escape_string($db, $_POST['date']);
        $date = date('Y-m-d H:i:s');
        $content = mysqli_real_escape_string($db, $_POST['content']);

        if (!empty($content)) {
            $query = "INSERT INTO comments (post_id, user_id, date, content) VALUES ('$post_id', '$user_id', '$date', '$content')";
            mysqli_query($db, $query);

            header("Location: post.php?id=$post_id");
            exit();
        }
    }
}

/**
 * @param $db
 */
function delete_comment($db)
{
    if (isset($_POST['delete_comment'])) {
        $comment_id = mysqli_real_escape_string($db, $_POST['comment_id']);
        $post_id = mysqli_real_escape_string($db, $_POST['post_id']);

        $query = "DELETE FROM comments WHERE comment_id = $comment_id";
        mysqli_query($db, $query);

        header("Location: post.php?id=$post_id");
        exit();
    }
}