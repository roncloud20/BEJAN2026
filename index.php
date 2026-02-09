<?php
$pagetitle = 'Home Page';
require('assets/header.php');
require_once('assets/header.php');

// $statement = "It's a new day with John, James and 3,785 other guys";
// echo preg_match_all('/a{2}/',$statement, $items);
// echo "<pre>";
// print_r($items);
// echo "</pre>";

?>
<h1>RegEx</h1>
<form action="" method="post">
    <input type="text" name="entry"/>
    <input type="submit" />
</form>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $entry = $_POST['entry'];
        if(preg_match('/^0[789][01]\d{8}$/', $entry)){
            echo "$entry is a valid phone Number";
        } else {
            echo "$entry is a Invalid";
        }
    }
?>
