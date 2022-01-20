<?php
  include "config.php";
  if(isset($_POST['quantity']))
  {
    session_start();

    $sql = "SELECT cart_quantity, quantity from cart c INNER JOIN products p
    on c.product_id = p.product_id where c.customer_id='{$_SESSION['cid']}'
    AND p.product_id='{$_POST['pid']}'";

    $q = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $q = $q->fetch_assoc();
    if($q['cart_quantity'] == $_POST['name'])
    {
      if(($_POST['quantity'] == '+' || $_POST['name'] > 1) &&
      ($q['quantity'] > $q['cart_quantity'] || $_POST['quantity'] == '-'))
      {
        $sql = "UPDATE cart set cart_quantity = cart_quantity {$_POST['quantity']} 1
        where customer_id='{$_SESSION['cid']}' AND product_id='{$_POST['pid']}'";
      }
    }
    else if($_POST['name'] > 0)
    {
      $quantity = $_POST['name'];
      if($q['quantity'] < $_POST['name'])
      {
        $quantity = $q['quantity'];
      }
      $sql = "UPDATE cart set cart_quantity = {$quantity}
      where customer_id='{$_SESSION['cid']}' AND product_id='{$_POST['pid']}'";
    }
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
  }
  header("Location: cart.php");
?>
