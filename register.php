<?php
    // Adding header
    $pagetitle = "Register";
    require_once "assets/header.php";

    // Initializing error variables
    $firstnameError = $surnameError = $phoneError = $emailError = $passwordError = $cpasswordError = "";

    // Initializing form values variables
    $firstname = $surname = $phone = $email = $password = $cpassword = "";

    // Validate entries
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Capturing entries
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

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
        // # validating confirm password
        // if(empty($cpassword)) {
        //     $cpasswordError = 'Comfirm password is required';
        // }
    }
?>
<h1>Register Here</h1>
<form action="" method="post">
    <input type="text" name="firstname" placeholder="Firstname" value="<?= $firstname ?>"/>
    <span> <?= $firstnameError ?> </span>
    <input type="text" name="surname" placeholder="Surname" value="<?= $surname ?>"/>
    <span> <?= $surnameError ?> </span>
    <input type="tel" name="phone" placeholder="Phone Number" value="<?= $phone ?>"/>
    <span> <?= $phoneError ?> </span>
    <input type="email" name="email" placeholder="Email Address" value="<?= $email ?>"/>
    <span> <?= $emailError ?> </span>
    <input type="password" name="password" placeholder="Password" value="<?= $password ?>"/>
    <span> <?= $passwordError ?> </span>
    <input type="password" name="cpassword" placeholder="Confirm Password" value="<?= $cpassword ?>"/>
    <span> <?= $passwordError ?> </span>
    <button type="submit">Register</button>
</form>