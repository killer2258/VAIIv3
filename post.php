<?php
include 'post_server.php';



            $post_id = $_GET['id'];
            $sql = "SELECT * FROM posts WHERE post_ID='$post_id'";
            $query = $db->query($sql);
            while($row = $query->fetch_assoc()) {
                $title = $row['title'];
                $image = $row['image'];
                $content = $row['content'];
                $description = $row['description'];
                $category = $row['category'];
            }
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
    <div class="row " style="border: 3px solid black">
        <div class="col-lg-8 col-md-9 <?php if($_GET['edit'] == 'edit') { echo 'hidden'; } ?>" style="border-right: 3px solid black">
                <h2 align="center"><?php echo $title ?></h2>
                <img class="post-img" src="<?php echo $image ?>">
                <p style="margin-top: 10px" align="justify"><?php echo $content ?></p>
            <form method="post" class="<?php
            if ($_SESSION['login_user'] != 'admin'){echo " hidden"; }
            ?>" >
                <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                <input type="hidden" name="img_path" value="<?php echo $image ?>">
                <button type="submit" class="btn btn-primary" name="delPost">Odstrániť</button>
            </form>
            <a class="btn btn-primary" href="post.php?id=<?php echo $post_id;?>&edit=edit">Editovať</a>
        </div>
        <div class="col-lg-8 col-md-9 <?php if($_GET['edit'] != 'edit') { echo 'hidden'; } ?>" style="border-right: 3px solid black">
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $post_id ?>">
                <div class="form-group">
                    <label>Title:</label>
                    <input name="title" type="text" class="form-control" placeholder="Title" value="<?php echo $title?>">
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" class="form-control" placeholder="Description" rows="5" ><?php echo $description?></textarea>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control" placeholder="Content" rows="30"><?php echo $content?></textarea>
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
                <button type="submit" class="btn btn-primary" name="editPost" >Uložiť</button>
            </form>
        </div>
        <div class="col-lg-4 col-md-3">
            <div class="row" style="padding: 0 20px;  min-height: 500px; max-height: 800px">
                <h2 style="text-align: center">Nadpis</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis arcu rhoncus non. Aene</p>
            </div>
            <div class="row" style="padding: 0 20px;  min-height: 500px; max-height: 800px">
                <h2 style="text-align: center">Nadpis</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis arcu rhoncus non. Aene</p>
            </div>
        </div>
    </div>
</div>


</body>
</html>