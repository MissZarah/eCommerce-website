<?php

require_once 'helpers.php';

session_start();

template('Login', 'Login', function () { ?>
    <form action="login_user.php" method="POST">

        <label for="username">Username</label>
        <input type="text" name="username" required>
        <br>

        <label for="password">Password</label>
        <input type="password" name="password" required>
        <br>

        <input type="submit" value="Login">
    </form>
<?php });