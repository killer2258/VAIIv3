<?php
    include 'server.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="navbar_style.css">
</head>
<body>
<?php
include 'navbar.php';
?>
<div class="container">
    <form method="post">
        <?php include 'errors.php'; ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Nick</label>
            <input name="nick" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nick">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">E-mail</label>
            <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Re-Password</label>
            <input name="re-password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Re-Password">
        </div>
        <button type="submit" name="register" class="btn btn-primary in-login-btn">Submit</button>
    </form>
</div>
</body>
</html>