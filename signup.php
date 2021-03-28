<?php

require_once 'helpers.php';

session_start();

template('Create an account', 'Signup', function () { ?>
    <form action="store_user.php" method="POST">

        <label for="username">Username</label>
        <input type="text" name="username" required>
        <?php show_error(); ?>
        <br>

        <label for="password">Password</label>
        <input type="password"  name="password" placeholder="More than 8 characters" required>
        <br>

        <label for="homeAddress">Home address</label>
        <input type="text" name="homeAddress" required>
        <br>

        <input type="submit">
    </form>
<?php });

function show_error()
{
    // Input injected from url in order to demonstrate non persistent XSS attacks.
    if(isset($_GET["error"])) {
        $error = validated_input($_GET["error"]);
        echo "<p style='color: red'>$error</p>";
    }
}