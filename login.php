<!DOCTYPE html>
<?php
  include 'config.php';
?>
<html>
  <head>
    <title>ShopInfinity. Find it, Love it, Buy it.</title>
    <link rel="stylesheet/less" type="text/css" href="less/login.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
  </head>

  <body>
    <?php
    $error = "";
      if(isset($_POST['submit']))
      {
        $username = htmlentities($_POST['username']);
        $password = hash('sha512', $_POST['password']);
        $usertype = $_POST['usertype'];
        if($usertype == 'customer')
        {
          $sql = "SELECT * from customers where username = '{$username}';";
          $user = mysqli_query($conn, $sql) or die(mysqli_error($conn));
          $user = $user->fetch_assoc();
          if(empty($user))
          {
            $error = "Username does not exist";
          }
          else if($user['password'] != $password)
          {
            $error = "Incorrect Password";
          }
          else
          {
            session_start();
            $_SESSION["cid"] = $user["customer_id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["fname"] = $user["first_name"];
            $_SESSION["lname"] = $user["last_name"];
            $_SESSION["usertype"] = 'customer';
            $_SESSION["login"] = true;
            header("Location: index.php");
          }
        }
        else {
          $sql = "SELECT * from sellers where s_username = '{$username}';";
          $user = mysqli_query($conn, $sql) or die(mysqli_error($conn));
          $user = $user->fetch_assoc();
          if(empty($user))
          {
            $error = "Username does not exist";
          }
          else if($user['s_password'] != $password)
          {
            $error = "Incorrect Password";
          }
          else
          {
            session_start();
            $_SESSION["sid"] = $user["seller_id"];
            $_SESSION["username"] = $user["s_username"];
            $_SESSION["cname"] = $user["company_name"];
            $_SESSION['usertype'] = 'seller';
            $_SESSION["login"] = true;
            header("Location: seller/");
          }
        }
      }
    ?>
    <div class="session">
      <div class="left">
      </div>
      <form action="<?php $_PHP_SELF ?>" class="log-in" method="post">
        <h4><span>LOG IN</span></h4>
        <p>Welcome to ShopInfinity! </p>
        <div class="floating-label">
          <input placeholder="Username" type="text" name="username" id="username" autocomplete="off">
          <label for="username">Username:</label>
          <div class="icon">
  <?xml version="1.0" encoding="UTF-8"?>
  <svg enable-background="new 0 0 100 100" version="1.1" viewBox="0 0 100 100" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
  <style type="text/css">
  	.st0{fill:none;}
  </style>
  <g transform="translate(0 -952.36)">
  	<path d="m17.5 977c-1.3 0-2.4 1.1-2.4 2.4v45.9c0 1.3 1.1 2.4 2.4 2.4h64.9c1.3 0 2.4-1.1 2.4-2.4v-45.9c0-1.3-1.1-2.4-2.4-2.4h-64.9zm2.4 4.8h60.2v1.2l-30.1 22-30.1-22v-1.2zm0 7l28.7 21c0.8 0.6 2 0.6 2.8 0l28.7-21v34.1h-60.2v-34.1z"/>
  </g>
  <rect class="st0" width="100" height="100"/>
  </svg>

          </div>
        </div>
        <div class="floating-label">
          <input placeholder="Password" type="password" name="password" id="password" autocomplete="off">
          <label for="password">Password:</label>
          <div class="icon">

            <?xml version="1.0" encoding="UTF-8"?>
            <svg enable-background="new 0 0 24 24" version="1.1" viewBox="0 0 24 24" xml:space="preserve"              xmlns="http://www.w3.org/2000/svg">
  <style type="text/css">
  	.st0{fill:none;}
  	.st1{fill:#010101;}
  </style>
  		<rect class="st0" width="24" height="24"/>
  		<path class="st1" d="M19,21H5V9h14V21z M6,20h12V10H6V20z"/>
  		<path class="st1" d="M16.5,10h-1V7c0-1.9-1.6-3.5-3.5-3.5S8.5,5.1,8.5,7v3h-1V7c0-2.5,2-4.5,4.5-4.5s4.5,2,4.5,4.5V10z"/>
  		<path class="st1" d="m12 16.5c-0.8 0-1.5-0.7-1.5-1.5s0.7-1.5 1.5-1.5 1.5 0.7 1.5 1.5-0.7 1.5-1.5 1.5zm0-2c-0.3 0-0.5 0.2-0.5 0.5s0.2 0.5 0.5 0.5 0.5-0.2 0.5-0.5-0.2-0.5-0.5-0.5z"/>
  </svg>
          </div>

        </div>
        <?php
  			 if(strlen($error) > 0)
  				 echo "<p style='color: red;font-size: 16px; margin: 20px 0 10px 5px;
           font-weight: bold;'>{$error}</p>";
  			?>

      <div id="toggle">
        <div class="toggle">
      		<input type="radio" name="usertype" value="customer" id="customer" checked>
      		<label for="customer">Customer</label>
      		<input type="radio" name="usertype" value="seller" id="seller">
      		<label for="seller">Seller</label>
      	</div>
      </div>
        <button type="submit" name="submit">Log in</button>
      </form>
    </div>
  </body>

</html>
