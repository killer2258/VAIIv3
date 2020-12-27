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
    <link rel="stylesheet" href="navbar_style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="home.php">Domov</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategorie <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="action.php">Akcne</a></li>
                            <li><a href="strategic.php">Strategicke</a></li>
                            <li><a href="rpg.php">RPG</a></li>
                        </ul>
                    </li>
                    <li><a href="about_us.html">O nas</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="btn btn-primary register <?php
                        if ($_SESSION['login_user'] != ''){echo " hidden"; }
                        ?>"  href="register.php#"><span class="glyphicon glyphicon-pencil"></span> Sign up</a></li>
                    <li>
                        <a type="button" class="btn btn-primary <?php
                        if ($_SESSION['login_user'] != ''){echo " hidden"; }
                        ?>" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-log-in"></span>
                            Prihlasit
                        </a>
                        <form method="post">
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        </div>
                                        <div class="modal-body">
                                            <?php include 'errors.php'; ?>
                                            <div class="form-group mx-sm-3 mb-2">
                                                <label for="inputPassword2" class="sr-only">E-mail</label>
                                                <input type="text" name="nick" class="form-control" id="inputPassword2" placeholder="Nick...">
                                            </div>
                                            <div class="form-group mx-sm-3 mb-2">
                                                <label for="inputPassword2" class="sr-only">Heslo</label>
                                                <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Heslo...">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="login" class="btn btn-primary mb-2">Prihlasit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li><a class="btn btn-primary <?php
                        if ($_SESSION['login_user'] == ''){echo " hidden"; }
                        ?>" href="profile.php"><span class="glyphicon glyphicon-user"></span> Profil</a>
                    </li>
                    <li><a class="btn btn-primary <?php
                        if ($_SESSION['login_user'] == ''){echo " hidden"; }
                        ?>" href="<?php echo "home.php?logout='1'" ?>"><span class="glyphicon glyphicon-off"></span> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div  class="row">
            <h2 align="center">Profilové údaje</h2>
            <div class="col-lg-12 col-md-12 <?php if ($_GET['state'] == 'edit'){echo 'hidden';}?>">
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
                    <button type="submit" class="btn btn-primary" name="delete">Odstranit</button>
                </form>

            </div>
            <form style="width: 80%; margin: auto" class="<?php if ($_GET['state'] != 'edit'){echo 'hidden';}?>" action="<?php edit_profile($db); ?>" method="post">
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
                <button type="submit" class="btn btn-primary" name="edit">Uložiť</button>
            </form>
            <?php endwhile; ?>
        </div>
</body>
