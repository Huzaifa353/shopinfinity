<!DOCTYPE html>
<html>
  <head>
    <title>ShopInfinity | Cart</title>
    <link rel="stylesheet/less" type="text/css" href="less/checkout.less" />
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
        ?>

      <div class="bill">
        <!-- Title -->
        <div class="title">
          Product
          <p>Total</p>
        </div>

        <?php
        $sum = 0;
        $discount = 0;
        foreach($cart as $c)
        {
          $newPrice = ($c['price']*$c['cart_quantity']);
          $sum += $newPrice;
          $discount += round(($c['price'] * $c['discount'] / 100) * $c['cart_quantity']);
        ?>
        <div class="item">

          <div class="description">
            <?php echo $c['product_name'] ?>
          </div>

          <div class="quantity">
              <input type="text" name="name" value="x<?php echo $c['cart_quantity'] ?>">
          </div>

          <div class="total-price">Rs. <?php echo $newPrice ?></div>
        </div>
        <?php
        }
        $total = $sum - $discount;
    ?>

    <div class="item">

      <div class="description" style="font-weight: bold; color:#555;">
        Subtotal
      </div>

      <div class="total-price">Rs. <?php echo $sum ?></div>
    </div>
    <div class="item">

      <div class="description">
        Discount
      </div>

      <div class="total-price">Rs. <?php echo $discount ?></div>
    </div>
    <div class="item" id='total'>

      <div class="description" style="font-weight: bold; color:#555;">
        TOTAL
      </div>

      <div class="total-price">Rs. <?php echo $total ?></div>
    </div>

    <a class="order" href="order.php">PLACE ORDER</a>

  </div>
  <?php
    }
    else {
      echo "<div class='prompt'><a href='login.php'>Login</a> to Checkout</div>";
    }
    include 'footer.php';
    ?>

  </body>
</html>
