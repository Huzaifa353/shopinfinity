<?php
  include "config.php";
  if(isset($_GET['id']))
  {
    session_start();

    $sql = "DELETE from cart
    where customer_id = {$_SESSION['cid']} AND product_id = {$_GET['id']}";

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
  }
  header("Location: cart.php");
?>
