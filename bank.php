
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

<h1>
    Bank form
</h1>
</body>
</html>
<?php

    // Initializing error variables
    $firstnameError = $surnameError = $phoneError = $emailError = $passwordError = $Addresserror = $confirmpasswordError = "";

    // Initializing form values variables
    $firstname = $surname = $phone = $Address = $email = $password = $confirmpassword = "";
    // Regex

    // Validate entries
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Capturing entries
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $Address = $_POST['Address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
    
    }
        # validating firstname
        if(empty($firstname)) {
            $firstnameError = 'Firstname is required';
        }

        # validating surname
        if(empty($surname)) {
            $surnameError = 'Surname is required';
        }

        # validating phone number
        if(empty($phone)) {
            $phoneError = 'Phone number is required';
        }
        // validating address
        if(empty($Address)){
            $Addresserror = 'Address is required';
        }

        # validating email address
        if(empty($email)) {
            $emailError = 'Email Address is required';
        }

        # validating password
        if(empty($password) || empty($cpassword)) {
            $passwordError = 'Password is required';
        } else if ($password != $cpassword) {
            $passwordError = "Passwords don't match";
        }
        if(!preg_match('/^0[789][01]\d{8}$/', $phone)){
            echo "$phone is a valid phone Number";
        } else {
            $phone = "phone is a Invalid";
        }
        
?>
<h1>Register Here</h1>
<form action="" method="post">
    <input type="text" name="firstname" placeholder="Firstname" value="<?= $firstname ?>"/>
    <span> <?= $firstnameError ?> </span>
    <input type="text" name="surname" placeholder="Surname" value="<?= $surname ?>"/>
    <span> <?= $surnameError ?> </span>
<input type="text" name="Address" placeholder="Address" value="<?= $Address?>"/>
    <span> <?= $Addresserror ?> </span>
    <input type="tel" name="phone" placeholder="Phone Number" value="<?= $phone ?>"/>
    <span> <?= $phoneError ?> </span>
    <input type="email" name="email" placeholder="Email Address" value="<?= $email ?>"/>
    <span> <?= $emailError ?> </span>
    <input type="password" name="password" placeholder="Password" value="<?= $password ?>"/>
    <span> <?= $passwordError ?> </span>
    <input type="password" name="confirmpassword" placeholder="Confirm Password" value="<?= $cpassword ?>"/>
    <span> <?= $passwordError ?> </span>
    <button type="submit">Log in</button>
</form>