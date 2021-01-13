<?php
    include 'server.php';
    include 'navbar.php';
?>
<title>Registracia</title>
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