<div class="productCard">
  <a href="productView.php?id=<?php echo $product['product_id'] ?>">
    <div class="el-wrapper">
      <div class="box-up">
        <img class="img"
        src="product-images/<?php echo $product['product_image']; ?>"
        alt="Picture not Available">
        <div class="img-info">
          <div class="info-inner">
            <span class="p-name"><?php echo $product['product_name']; ?></span>
            <span class="p-company"><?php echo $product['company_name']; ?></span>
          </div>
          <div class="a-info">
            Click for more details
          </div>
        </div>
      </div>

      <div class="box-down">
        <div class="h-bg">
          <div class="h-bg-inner"></div>
        </div>

        <a class="cart"
        href="addtocart.php?
        id=<?php echo $product['product_id'] ?>
        &location=<?php echo getURL() ?>">
          <div class="price">
            <?php
              if( $product['discount'] > 0)
              {
                $newprice = round($product['price'] - ($product['price'] * $product['discount'] / 100));
                echo "<div>Rs. {$newprice}</div>
                <div class='cut-text'>
                  Rs. {$product['price']}
                </div>
                ";
              }
              else {
                echo "<div class='new-price'>Rs. {$product['price']}</div>";
              }
            ?>
          </div>
          <span class="add-to-cart" >
            <span class="txt">Add to Cart</span>
          </span>
        </a>
      </div>
    </div>
  </a>
</div>
