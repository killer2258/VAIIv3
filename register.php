<?php
    include 'server.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>

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
    <form method="post">
        <?php include 'errors.php'; ?>
        <div class="form-group">
            <label for="nick">Nick</label>
            <input name="nick" type="text" class="form-control" id="nick" placeholder="Nick">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password1">Password</label>
            <input name="password" type="password" class="form-control" id="password1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password2">Re-Password</label>
            <input name="re-password" type="password" class="form-control" id="password2" placeholder="Re-Password">
        </div>
        <button type="submit" name="register" class="btn btn-primary in-login-btn">Submit</button>
    </form>
</div>
</body>
</html>