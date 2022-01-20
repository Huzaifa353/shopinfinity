<!DOCTYPE html>
<html>
  <head>
    <title>Product Description</title>
    <link rel="stylesheet/less" href="less/productView.less">
    <link rel="stylesheet/less" type="text/css" href="less/productView.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
	</head>

  <body>
    <?php
      include "header.php";

      if(isset($_GET['id']))
      {
        $sql = "SELECT * from products p NATURAL JOIN categories c
        where product_id = {$_GET['id']}";

        $product = mysqli_query($conn, $sql) or die($conn);
        $product = $product->fetch_assoc();
      }
    ?>
    <div class = "wrapper">
      <div class = "card">
            <div class = "img-showcase">

              <img src = "product-images/<?php echo $product['product_image'] ?>"
              alt = "Image Not Found">
            </div>
        </div>
         <div class = "content">
          <h2 class = "title"><?php echo $product['product_name'] ?></h2>

          <?php
            if($product['discount'] > 0)
            {
          ?>
          <div class = "price">
            <p class = "price">Old Price:
              <span class='cut-text'>Rs. <?php echo $product['price'] ?></span></p>
          </div>
          <div class = "price">
            <p class = "new-price"><b> New Price: </b>
              <span>Rs. <?php
               echo round($product['price'] - ($product['price'] * $product['discount']/100));
               ?></span></p>
          </div>
          <div class = "price">
            <p class = "new-price"><b> You Save: </b>
              <span>Rs. <?php
               echo round($product['price'] * $product['discount']/100);
               ?> <?php echo "({$product['discount']}%)" ?></span></p>
          </div>
          <?php
            }
            else {
              ?>
              <div class = "price">
                <p class = "new-price" style="margin: 30px 0 20px 0;"><b> Price: </b>
                  <span>Rs. <?php
                   echo $product['price'];
                   ?></span></p>
              </div>
              <?php
            }
          ?>

          <div class = "detail">
            <h2>PRODUCT DESCRIPTION </h2>
            <p><?php echo nl2br($product['product_description']) ?></p>

          <form class = "purchase-info"
          action="addtocart.php"
          method="get">
            <input type="hidden" name="location" value="index.php">
            <input type = "number" name="quantity" min = "1" value = "1"
            max ="<?php echo $product['quantity']?>" required>
            <button name="id" value="<?php echo $product['product_id'] ?>"
              type ="submit" class ="btn">
              Add to Cart <i class = "fas fa-shopping-cart"></i>
          </form>
        </div>
      </div>
    </div>

    <?php
      include "footer.php";
    ?>
  </body>
</html>
