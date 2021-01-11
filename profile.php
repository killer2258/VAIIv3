<?php
include 'server.php';
include 'profile_server.php';

$logged = $_SESSION['login_user'];

$user_query = "SELECT * FROM users WHERE nick='$logged'";
$user_query = $db->query($user_query);
$user_query = $user_query->fetch_assoc();

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
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    <div class="container">
        <div  class="row">
            <h2 align="center">Profilové údaje</h2>
            <div class="col-lg-12 col-md-12 <?php if ($_GET['state'] == 'edit'){echo 'hidden';}?>" style="min-height: 40vw;">
                <div class="row">
                    <div class="col-md-4">
                        <p>Nick:</p>
                    </div>
                    <div class="col-md-6">
                        <?php
                            $profile = "SELECT nick, email FROM users WHERE nick = '$logged'";
                            $res = $db->query($profile);

                            while ($row = $res->fetch_assoc()):

                        ?>
                        <p><?php echo $row['nick'] ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p>E-mail:</p>
                    </div>
                    <div class="col-md-6">
                        <p><?php echo $row['email'] ?></p>
                    </div>
                </div>
                <?php echo '<a class="btn btn-primary" type="submit" href="profile.php?chyba=0&state=edit&id='.$user_query['user_id'].'">Editovať profil</a>' ?>
                <form method="post" action="<?php delete_profile($db); ?>">
                    <input type="text" class="hidden" name="user_id" value="<?php echo $user_query['user_id'] ?>">
                    <button type="submit" class="btn btn-primary" name="delete" style="margin-top: 10px;">Odstranit</button>
                </form>

            </div>
            <form style="width: 80%; min-height: 40vw;  margin: auto" class="<?php if ($_GET['state'] != 'edit'){echo 'hidden';}?>" action="<?php edit_profile($db); ?>" method="post">
                <?php if($_GET['chyba'] == 1) {
                        echo '<p> Nespravny nick. </p>';
                    }

                    if($_GET['chyba'] == 2) {
                        echo '<p> Nespravny format emailu! </p>';
                    }
                 ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nový nick</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Novy nick..." name="nick">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nový e-mail</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Novy email..." name="email">
                </div>
                <button type="submit" class="btn btn-primary" name="edit" >Uložiť</button>
            </form>
            <?php endwhile; ?>
        </div>
</body>
