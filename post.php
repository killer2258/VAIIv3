<?php
include 'comment_server.php';
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="home_style.css">
</head>
<body>
<?php
include 'navbar.php';
?>

<div class="container">
    <div class="row " style="border: 3px solid black">
        <div class="col-lg-8 col-md-9">
            <div class="<?php
            if(($_GET['edit'] == 'edit' || $_GET['edit'] == 'editImage')) {

                    echo 'hidden';

            } ?>">
                <h2 align="center"><?php echo $title ?></h2>
                <img class="post-img" src="<?php echo $image ?>">
                <a class="btn btn-primary<?php if ($_SESSION['login_user'] != 'admin'){echo " hidden"; } ?>" href="post.php?id=<?php echo $post_id;?>&edit=editImage">Zmeniť obrázok</a>
                <p style="margin-top: 10px" align="justify"><?php echo $content ?></p>
                <a class="btn btn-primary<?php if ($_SESSION['login_user'] != 'admin'){echo " hidden"; } ?>" href="post.php?id=<?php echo $post_id;?>&edit=edit">Editovať</a>

            <form action="<?php deletePost($db);?>" method="post" class="<?php
            if ($_SESSION['login_user'] != 'admin'){echo " hidden"; }
            ?>" >
                <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                <input type="hidden" name="img_path" value="<?php echo $image ?>">
                <button type="submit" class="btn btn-primary" name="delPost">Odstrániť</button>
            </form>
            </div>

            <form action="<?php editPost($db);?>" method="post" class="<?php if(($_GET['edit'] != 'edit')) { echo 'hidden'; } ?>">
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
                <button type="submit" class="btn btn-primary" name="editPost" >Uložiť</button>
            </form>

            <form action="<?php editImage($db); ?>" method="post" enctype="multipart/form-data" class="<?php if($_GET['edit'] != 'editImage') { echo 'hidden'; } ?>">
                <input type="hidden" name="id" value="<?php echo $post_id ?>">
                <input type="hidden" name="oldPath" value="<?php echo $image ?>">
                <div class="form-group">
                    <label>Image:</label>
                    <input name="newImage" accept="image/jpeg" type="file" class="form-control-file">
                </div>
                <button type="submit" name="editImage" class="btn btn-primary in-login-btn">Upload</button>
            </form>

            <h3 align="center">Komentare</h3>

            <form action="<?php set_comment($db); ?>" method="post" class="<?php if($_GET['edit'] == 'edit' || $_GET['edit'] == 'editImage' || $_SESSION['user_id'] == '') { echo 'hidden'; }?>">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
                <div class="form-group">
                    <textarea name="content" class="form-control" placeholder="Content"></textarea>
                </div>
                <button style="margin-bottom: 10px" type="submit" name="comment_submit" class="btn btn-primary in-login-btn">Komentovať</button>
            </form>

            <div class="<?php if ($_SESSION['user_id'] != '') { echo 'hidden'; }?>">
                <p>Ak chcete pridávať komentáre, musíte sa prihlásiť</p>
            </div>

            <?php
            $sql = "SELECT users.nick,comments.date,comments.content 
                            FROM comments 
                            JOIN users ON comments.user_id=users.user_id 
                            JOIN posts ON comments.post_id=posts.post_ID 
                            WHERE posts.post_ID=$post_id ORDER BY comment_id ASC";

            $query = $db->query($sql);
            while($row = $query->fetch_assoc()):
                ?>
            <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>
                        <p style="color: red"><?php echo $row['nick'];?></p>
                    </td>
                    <td style="text-align: right; color: #727272">
                        <i><?php echo $row['date'];?></i>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $row['content'];?>
                    </td>
                </tr>
            </table>
            </div>
            <?php endwhile;?>

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