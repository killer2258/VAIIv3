<?php

include 'db_connect.php';
session_start();



$errors = array();
$nick = "";
$email = "";

function check_filters($expression, $filters) {
    foreach ($filters as $value) {
        if (!preg_match($value, $expression)) {
            return 0;
        }
    }
    return 1;
}

function check_in($data) {
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

    if(empty($nick)) {
        array_push($errors, "Nezadali ste nick!");
    }
    else {
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
        $pwd = md5($pwd);
        $query = "INSERT INTO users (nick, email, password) VALUES ('$nick', '$email', '$pwd')";
        mysqli_query($db, $query);
        header('location: home.php');
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
        $heslo = md5($heslo);
        $sql = "SELECT * FROM users WHERE nick='$nick' AND password='$heslo'";
        $result = mysqli_query($db, $sql);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $query = $db->query($sql);
            $row = $query->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['login_user'] = $nick;
            header('location: home.php');
            exit();
        } else {
            array_push($errors, "Nespravne meno alebo heslo");
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['nick']);
    header("location: home.php");
}