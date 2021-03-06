<!DOCTYPE html>
<?php
include 'server.php';
include 'profile_server.php';

$logged = $_SESSION['login_user'];

$user_query = "SELECT * FROM users WHERE nick='$logged'";
$user_query = $db->query($user_query);
$user_query = $user_query->fetch_assoc();

?>
<title>Profil</title>
<?php
include 'navbar.php';
?>
<div class="container">
    <div class="row">
        <h2>Profilové údaje</h2>
        <div class="col-lg-12 col-md-12 <?php if ($_GET['state'] == 'edit') {
            echo 'hidden';
        } ?>" style="min-height: 350px;">
            <div class="row">
                <div class="col-md-6 profile">
                    <b>Nick:</b>
                </div>
                <div class="col-md-6 profile">
                    <?php
                    $profile = "SELECT nick, email FROM users WHERE nick = '$logged'";
                    $res = $db->query($profile);

                    while ($row = $res->fetch_assoc()):

                    ?>
                    <p><?php echo $row['nick'] ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 profile">
                    <b>E-mail:</b>
                </div>
                <div class="col-md-6 profile">
                    <p><?php echo $row['email'] ?></p>
                </div>
            </div>
        </div>
        <div class="profile-buttons <?php if ($_GET['state'] == "edit") {
            echo "hidden";
        } ?>">

            <a href="forgot_pass.php" class="btn btn-primary">Zmena Hesla</a>
            <?php echo '<a class="btn btn-primary" href="profile.php?chyba=0&state=edit&id=' . $user_query['user_id'] . '">Editovať profil</a>' ?>
            <form method="post" action="<?php delete_profile($db); ?>">
                <input type="text" class="hidden" name="user_id" value="<?php echo $user_query['user_id'] ?>">
                <button type="submit" class="btn btn-primary" name="delete" style="margin-top: 10px;">Odstranit</button>
            </form>
        </div>
        <form style="width: 80%; min-height: 40vw;  margin: auto" class="<?php if ($_GET['state'] != 'edit') {
            echo 'hidden';
        } ?>" action="<?php edit_profile($db); ?>" method="post">
            <?php if ($_GET['chyba'] == 1) {
                echo '<p> Nespravny nick. </p>';
            }

            if ($_GET['chyba'] == 2) {
                echo '<p> Nespravny format emailu! </p>';
            }
            ?>
            <div class="form-group">
                <label for="newNick">Nový nick</label>
                <input type="text" class="form-control" id="newNick" placeholder="Novy nick..." name="nick">
            </div>
            <div class="form-group">
                <label for="newEmail">Nový e-mail</label>
                <input type="email" class="form-control" id="newEmail" placeholder="Novy email..." name="email">
            </div>
            <button type="submit" class="btn btn-primary" name="edit">Uložiť</button>
        </form>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
