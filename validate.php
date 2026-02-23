<?php
if($_SERVER['REQUEST_METHOD'] == "post"){
echo "<br/>";
$num1 = $_POST['num1'];
$num2 = $_POST['num2'];

// validating num1 and num2
if(empty($num1)) {
   exit('First entry has no value');
}
if(empty($num2)) {
    exit('Second entry has no value');
}
$ans = $num1 + $num2;
echo $ans;
}
?>