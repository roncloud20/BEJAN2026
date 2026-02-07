<style>
    <?php include_once 'tetiary.css' ?>
</style>
<?php
$pagetitle = "Tertiary Admission";
require_once 'assets/header.php';

$surname = $firstname = $othername = $email = $phone = $gender = $dob = $stateoforigin = $lga = $address = $course = "";

$surnameError = $firstnameError = $othernameError = $emailError = $phoneError = $genderError = $dobError = $stateoforiginError = $lgaError = $addressError = $courseError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = $_POST['surname'];
    $firstname = $_POST['firstname'];
    $othername = $_POST['othername'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $stateoforigin = $_POST['stateoforigin'];
    $lga = $_POST['lga'];
    $address = $_POST['address'];
    $course = $_POST['course'];

    if (empty($surname)) {
        $surnameError = "Surname is required";
    }

    if (empty($firstname)) {
        $firstnameError = "Firstname is required";
    }

    if (empty($othername)) {
        $othernameError = "Othername is required";
    }
    if (empty($email)) {
        $emailError = "Email is required";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $emailError = 'Invalid Email';
    }

    if (empty($phone)) {
        $phoneError = "Phone number is required";
    } elseif(!preg_match('/^(?:\+234|234|0)(?:70|80|81|90|91|80|71|1)\d{8}$/',$phone)) {
        $phoneError = 'Invaid Phone Number';
    }

    if (empty($gender)) {
        $genderError = "Gender is required";
    }

    if (empty($dob)) {
        $dobError = "Date of birth is required";
    } else{
        $dob = $_POST['dob'];
        $birthday = new DateTime($dob);
        $today = new DateTime();
        $age = $today->diff($birthday)->y;

        if ($age < 16) {
            $dobError = "You must be at least 16 years old to apply.";
        }
    }

    if (empty($stateoforigin)) {
        $stateoforiginError = "State of origin is required";
    }

    if (empty($lga)) {
        $lgaError = "LGA is required";
    }

    if (empty($address)) {
        $addressError = "Address is required";
    }

    if (empty($course)) {
        $courseError = "Course of study is required";
    }
}

?>
<h1 class="title">Apply for Tertiary Admission</h1>

<form action="" method="post">
    <div class="personal_info" style="display:flex; flex-direction: column; gap: 5px;">
        <div class="input">
            <input type="text" name="surname" placeholder="Surname" value="<?= $surname ?>" />
            <span> <?= $surnameError ?> </span>
        </div>
        <div class="input">
            <input type="text" name="firstname" placeholder="First Name" value="<?= $firstname ?>" />
            <span> <?= $firstnameError ?> </span>
        </div>
        <div class="input">
            <input type="text" name="othername" placeholder="Other name(s)" value="<?= $othername ?>" />
            <span> <?= $othernameError ?> </span>
        </div>
        <div class="input">
            <input type="email" name="email" placeholder="Email Address" value="<?= $email ?>" />
            <span> <?= $emailError ?> </span>
        </div>
        <div class="input">
            <input type="text" placeholder="State of origin" value="<?= $stateoforigin ?>" name="stateoforigin">
            <span><?= $stateoforiginError ?></span>
        </div>
        <div class="input">
            <input type="tel" name="phone" placeholder="Phone Number" value="<?= $phone ?>" />
            <span> <?= $phoneError ?> </span>
        </div>
        <div class="input">
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <span><?= $genderError ?></span>
        </div>
        <div class="input">
            <input type="date" name="dob" value="<?= $dob ?>">
            <span><?= $dobError ?></span>
        </div>
    </div>

    <div class="school_info" style="display:flex; flex-direction: column; gap: 5px;">
        <div class="input">
            <input type="text" name="course" placeholder="Course of Study" value="<?= $course ?>">
            <span><?= $courseError ?></span>
        </div>
        <div class="input">
            <input type="text" name="lga" placeholder="Local Government Area" value="<?= $lga ?>">
            <span><?= $lgaError ?></span>
        </div>
        <div class="input">
            <textarea name="address" placeholder="Address"><?= $address ?></textarea>
            <span><?= $addressError ?></span>
        </div>
    </div>
    <input type="submit" value="Apply">
</form>