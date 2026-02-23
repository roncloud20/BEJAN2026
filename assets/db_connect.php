<?php 
$conn = mysqli_connect('localhost', 'root', '', 'fittrack_db');

if(!$conn){
  die("Database Error: " . mysqli_error($conn));
}
  ?>