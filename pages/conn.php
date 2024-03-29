<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "coexam_db";
$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  
}


 ?>