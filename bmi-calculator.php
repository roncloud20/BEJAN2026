<?php
$pagetitle = 'Calculate Your Body Mass';

include_once 'assets/header.php';

?>

<?php echo"<h1>BMI CALCULATOR</h1>"?>

<form action="" method="post">
<input type="number" name="weight" id="" placeholder="Enter Weight"> <br>
<input type="number" name="height" id="" placeholder="Enter Height"> <br>
<input type="submit">
</form>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $weight = $_POST['weight'];
  $height = $_POST['height'];

  if(empty($weight)){
    exit('Weight is empty');
  } else if (empty($height)){
    exit ('Height is empty');
  } else {
    $bmi = $weight / ($height * $height);
    echo 'Your Bmi is : ' . round($bmi, 2);
  }
}
?>