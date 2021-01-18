<?php

include 'db_connect.php';
session_start();

$errors = array();
$nick = "";
$email = "";

if (empty($_SESSION['user_id'])) {
    $_SESSION['user_id'] = '';
    $_SESSION['login_user'] = '';
    $_SESSION['role'] = '';
}

/**
 * @param $expression
 * @param $filters
 * @return int
 */
function check_filters($expression, $filters)
{
    foreach ($filters as $value) {
        if (!preg_match($value, $expression)) {
            return 0;
        }
    }
    return 1;
}

/**
 * @param $data
 * @return string
 */
function check_in($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['register'])) {
    $nick = mysqli_real_escape_string($db, $_POST['nick']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pwd = mysqli_real_escape_string($db, $_POST['password']);
    $repwd = mysqli_real_escape_string($db, $_POST['re-password']);

    if (empty($nick)) {
        array_push($errors, "Nezadali ste nick!");
    } else {
        $nick = check_in($_POST['nick']);
        if (strlen($nick) < 5) {
            array_push($errors, "Zadany nick je prilis kratky!");
        }
    }

    $check_query = "SELECT * FROM users WHERE nick='$nick'";
    $res = mysqli_query($db, $check_query);
    $res = mysqli_fetch_assoc($res);

    if ($res) {
        if ($res['nick'] === $nick) {
            array_push($errors, "Tento nick uz existuje!");
        }
    }

    if (empty($email)) {
        array_push($errors, "Nezadali ste email!");
    } else {
        $email = check_in($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Neplatný email!");
        }
    }

    $check_query = "SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($db, $check_query);
    $res = mysqli_fetch_assoc($res);

    if ($res) {
        if ($res['email'] === $email) {
            array_push($errors, "Tento email sa uz pouziva!");
        }
    }

    if (empty($pwd)) {
        array_push($errors, "Nezadali ste heslo!");
    } else {
        $pwd = htmlspecialchars($_POST['password']);
        if (strlen($pwd) < 8) {
            array_push($errors, "Heslo musí obsahovať aspoň 8 znakov!");
        }
    }

    if (empty($repwd)) {
        array_push($errors, "Potvrďte heslo!");
    } else {
        $repwd = htmlspecialchars($_POST['re-password']);
    }
    if ($pwd != $repwd) {
        array_push($errors, "Heslá sa nezhodujú!");
    }

    if (count($errors) == 0) {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (nick, email, password, role) VALUES ('$nick', '$email', '$pwd', 'pouzivatel')";
        mysqli_query($db, $query);
        header('location: home.php?category=');
        exit();
    }
}

if (isset($_POST['login'])) {
    $nick = mysqli_real_escape_string($db, $_POST['nick']);
    $heslo = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($nick)) {
        array_push($errors, "Nezadal si meno!");
    }
    if (empty($heslo)) {
        array_push($errors, "Nezadal si heslo!");
    }
    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE nick = '$nick'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {

                if (password_verify($heslo, $row['password'])) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['login_user'] = $nick;
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['email'] = $row['email'];
                    header('location: home.php?category=');
                    exit();

                } else {
                    array_push($errors, "Nespravne heslo");
                }


            }
        }
    }


}

if (isset($_GET['logout'])) {
    session_destroy();
    unset ($_SESSION['user_id']);
    unset ($_SESSION['login_user']);
    unset ($_SESSION['role']);
    unset ($_SESSION['email']);
    header("location: home.php?category=");
}

if (isset($_POST['resetPass'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pwd = mysqli_real_escape_string($db, $_POST['password']);
    $repwd = mysqli_real_escape_string($db, $_POST['re-password']);

    if (empty($nick)) {
        array_push($errors, "Nezadali ste nick!");
    } else {
        $nick = check_in($_POST['nick']);
        if (strlen($nick) < 5) {
            array_push($errors, "Zadany nick je prilis kratky!");
        }
    }

    if (empty($pwd)) {
        array_push($errors, "Nezadali ste heslo!");
    } else {
        $pwd = htmlspecialchars($_POST['password']);
        if (strlen($pwd) < 8) {
            array_push($errors, "Heslo musí obsahovať aspoň 8 znakov!");
        }
    }

    if (empty($repwd)) {
        array_push($errors, "Potvrďte heslo!");
    } else {
        $repwd = htmlspecialchars($_POST['re-password']);
    }
    if ($pwd != $repwd) {
        array_push($errors, "Heslá sa nezhodujú!");
    }

    if (count($errors)) {
        $check_query = "SELECT * FROM users WHERE email='$email'";
        $res = mysqli_query($db, $check_query);
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);

            $query = $db->query($check_query);
            $row = $query->fetch_assoc();
            $id = $row['user_id'];

            $query = "UPDATE users SET password='$pwd' WHERE user_id='$id'";
            mysqli_query($db, $query);

            header("location: home.php?category=");
            exit();
        }
    }
}