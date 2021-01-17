<!DOCTYPE html>
<?php
include 'server.php';
?>
<title>Zmena_Hesla</title>
<?php
include 'navbar.php';
?>
<div class="container">
    <form method="post" action="server.php">
        <?php include 'errors.php'; ?>
        <div class="form-group <?php if ($_SESSION['user_id'] != '') { echo "hidden";}?>">
            <label for="email">E-mail</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="<?php if ($_SESSION['user_id'] != '') { echo $_SESSION['email']; }?>">
        </div>
        <div class="form-group">
            <label for="password1">Nove Heslo</label>
            <input name="password" type="password" class="form-control" id="password1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password2">Nove heslo znova</label>
            <input name="re-password" type="password" class="form-control" id="password2" placeholder="Re-Password">
        </div>
        <button type="submit" name="resetPass" class="btn btn-primary in-login-btn">Submit</button>
    </form>
</div>
</body>
</html>
