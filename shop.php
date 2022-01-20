<!DOCTYPE html>
<html>
  <head>
    <title>ShopInfinity | Shop</title>
    <link rel="stylesheet/less" type="text/css" href="less/style.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
  </head>

  <body>
    <?php
      include 'header.php';
      $info = '';
      if(isset($_GET['search']))
      {
        $search = $_GET['search'];
        $sql = "SELECT * from products p
        INNER JOIN categories c
        on p.category_id = c.category_id
        INNER JOIN sellers s
        on p.seller_id = s.seller_id
        where product_name LIKE '% {$search}%'
        or product_name LIKE '%{$search} %'
        or product_name = '{$search}'
        or company_name LIKE '% {$search}%'
        or company_name LIKE '%{$search} %'
        or company_name = '{$search}'
        ";
        $info = '&nbsp;&nbsp;>> &nbsp;&nbsp; Search: '.$search;
      }
      else {
        $sql = "SELECT * from products p
        INNER JOIN categories c
        on p.category_id = c.category_id
        INNER JOIN sellers s
        on p.seller_id = s.seller_id";
      }
      if(isset($_GET['sortby']))
      {
        $sql = $sql . " ORDER BY {$_GET['sortby']}";
        $info = '&nbsp;&nbsp;>> &nbsp;&nbsp; Sort';
      }

      $products = mysqli_query($conn, $sql) or die($conn);
    ?>

    <div id="pageTitle">
      Shop <?php echo $info ?>
    </div>
    <div id="shopMain">
      <div id="left">

        <div class="options">
          <h3>
          Category
          </h3>
          <a href="shop.php">All</a>
          <?php
            foreach($categories as $category)
            {
              if(isset($_GET['category']) && $category['category_id'] == $_GET['category'])
                $selected =  ' id="selected"';
              else $selected = '';
              echo "<a href='shop.php?category={$category['category_id']}' {$selected}>
              {$category['category_name']}</a>";
            }
          ?>
        </div>
        <div class="options" id="sort">
        <h3>
          Sort By
        </h3>
          <h4>PRICE</h4>
          <a href='shop.php?sortby=price asc'>
          Ascending</a>
          <a href='shop.php?sortby=price desc'>
          Descending</a>
          <h4>DATE ADDED</h4>
          <a href='shop.php?sortby=date_added desc'>
          Latest First</a>
          <a href='shop.php?sortby=date_added asc'>
          Oldest First</a>
        </div>
      </div>
      <div id="right">
        <?php
          foreach($products as $product)
          {
            if(!isset($_GET['category']) || $_GET['category'] == $product['category_id'])
            {
              include 'productCard.php';
            }
          }
         ?>
      </div>
    </div>

      <?php include 'footer.php'; ?>
  </body>

</html>
