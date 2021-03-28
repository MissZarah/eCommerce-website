<?php

require_once('helpers.php');

session_start();

template('Shoppingbag', 'Shoppingbag', function () {
    $_SESSION['prevPage'] = 'cart.php';
    $status = "";
    if (isset($_POST['action']) && $_POST['action'] == "remove") {
        if (!empty($_SESSION["shopping_cart"])) {
            foreach ($_SESSION["shopping_cart"] as $key => $value) {
                if ($_POST["removeProduct"] == $key) {
                    unset($_SESSION["shopping_cart"][$key]);
                    $status = "<div style='color:red;'>
                     Product is removed from your cart!</div>";
                }
                if (empty($_SESSION["shopping_cart"]))
                    unset($_SESSION["shopping_cart"]);
            }
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == "change") {
        foreach ($_SESSION["shopping_cart"] as &$value) {
            if ($value['id'] == $_POST["addMore"]) {
                $value['quantity'] = $_POST["quantity"];
                break;
            }
        }
    } ?>

    <div id="cart">
        <?php
        if (isset($_SESSION["shopping_cart"])) {
            $_SESSION["total_price"] = 0;
        ?>

            <table id="cartTable">
                <tr>
                    <th></th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Items Total</th>
                </tr>

                <?php
                foreach ($_SESSION["shopping_cart"] as $product) {
                ?>
                    <tr>
                        <td>
                            <img src='<?= $product["img"] ?>' width="50" height="40" />
                        </td>
                        <td><?= $product["name"] ?>
                            <form method='POST' action=''>
                                <input type='hidden' name='action' value="remove" />
                                <input type='hidden' name='removeProduct' value="<?= $product["id"] ?>" />
                                <button type='submit' id='removeButton'>Remove Item</button>
                            </form>
                        </td>
                        <td>
                            <form method='POST' action=''>
                                <input type='hidden' name='addMore' value="<?= $product["id"] ?>" />
                                <input type='hidden' name='action' value="change" />
                                <select name='quantity' class='quantity' onChange="this.form.submit()">
                                    <option <?php if ($product["quantity"] == 1) echo "selected"; ?> value="1">1</option>
                                    <option <?php if ($product["quantity"] == 2) echo "selected"; ?> value="2">2</option>
                                    <option <?php if ($product["quantity"] == 3) echo "selected"; ?> value="3">3</option>
                                    <option <?php if ($product["quantity"] == 4) echo "selected"; ?> value="4">4</option>
                                    <option <?php if ($product["quantity"] == 5) echo "selected"; ?> value="5">5</option>
                                </select>
                            </form>
                        </td>
                        <td><?php echo "$" . $product["price"]; ?></td>
                        <td>
                            <?php
                            $_SESSION["items_total"] = $product["price"] * $product["quantity"];
                            echo "$" . $_SESSION["items_total"] ?>
                        </td>
                    </tr>
                <?php
                    $_SESSION["total_price"] += ($product["price"] * $product["quantity"]);
                }
                ?>
                <tr>
                    <td colspan="5" align="right">
                        <strong>TOTAL: <?php echo "$" . $_SESSION["total_price"]; ?></strong>
                    </td>
                </tr>
            </table>
            <form method="POST" action="pay.php">
                <button type='submit' id='checkOutButton'>Checkout</button>
            </form>
        <?php
        } else {
            echo "<h3>Your cart is empty!</h3>";
        } ?>
        <div class="messageBox">
            <?php echo $status; ?>
        </div>
    </div>
<?php });
