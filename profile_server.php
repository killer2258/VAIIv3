<?php
include 'db_connect.php';

ob_start();

/**
 * @param $db
 */
function edit_profile($db) {
$count = 0;
    if (isset($_POST['edit'])) {
        $nick = mysqli_real_escape_string($db, $_POST['nick']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $id = $_GET['id'];


        if(!empty($nick)) {
            $nick = check_in($_POST['nick']);
            if (strlen($nick) < 5) {
                $count++;
                header("Location: profile.php?state=edit&chyba=1");
            } else {
                $sql = "UPDATE users SET nick='$nick' WHERE user_id='$id'";
                mysqli_query($db, $sql);
                $_SESSION['login_user'] = $nick;
            }
        }


        if(!empty($email)) {
            $email = check_in($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $count++;
                header("Location: profile.php?state=edit&chyba=2");
            } else {
                $sql = "UPDATE users SET email='$email' WHERE user_id='$id'";
                mysqli_query($db, $sql);
            }
        }

        if ($count == 0) {
            header("Location: profile.php?state=");
        }
    }
}

/**
 * @param $db
 */
function delete_profile($db) {

    if (isset($_POST['delete'])) {
        $id = $_POST['user_id'];
        $stranka = $_POST['stranka'];

        $sql = "DELETE FROM comments WHERE user_id='$id'";
        mysqli_query($db, $sql);

        $sql = "DELETE FROM users WHERE user_id='$id'";
        mysqli_query($db, $sql);
        session_destroy();
        unset($_SESSION['nick']);

        if ($stranka == "adminStranka") {
            header("location: users.php");
            exit();
        }

        header("location: home.php?category=");
        exit();
    }
}