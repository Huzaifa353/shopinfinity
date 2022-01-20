<?php
  include 'config.php';
  $username = "";
  $welcome = "Welcome to ShopInfinity";
  $login = false;
  session_start();
  if(isset($_SESSION['login']) && $_SESSION['usertype'] == 'customer')
  {
    $username = $_SESSION["username"];
    $welcome = 'Welcome ' . $_SESSION['fname'] . ' ' . $_SESSION['lname'];

    $sql = "SELECT balance from customers where customer_id = {$_SESSION['cid']}";
    $balance = mysqli_query($conn, $sql) or die($conn);
    $balance = $balance->fetch_assoc();
    $balance = $balance['balance'];
    $login = true;
  }

  $sql = "SELECT * from categories";
  $categories = mysqli_query($conn, $sql) or die($conn);
?>
<header>
  <div id="top">
    <div id="left">

      <div id="welcome">
        <?php echo $welcome; ?>
      </div>
      <?php
      if($login)
      {
        echo "<div id='username'>
          {$username}
        </div>";
      }
    ?>
    </div>

    <div id='right'>
    <?php
    if(!$login)
    {
      echo "
      <a id='login' href='login.php'>
        Login
      </a>
      <a id='signup' href='registerSelect.php'>
        Sign Up
      </a>";
    }
    else {
      echo "<a id='logout' href='logout.php'>
        Logout
      </a>";
    }
  ?></div>
</div>

  <div id="mid">
    <div id="logo">
      <img src="resources/Logo.png" alt="Company Logo">
    </div>
    <form id="search" action="shop.php" method="get">
      <input type="text" placeholder="What do you need?" name="search">
      <button name="go" id="go">
          <?php include 'search-icon.php'; ?>
      </button>
    </form>
    <div id="wallet">
      <?php
        if($login)
          echo "Rs. {$balance}";
      ?>
    </div>
  </div>

  <nav id="navMenu">
    <div id="category" onmouseover="showCategory()" onmouseout="hideCategory()">
      <div id="category-btn">
        <span id="text">Categories</span>
      <?php include 'dropDownArrow.php'; ?>
    </div>
      <div id="category-content">
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
    </div>
    <ul>
      <li><a href="index.php" id="index">Home</a></li>
      <li><a href="shop.php">Shop</a></li>
      <li><a href="cart.php">Cart</a></li>
      <li><a href="transactions.php">Transactions</a></li>
    </ul>
  </nav>
</header>
