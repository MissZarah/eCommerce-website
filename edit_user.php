<?php

require_once 'helpers.php';

session_start();

template('Edit user info', get_session_username(), function () { ?>
    <form action="update_user.php" method="POST">

        <label for="homeAddress">Home address</label>
        <input type="hidden" name="csrf" value="<?= get_session_token() ?>">
        <input type="text" name="homeAddress" value="<?= get_session_homeAddress() ?>" required>
        <br>

        <input type="submit">
    </form>
<?php });