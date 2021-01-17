<!DOCTYPE html>
<?php
include 'profile_server.php';

$sql = "SELECT * FROM users ORDER BY user_id ASC";
$query = $db->query($sql);

$stranka = "adminStranka";
?>
<title>Pouzivatelia</title>
<?php
include 'navbar.php';
?>
<div class="container">
    <div class="row " style="border: 3px solid black">
        <table class="table">
            <tr>
                <th scope="col">ID pouzivatela</th>
                <th scope="col">Meno</th>
                <th scope="col">E-mail</th>
                <th scope="col"></th>
            </tr>
        <?php while($row = $query->fetch_assoc()):?>
            <tr>
                <td>
                    <?php echo $row['user_id']?>
                </td>
                <td>
                    <?php echo $row['email']?>
                </td>
                <td>
                    <?php echo $row['nick']?>
                </td>
                <td>
                    <form method="post" action="<?php delete_profile($db); ?>">
                        <input type="text" class="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
                        <input type="hidden" name="stranka" value="<?php echo $stranka ?>">
                        <button type="submit" class="btn btn-primary" name="delete">Odstranit</button>
                    </form>
                </td>
            </tr>
        <?php endwhile;?>
        </table>
    </div>
</div>
</body>
</html>