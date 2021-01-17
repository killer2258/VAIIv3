<!DOCTYPE html>
<?php
include 'post_server.php';

$sql = "SELECT * FROM posts ORDER BY post_ID ASC";
$query = $db->query($sql);

$stranka = "adminStranka";
?>
<title>Clanky</title>
<?php
    include 'navbar.php';
?>
<div class="container">
    <div class="row " style="border: 3px solid black">
        <table class="table">
            <tr>
                <th scope="col">ID clanku</th>
                <th scope="col">Nazov</th>
                <th scope="col">Kategoria</th>
                <th scope="col"></th>
            </tr>
            <?php while($row = $query->fetch_assoc()):?>
                <tr>
                    <td>
                        <?php echo $row['post_ID']?>
                    </td>
                    <td>
                        <a href="<?php echo "post.php?id=" . $row['post_ID'] . "&edit="?>"><?php echo $row['title']?></a>
                    </td>
                    <td>
                        <?php echo $row['category']?>
                    </td>
                    <td>
                        <form method="post" action="<?php deletePost($db); ?>">
                            <input type="text" class="hidden" name="post_id" value="<?php echo $row['post_ID'] ?>">
                            <input type="hidden" name="img_path" value="<?php echo $row['image'] ?>">
                            <input type="hidden" name="stranka" value="<?php echo $stranka ?>">
                            <button type="submit" class="btn btn-primary" name="delPost">Odstranit</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile;?>
        </table>
    </div>
</div>
</body>
</html>
