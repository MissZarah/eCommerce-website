<?php

require_once 'helpers/template_html.php';
require_once 'helpers/db.php';
require_once 'helpers/session.php';
require_once 'helpers/security_configs.php';

function template($title, $active_tab, $content)
{
    if (ALLOW_XSS) {
        header("X-XSS-Protection: 0");
    } else {
        header("X-XSS-Protection: 1");
    }

    if (!isset($_SESSION)) {
        session_start();
    }

    $tabs = navbar_tabs();
    template_html($title, $tabs, $active_tab, $content);
}

function navbar_tabs()
{
    $username = get_session_username();
    if (isset($username)) {
        return array(
            array('Home', 'index.php'),
            array('Shoppingbag', 'cart.php'),
            array($username, 'edit_user.php'),
            array("Logout", 'logout.php')
        );
    } else {
        return array(
            array('Home', 'index.php'),
            array('Shoppingbag', 'cart.php'),
            array("Login", 'login.php'),
            array("Signup", 'signup.php')
        );
    }
}

function redirect($location)
{
    header("Location:$location");
    die;
}

function detected_csrf($submitted_token)
{
    if (ALLOW_CSRF) {
        return false;
    } else {
        return !hash_equals($_SESSION['token'], $submitted_token);
    }
}