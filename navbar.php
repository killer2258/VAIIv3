<?php
include 'adminTool.php';
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="style.css">
</head>
<body onload="protect()">
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
                <li><a href="home.php?category=">Domov</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategorie <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="home.php?category=action">Akcne</a></li>
                        <li><a href="home.php?category=strategic">Strategicke</a></li>
                        <li><a href="home.php?category=rpg">RPG</a></li>
                    </ul>
                </li>
                <li><a href="aboutUs.php">O nas</a></li>
                <li class="adminTool dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tools <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="users.php">Pouzivatelia</a></li>
                        <li><a href="posts.php">Články</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="btn btn-primary register <?php
                    if ($_SESSION['login_user'] != ''){echo " hidden"; }
                    ?>"  href="register.php#"><span class="glyphicon glyphicon-pencil"></span> Registrovať</a></li>
                <li>
                    <a class="btn btn-primary <?php
                    if ($_SESSION['login_user'] != ''){echo " hidden"; }
                    ?>" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-log-in"></span>
                        Prihlasit
                    </a>
                    <form method="post" style="margin: 0">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Prihlásenie</h5>
                                    </div>
                                    <div class="modal-body">
                                        <?php include 'errors.php'; ?>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword" class="sr-only">E-mail</label>
                                            <input type="text" name="nick" class="form-control" id="inputPassword" placeholder="Nick...">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Heslo</label>
                                            <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Heslo...">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="forgot_pass.php" class="btn btn-primary mb-2">Zabudnute heslo</a>
                                        <button type="submit" name="login" class="btn btn-primary mb-2">Prihlasit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>

                <li class="adminTool"><a class="btn btn-primary" href="upload_post_form.php"><span class="glyphicon glyphicon-plus"></span> Pridať príspevok</a></li>
                <li><a class="btn btn-primary <?php
                    if ($_SESSION['login_user'] == ''){echo " hidden"; }
                    ?>" href="profile.php?state="><span class="glyphicon glyphicon-user"></span> Profil</a></li>
                <li><a class="btn btn-primary <?php
                    if ($_SESSION['login_user'] == ''){echo " hidden"; }
                    ?>" href="<?php echo "home.php?logout='1'" ?>"><span class="glyphicon glyphicon-off"></span> Odhlásiť</a></li>

            </ul>
        </div>
    </div>
</nav>
