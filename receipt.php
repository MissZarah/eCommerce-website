<?php

require_once 'helpers.php';

session_start();

template('Receipt', 'Receipt', function () { ?>
   
   
    <h2 id="längstupp"><b>Thank you for your order <?php echo $_SESSION['username'];?> !</b> <p> Your order has been placed and will soon be sent </p></h2>
   <section>
            <h4 id=rubrik1>YOUR DETAILS: </h4>

       <p id="översikt">
           <span> Name: <?php echo $_SESSION['username']?></span>
           <span>Home address: <?php echo $_SESSION['homeAddress']?> </span>
           <span>Payment method: Kort </span>
           <span>Received amount: <?php echo $_SESSION['total_price']; echo ' $' ?></span>
       </p>
   </section>


   <section>
       <article>
           <h4 id="rubrik1"> YOUR ORDER: </h4>
           <table id="cartTable">
               <tr>
                   <td></td>
                   <td>Item Name</td>
                   <td>Quantity</td>
                   <td>Items Total</td>
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
       </article>
   </section>

<?php   $_SESSION["shopping_cart"] = null;
        $_SESSION['total_price'] = null;
        $_SESSION['items_total'] =null;

});