<?php

require_once 'helpers.php';

session_start();

template('Checkout', 'Checkout', function () {
    $_SESSION['prevPage'] = 'pay.php';
    if (!logged_in()) { ?>
        <p>You are Not Logged in - Log in first</p>
        <form method="POST" action="login.php">
            <button type='submit' id='logIn'>Login</button>
        </form>

    <?php } else { ?>


        <table id="cartTable">
            <tr>
                <th></th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Items Total</th>
            </tr>

            <?php
            foreach ($_SESSION["shopping_cart"] as $product) {
            ?>
                <tr>
                    <td>
                        <img src='<?= $product["img"] ?>' width="50" height="40" />
                    </td>
                    <td>
                        <?= $product["name"] ?>
                    </td>
                    <td>
                        <?= $product["quantity"] ?>
                    </td>
                    <td>
                        <?php echo "$" . $_SESSION['items_total']; ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="5" align="right">
                    <strong>TOTAL: <?php echo "$" . $_SESSION['total_price']; ?></strong>
                </td>
            </tr>
        </table> 
     <section id="betalningsuppgifter">
        <p>
            Username: <?php echo $_SESSION['username']; ?>
        </p>

        <p>
            Home address: <?php echo get_session_homeAddress(); ?>
        </p>

        <form method="POST" action="receipt.php">
            <label for="cardNumber">Card Number</label>
            <input type="text" name="Card number" required>
            <button type="submit" id="payButton">Pay</button>
            </section>
        </form>



    <?php } ?>
<?php });
