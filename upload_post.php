<?php

include 'server.php';

if (isset($_POST['upload'])) {
        $title = mysqli_real_escape_string($db, $_POST['title']);
        $content = mysqli_real_escape_string($db, $_POST['content']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $category = mysqli_real_escape_string($db, $_POST['category']);
        $image = $_FILES['uploadImage']['name'];

    if(empty($image)) {
        array_push($errors, "Vyber obrazok");
    }

    if(empty($title)){
        array_push($errors, "Zadaj nazov.");
    }

    if(empty($content)){
        array_push($errors, "Zadaj obsah.");
    }

    if(empty($description)){
        array_push($errors, "Zadaj popis.");
    } else {
        if (strlen($description) > 400) {
            array_push($errors, "Popis moze mat max 400znakov.");
        }
    }

    if(empty($category)){
        array_push($errors, "Zadaj kategoriu.");
    }

    if (count($errors) == 0) {
        move_uploaded_file($_FILES['uploadImage']['tmp_name'], 'images/post_images/'.$_FILES['uploadImage']['name']);
        $file_dest = 'images/post_images/'.$_FILES['uploadImage']['name'];

        $query = "INSERT INTO posts (image, title, description, content, category) VALUES ('$file_dest', '$title', '$description', '$content', '$category')";
        mysqli_query($db, $query);
        header('location: upload_post_form.php?success');
        exit();


    }






}


