<?php

function get_session_username()
{
    if (isset($_SESSION['username'])) {
        return validated_input($_SESSION['username']);
    } else {
        return null;
    }
}

function set_session_username($username)
{
    $_SESSION['username'] = $username;
}

function set_session_homeAddress($homeAddress)
{
    $_SESSION['homeAddress'] = $homeAddress;
}

function get_session_homeAddress()
{
    return validated_input($_SESSION['homeAddress']);
}

function set_session_token($token)
{
    return $_SESSION['token'] = $token;
}

function get_session_token()
{
    return $_SESSION['token'];
}

function login_user($username, $homeAddress)
{
    // Regenerate session id before escalating privilege
    // in order to protect against session fixation attacks
    // (Lecture 3)
    session_start();
    session_regenerate_id();
    session_start();

    set_session_username($username);
    set_session_homeAddress($homeAddress);
    set_session_token(bin2hex(random_bytes(32)));
}

function logged_in()
{
    return get_session_username() != null;
}

function validated_input($input)
{
    if (!ALLOW_XSS) {
        return htmlspecialchars($input);
    } else {
        return $input;
    }
}