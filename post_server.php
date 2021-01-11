<?php

include 'server.php';
ob_start();

function uploadPost($db) {
    if (isset($_POST['upload'])) {
        $title = mysqli_real_escape_string($db, $_POST['title']);
        $content = mysqli_real_escape_string($db, $_POST['content']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $category = mysqli_real_escape_string($db, $_POST['category']);
        $image = $_FILES['uploadImage']['name'];

        if (empty($image)) {
            array_push($errors, "Vyber obrazok");
        }

        if (empty($title)) {
            array_push($errors, "Zadaj nazov.");
        }

        if (empty($content)) {
            array_push($errors, "Zadaj obsah.");
        }

        if (empty($description)) {
            array_push($errors, "Zadaj popis.");
        } else {
            if (strlen($description) > 400) {
                array_push($errors, "Popis moze mat max 400znakov.");
            }
        }

        if (empty($category)) {
            array_push($errors, "Zadaj kategoriu.");
        }

        if (count($errors) == 0) {
            move_uploaded_file($_FILES['uploadImage']['tmp_name'], 'images/post_images/' . $_FILES['uploadImage']['name']);
            $file_dest = 'images/post_images/' . $_FILES['uploadImage']['name'];

            $query = "INSERT INTO posts (image, title, description, content, category) VALUES ('$file_dest', '$title', '$description', '$content', '$category')";
            mysqli_query($db, $query);
            header('location: upload_post_form.php?success');
            exit();
        }
    }
}

function deletePost ($db) {
    $count = 0;

    if (isset($_POST['delPost'])) {

        $id = $_POST['post_id'];
        $image = $_POST['img_path'];

        if (file_exists($image)) {
            unlink($image);
        } else {
            header("location: post.php?id=$id&error");
            $count++;
        }
        if ($count == 0) {

            $sql = "DELETE FROM comments WHERE post_id='$id'";
            mysqli_query($db, $sql);

            $sql = "DELETE FROM posts WHERE post_ID='$id'";
            mysqli_query($db, $sql);

            header('location: home.php?category=');
            exit();
        }
    }
}

function editPost($db) {
    if (isset($_POST['editPost'])) {
        $count = 0;
        $id = $_POST['id'];
        $title = mysqli_real_escape_string($db, $_POST['title']);
        $content = mysqli_real_escape_string($db, $_POST['content']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $category = mysqli_real_escape_string($db, $_POST['category']);


        if (!empty($title)) {
            $sql = "UPDATE posts SET title='$title' WHERE post_ID='$id'";
            mysqli_query($db, $sql);
        } else {
            //echo "Zadaj nazov.";
            $count++;
        }

        if (!empty($content)) {
            $sql = "UPDATE posts SET content='$content' WHERE post_ID='$id'";
            mysqli_query($db, $sql);
        } else {
            //echo "Zadaj telo.";
            $count++;
        }

        if (!empty($description)) {
            $sql = "UPDATE posts SET description='$description' WHERE post_ID='$id'";
            mysqli_query($db, $sql);
        } else {
            //echo "Zadaj popis.";
            $count++;
        }

        if ($count == 0) {
            header("location: post.php?id=$id");
        } else {
            echo "Chyba.";
        }
    }
}


function editImage($db) {
    if (isset($_POST['editImage'])) {
        $count = 0;

        $id = $_POST['id'];
        $oldImage = $_POST['oldPath'];
        $newImage = $_FILES['newImage']['name'];

        if (empty($oldImage)) {
            $count++;
        }

        if (file_exists($oldImage)) {
            unlink($oldImage);
        } else {
            header("location: post.php?id=$id&error");
            $count++;
        }

        if (empty($newImage)) {
            $count++;
        }

        if ($count == 0) {
            move_uploaded_file($_FILES['newImage']['tmp_name'], 'images/post_images/' . $_FILES['newImage']['name']);
            $file_dest = 'images/post_images/' . $_FILES['newImage']['name'];

            $sql = "UPDATE posts SET image='$file_dest' WHERE post_ID='$id'";
            mysqli_query($db, $sql);

            header("location: post.php?id=$id");
        }
    }
}
