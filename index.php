<!DOCTYPE html>
<html>
  <head>
    <title>ShopInfinity. Find it, Love it, Buy it.</title>
    <link rel="stylesheet/less" type="text/css" href="less/style.less" />
    <script>
      if(location.href == 'http://localhost/shopinfinity/index.php')
        window.location.assign("/shopinfinity/");
    </script>
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
  </head>

  <body>
    <?php
      include 'header.php';
      $sql = "SELECT * from products p
      INNER JOIN categories c
      on p.category_id = c.category_id
      INNER JOIN sellers s
      on p.seller_id = s.seller_id";
      $products = mysqli_query($conn, $sql) or die($conn);
    ?>

    <div id="promo-banner">
      <img id="promo-img" src="resources/promo1.jpg">
    </div>

    <div id="new">
      <h2>New Products</h2>
      <div class="cardFlow">
        <div class="right" onclick="moveRight('new')">
          <?php include  'rightArrow.php' ?>
        </div>
          <div class="left" onclick="moveLeft('new')">
            <?php include  'leftArrow.php' ?>
          </div>
        <?php
          $count = 0;
          foreach($products as $product)
          {
            include 'productCard.php';
            $count++;
            if($count >= 6)
              break;
          }
        ?>
      </div>
    </div>

    <div id="sale">
      <h2>Epic Discount Offers</h2>
      <div class="cardFlow">
        <div class="right" onclick="moveRight('new')">
          <?php include  'rightArrow.php'; ?>
        </div>
          <div class="left" onclick="moveLeft('new')">
            <?php include  'leftArrow.php'; ?>
          </div>
          <?php
          $count = 0;
          foreach($products as $product)
          {
            if($product['discount'] > 0)
            {
              include 'productCard.php';
              $count++;
            }
            if($count >= 10)
              break;
          }
          ?>
        </div>
      </div>
    </div>

    <?php include 'footer.php'; ?>
    <script>
      document.getElementById("index").style.borderBottom = "5px solid #F15822";
    </script>
  </body>

</html>
