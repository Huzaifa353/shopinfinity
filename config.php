<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "shopinfinity";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn)
{
  die("Connection failed: ". mysqli_connect_error());
}

function getURL()
{
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
         $url = "https://";
    else
         $url = "http://";

    $url.= $_SERVER['HTTP_HOST'];

    $url.= $_SERVER['REQUEST_URI'];

    return $url;
}
 ?>
