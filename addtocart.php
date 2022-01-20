<?php
    include 'config.php';
    session_start();

    if(!isset($_SESSION['login']))
    {
      header("Location: login.php");
    }
    if(!isset($_GET['id']))
    {
      header("Location: index.php");
    }
    $quantity = 1;
    if(isset($_GET['quantity']))
    {
      $quantity = $_GET['quantity'];
    }

    $productid = $_GET['id'];
    $customerid = $_SESSION['cid'];

    $sql = "SELECT * from cart where product_id = {$productid}
    AND customer_id = {$customerid}";

    $cart = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $cart = $cart->fetch_assoc();

    if(!isset($cart))
    {
      $sql = "INSERT into cart(customer_id, product_id, cart_quantity)
      values(
        {$customerid},
        {$productid},
        {$quantity}
      )";
      mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }

    header("Location: ". $_GET['location']);
?>
