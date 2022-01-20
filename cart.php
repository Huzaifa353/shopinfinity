<!DOCTYPE html>
<html>
  <head>
    <title>ShopInfinity | Cart</title>
    <link rel="stylesheet/less" type="text/css" href="less/cart.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
  </head>

  <body>
    <?php
      include 'header.php';
      if($login)
      {
        $sql = "SELECT * from cart c INNER JOIN products p on c.product_id = p.product_id
        where c.customer_id = {$_SESSION['cid']}";
        $cart = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if(empty($cart->fetch_assoc()))
        {
          echo "<div class='prompt'>No Items in the Cart</div>";
        }
        else {
    ?>

    <div class="shopping-cart">
      <!-- Title -->
      <div class="title">
        Shopping Cart
        <p>Total</p>
      </div>

      <!-- Product -->
      <?php
        $sum = 0;
        foreach($cart as $c)
        {
          $price = round($c['price'] - ($c['price'] * $c['discount'] / 100));
          $newPrice = ($price*$c['cart_quantity']);
          $sum += $newPrice;
      ?>
      <div class="item">
        <div class="buttons">
          <a class="delete-btn"
          href="deleteCart.php?id=<?php echo $c['product_id']; ?>"></a>
        </div>

        <div class="image">
          <img src="product-images/<?php echo $c['product_image'] ?>" alt="" />
        </div>

        <div class="description">
          <?php echo $c['product_name'] ?>
        </div>

        <div class="price">Rs. <?php echo $price ?></div>

        <form class="quantity" action="changeQuantity.php" method="post">
            <button class="minus-btn" type="submit" name="quantity" value="-">
              <img src="resources/minus.png" alt="" />
            </button>
            <input type="text" name="name" value="<?php echo $c['cart_quantity'] ?>">
            <input type="hidden" name="pid" value="<?php echo $c['product_id'] ?>">
            <button class="plus-btn" type="submit" name="quantity" value="+">
              <img src="resources/plus.png" alt="" />
            </button>
        </form>

        <div class="total-price">Rs. <?php echo $newPrice ?></div>
      </div>
      <?php
        }
        echo "<div id='cart-total'>
        <div class='text'>TOTAL</div>
        <div class='final-price'>Rs. {$sum}</div></div>";
      ?>
    </div>

    <a class="checkout" href="checkout.php">Proceed to Checkout</a>

    <?php
        }
      }
      else {
        echo "<div class='prompt'><a href='login.php'>Login</a> to View Cart</div>";
      }
    ?>

    <?php include 'footer.php'; ?>

  </body>
</html>
