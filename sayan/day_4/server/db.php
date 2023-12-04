<?php
$servername='localhost';
$user='root';
$password='';
$table='todos';

$conn=mysqli_connect($servername,$user,$password,$table);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
//   echo "Connected successfully";
?>
