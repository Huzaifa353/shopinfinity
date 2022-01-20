<!DOCTYPE html>
<html>
  <head>
    <title>ShopInfinity | Cart</title>
    <link rel="stylesheet/less" type="text/css" href="less/style.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
  </head>

  <body>
    <?php
      include 'header.php';

      if($login)
      {
        $sql = "SELECT * from cart NATURAL JOIN products
        where customer_id = {$_SESSION['cid']}";
        $cart = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $sum = 0;
        $discount = 0;
        foreach($cart as $c)
        {
          $newPrice = ($c['price']*$c['cart_quantity']);
          $sum += $newPrice;
          $discount += round(($c['price'] * $c['discount'] / 100) * $c['cart_quantity']);
        }
        $total = $sum - $discount;

        if($total > $balance)
        {
            echo "<div class='prompt'>Not Enough Balance</div>";
        }
        else {
          foreach($cart as $c)
          {
            $sql = "INSERT into transactions
            (customer_id, product_id, transaction_quantity) values(
              {$_SESSION['cid']},
              {$c['product_id']},
              {$c['cart_quantity']}
            )";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));

            $sql = "UPDATE products set quantity = quantity - {$c['cart_quantity']}
            where product_id = {$c['product_id']}";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));

          }
          $sql = "DELETE from cart where customer_id = {$_SESSION['cid']}";
          mysqli_query($conn, $sql) or die(mysqli_error($conn));

          $balance = $balance - $total;

          $sql = "UPDATE customers set balance = {$balance}
          where customer_id = {$_SESSION['cid']}";
          mysqli_query($conn, $sql) or die(mysqli_error($conn));

          echo "<div class='prompt'>Order Placed Succesfully</div>";
        }
      }
      else {
        echo "<div class='prompt'><a href='login.php'>Login</a> to Place Order</div>";
      }
    ?>
    <?php include 'footer.php'; ?>

  </body>
</html>
