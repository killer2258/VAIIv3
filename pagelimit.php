<?php
include('db_connect.php');
session_start();
$limit = 3;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;

$category = $_SESSION['category'];

if ($category == "action") {
    $sql = "SELECT * FROM posts WHERE category='action' ORDER BY `post_id` DESC LIMIT $start_from, $limit";
} else if ($category == "rpg") {
    $sql = "SELECT * FROM posts WHERE category='rpg' ORDER BY `post_id` DESC LIMIT $start_from, $limit";
} else if ($category == "strategic") {
    $sql = "SELECT * FROM posts WHERE category='strategic' ORDER BY `post_id` DESC LIMIT $start_from, $limit";
} else {
    $sql = "SELECT * FROM posts ORDER BY `post_id` DESC LIMIT $start_from, $limit";
}

$query = $db->query($sql);

while($row = $query->fetch_assoc()):
    ?>
    <a href="<?php echo "post.php?id=" . $row['post_ID'] . "&edit="?>">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <img alt="image" class="description-img" src="<?php echo $row['image']?>">
            </div>
            <div class="col-lg-6 col-md-6">
                <h2><?php echo $row['title']?></h2>
                <p><?php echo $row['description']?></p>
            </div>
        </div>
    </a>
<?php endwhile; ?>