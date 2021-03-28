<?php

require_once 'helpers.php';

session_start();

if (detected_csrf($_POST['csrf'])) {
    die('CSRF prevented!');
}

$username = get_session_username();
$homeAddress = validated_input($_POST['homeAddress']);
updateUser($username, $homeAddress);
set_session_homeAddress($homeAddress);
redirect('index.php');

function updateUser($username, $home_adress)
{
    $db = create_mysqli();
    $stmt = $db->prepare('UPDATE users SET home_address = ? WHERE username = ?');
    $stmt->bind_param('ss',$home_adress, $username);
    $stmt->execute();
    $db->close();
}