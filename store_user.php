<?php

require_once 'helpers.php';

session_start();


$username = $_POST['username'];
$password = $_POST['password'];
$home_address = $_POST['homeAddress'];

if (!validateInput($username, $password, $home_address)) {
    // Skulle kunna hoppa tillbaka till registreringssidan och visa en alert i js
    die('Validation failed');
}

try {
    mysqli_report(MYSQLI_REPORT_ALL);
    insertUser($username, password_hash($password, PASSWORD_DEFAULT), $home_address);

} catch (Exception $e) {
    $constraint_validation_failure = 1062;
    if ($e->getCode() == $constraint_validation_failure) {
        $error = urlencode("Username ($username) already taken. Please enter another one and try again.");
        redirect("signup.php?error=$error");
    } else {
        die($e->getMessage());
    }
}

login_user($username, $home_address);
redirect('index.php');

function validateInput($username, $password, $home_adress)
{
    if (password_is_blacklisted($password) || strlen($password) < 8) {
        return false;
    }
    return true;
}

function password_is_blacklisted($password)
{
    return in_array($password, array(
        '123456',
        '123456789',
        'qwerty',
        'password',
        '111111',
        '12345678',
        'abc123',
        '1234567',
        'password1',
        '12345'
    ));
}

function insertUser($username, $password, $home_adress)
{
    $db = create_mysqli();
    if (ALLOW_SQL_INJECTIONS) {
        $sql = "INSERT INTO users (username, password, home_address) VALUES ('$username', '$password', '$home_adress')";
        $db->multi_query($sql);
    } else {
        $stmt = $db->prepare('INSERT INTO users (username, password, home_address) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $username, $password, $home_adress);
        $stmt->execute();
    }
    $db->close();
}