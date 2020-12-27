<?php
include 'server.php';
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
        <div class="col-lg-8 col-md-9" style="border-right: 3px solid black">
            <?php
            $sql = "SELECT * FROM posts WHERE category='strategic' ORDER BY `post_id` DESC ";
            $query = $db->query($sql);
            while($row = $query->fetch_assoc()):
                ?>
                <a href="<?php echo "post.php?id=" . $row['post_ID']?>">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <img class="description-img" src="<?php echo $row['image']?>">
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <h2><?php echo $row['title']?></h2>
                            <p><?php echo $row['description']?></p>
                        </div>
                    </div>
                </a>


            <?php endwhile; ?>
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