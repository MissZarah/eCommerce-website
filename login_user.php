<?php

require_once 'helpers.php';

session_start();

if (isset($_SESSION['login_timer'])) {
    $waiting_time = 10;
    if (time() - $_SESSION['login_timer'] > $waiting_time) {
        unset($_SESSION['login_attempt']);
        unset($_SESSION['login_timer']);
    } else {
        $time_left = $waiting_time - (time() - $_SESSION['login_timer']);
        $message = 'You have been temporarily locked out due to too many unsuccessful attempts to login. ' .
            'Please wait another ' . $time_left . ' seconds and try again.';
        die($message);
    }
}

$username = $_POST['username'];
$password = $_POST['password'];

$db = create_mysqli();
$stmt = $db->prepare('SELECT password, home_address FROM users WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hash, $address);
$stmt->fetch();

if (password_verify($password, $hash)) {
    unset($_SESSION['login_attempt']);
    unset($_SESSION['login_timer']);
    login_user($username, $address);
    redirect($_SESSION['prevPage']);
} else {

    if (!isset($_SESSION['login_attempt'])) {
        $_SESSION['login_attempt'] = 0;
    }
    $_SESSION['login_attempt'] += 1;
    if ($_SESSION['login_attempt'] >= 3) {
        if (!isset($_SESSION['login_timer'])) {
            $_SESSION['login_timer'] = time();
        }
    }

    die('Incorrect username or password.');
}