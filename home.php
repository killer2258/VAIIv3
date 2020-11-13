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
                                            <h5 class="modal-title" id="exampleModalLabel">Prihlásenie</h5>
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
                        ?>" href="profile.php"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
                    <li><a class="btn btn-primary <?php
                        if ($_SESSION['login_user'] == ''){echo " hidden"; }
                        ?>" href="<?php echo "home.php?logout='1'" ?>"><span class="glyphicon glyphicon-off"></span> Logout</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row " style="border: 3px solid black">
            <div class="col-lg-8 col-md-9" style="border-right: 3px solid black">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <img src="images/001.jpg">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h2>Nadpis</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis arcu rhoncus non. Aenean consectetur, risus vitae sagittis interdum, ligula quam rutrum mi, sed tincidunt ex quam non est. Sed volutpat nisl enim, sed ornare sem rhoncus eget. Sed id facilisis lacus. Curabitur sed semper ante. Cras volutpat nibh sit amet sem lobortis pulvinar. Mauris nulla est.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <img src="images/001.jpg">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h2>Nadpis</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis arcu rhoncus non. Aenean consectetur, risus vitae sagittis interdum, ligula quam rutrum mi, sed tincidunt ex quam non est. Sed volutpat nisl enim, sed ornare sem rhoncus eget. Sed id facilisis lacus. Curabitur sed semper ante. Cras volutpat nibh sit amet sem lobortis pulvinar. Mauris nulla est.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <img src="images/001.jpg">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h2>Nadpis</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis arcu rhoncus non. Aenean consectetur, risus vitae sagittis interdum, ligula quam rutrum mi, sed tincidunt ex quam non est. Sed volutpat nisl enim, sed ornare sem rhoncus eget. Sed id facilisis lacus. Curabitur sed semper ante. Cras volutpat nibh sit amet sem lobortis pulvinar. Mauris nulla est.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <img src="images/001.jpg">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h2>Nadpis</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis arcu rhoncus non. Aenean consectetur, risus vitae sagittis interdum, ligula quam rutrum mi, sed tincidunt ex quam non est. Sed volutpat nisl enim, sed ornare sem rhoncus eget. Sed id facilisis lacus. Curabitur sed semper ante. Cras volutpat nibh sit amet sem lobortis pulvinar. Mauris nulla est.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <img src="images/001.jpg">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h2>Nadpis</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis arcu rhoncus non. Aenean consectetur, risus vitae sagittis interdum, ligula quam rutrum mi, sed tincidunt ex quam non est. Sed volutpat nisl enim, sed ornare sem rhoncus eget. Sed id facilisis lacus. Curabitur sed semper ante. Cras volutpat nibh sit amet sem lobortis pulvinar. Mauris nulla est.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <img src="images/001.jpg">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h2>Nadpis</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis ornare lorem, eget convallis arcu rhoncus non. Aenean consectetur, risus vitae sagittis interdum, ligula quam rutrum mi, sed tincidunt ex quam non est. Sed volutpat nisl enim, sed ornare sem rhoncus eget. Sed id facilisis lacus. Curabitur sed semper ante. Cras volutpat nibh sit amet sem lobortis pulvinar. Mauris nulla est.</p>
                    </div>
                </div>
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