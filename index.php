<?php

require_once 'helpers.php';

session_start();

template('LTH Affordables', 'Home', function () {
  $_SESSION['prevPage'] = 'index.php';
  $db = create_mysqli();
  $result = $db->query('SELECT * FROM products');
?>
  <div class="row" id="items">
    <?php while ($row = $result->fetch_assoc()) : ?>
      <div class="large-3 small-5 columns">
        <form method='post' action=''>
            <input type="hidden" name="csrf" value="<?= get_session_token() ?>">
          <input type='hidden' name='productCode' value="<?= $row['productCode'] ?>">
          <img src=<?= $row['img'] ?>>
          <div class="panel">
            <h5><?= $row['name'] ?></h5>
            <h6 class="subheader">$<?= $row['price'] ?></h6>
            <button type="submit" id="buyButton">Buy</button>
          </div>
        </form>
      </div>
    <?php endwhile;
    ?>
  </div>

  <?php
  $status = "";
  if (isset($_POST['productCode']) && $_POST['productCode'] != "") {

      if (logged_in() && detected_csrf($_POST['csrf'])) {
          die('CSRF prevented!');
      }

    $productCode = $_POST['productCode'];
    $shoppingResult = $db->query("SELECT * FROM products where productCode='$productCode'");

    $row = $shoppingResult->fetch_assoc();
    $productCode = $row['productCode'];
    $name = $row['name'];
    $price = $row['price'];
    $img = $row['img'];

    $cartArray = array(
      $productCode => array(
        'name' => $name,
        'id' => $productCode,
        'price' => $price,
        'quantity' => 1,
        'img' => $img
      )
    );
    if (empty($_SESSION["shopping_cart"])) {
      $_SESSION["shopping_cart"] = $cartArray;
      $status = "<div>Product is added to your cart!</div>";
    } else {
      $keys = array_keys($_SESSION["shopping_cart"]);
      if (in_array($productCode, $keys)) {
        $status = "<div style='color:red;'>
             Product is already added to your cart!</div>";
      } else {
        $_SESSION["shopping_cart"] = array_merge(
          $_SESSION["shopping_cart"],
          $cartArray
        );
        $status = "<div>Product is added to your cart!</div>";
      }
    }
  } ?>

  <div class="messageGreen">
    <?php echo $status; ?>
  </div>

<?php });
