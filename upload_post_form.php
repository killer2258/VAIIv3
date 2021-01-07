<?php
include 'post_server.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Domov</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="navbar_style.css">
    <link rel="stylesheet" href="home_style.css">
</head>
<body>
<?php
include 'navbar.php';
?>
<div class="container">
    <form action="<?php uploadPost($db);?>" method="post" enctype="multipart/form-data">
        <?php include 'errors.php'; ?>
        <div class="form-group">
            <label>Image:</label>
            <input name="uploadImage" accept="image/jpeg" type="file" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Title:</label>
            <input name="title" type="text" class="form-control" placeholder="Title">
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control" placeholder="Description" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea name="content" class="form-control" placeholder="Content" rows="30"></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select id="inputState" class="form-control" name="category">
                <option selected value="">Vyber</option>
                <option value="action">Action</option>
                <option value="rpg">RPG</option>
                <option value="strategic">Strategic</option>
            </select>
        </div>
        <button type="submit" name="upload" class="btn btn-primary in-login-btn">Upload</button>
    </form>
</div>
</body>
</html>
