<!DOCTYPE html>
<html>
  <head>
    <title>ShopInfinity | Cart</title>
    <link rel="stylesheet/less" type="text/css" href="less/transactions.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
  </head>

  <body>
    <?php
      include 'header.php';
      if($login)
      {
        $sql = "SELECT * from transactions t INNER JOIN products p on t.product_id = p.product_id
        where t.customer_id = {$_SESSION['cid']}";
        $transaction = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    ?>

    <div id="transactions">
      <!-- Title -->
      <div class="title" style="border-bottom: none;">
        Transactions
      </div>
      <div class="title">
        <p style="margin-left: 0px;">Product</p>
        <p style="margin-left: 320px;">Date Ordered</p>
        <p style="margin-left: 40px;">Quantity</p>
        <h6 style="margin-left: 80px;">Total</h6>
      </div>

      <!-- Product -->
      <?php
        $sum = 0;
        foreach($transaction as $t)
        {
          $price = round($t['price'] - ($t['price'] * $t['discount'] / 100));
          $newPrice = ($price*$t['transaction_quantity']);
      ?>
      <div class="item">

        <div class="image">
          <img src="product-images/<?php echo $t['product_image'] ?>" alt="" />
        </div>

        <div class="description">
          <?php echo $t['product_name'] ?>
        </div>

        <div class="order-date"><?php echo date_format(date_create($t['order_date']), 'F d, Y') ?></div>

        <div class="quantity">
            <?php echo $t['transaction_quantity'] ?>
        </div>

        <div class="total-price">Rs. <?php echo $newPrice ?></div>
      </div>
      <?php
        }
      ?>
    </div>

    <?php
      }
      else {
        echo "<div class='prompt'><a href='login.php'>Login</a> to View Your Transactions</div>";
      }
    ?>

    <?php include 'footer.php'; ?>

  </body>
</html>
