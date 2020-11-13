<?php



if(!isset($_SESSION['nick'])) {
    die();
}

session_start();
$user_login_check = $_SESSION['login_user'];

$session_sql = mysqli_query($db, "SELECT FROM users WHERE nick = '$user_login_check'");
$row = mysqli_fetch_row($session_sql, MYSQLI_ASSOC);
$login_session = $row['username'];

