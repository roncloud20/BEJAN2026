<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fitness App</title>
  <link rel="stylesheet" href="fitness.css">

  <?php

  require_once "assets/db_connect.php";

  // Initializing Error Variables

  $fullnameError = $emailError = $ageError = $phoneError = $heightError = $weightError = $goalError = $usernameError = $passwordError = $cpasswordError = $msg = '';

  // Intializing Variables

  $fullname = $email = $age = $phonenumber = $height = $weight = $goal = $username = $password = $cpassword = $successMessage = '';


  // Capturing Data 
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = htmlspecialchars(trim($_POST['fullname']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $age = htmlspecialchars(trim($_POST['age']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $height = htmlspecialchars(trim($_POST['height']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $weight = htmlspecialchars(trim($_POST['weight']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $goal = htmlspecialchars(trim($_POST['goal']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $phonenumber = htmlspecialchars(trim($_POST['phonenumber']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $password = htmlspecialchars(trim($_POST['password']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $cpassword = htmlspecialchars(trim($_POST['cpassword']), ENT_QUOTES | ENT_HTML5, 'UTF-8');



    // Validating Fullname

    if (empty($fullname)) {
      $fullnameError = 'Fullname is required';
    } elseif (!preg_match("/^[a-zA-Z]+ [a-zA-Z]+$/", $fullname)) {
      $fullnameError = "Full name must contain Firstname and Lastname, use letters and spaces only";
    }


    // Validating Email Address

    if (empty($email)) {
      $emailError = "Valid Email Address is required";
    } elseif (!preg_match("/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/", $email)) {
      $emailError = "Invalid email format";
    }

    // Validating Email Address

    if (empty($age)) {
      $ageError = "Age is required";
    } elseif (!preg_match("/^[0-9]+$/", $age)) {
      $ageError = "Age must be a number";
    } elseif ($age < 10 || $age > 100) {
      $ageError = "Age must be between 10 and 100";
    } elseif ($age < 18) {
      $ageError = "Users under 18 require parental consent";
    }

    // Validating Phone Number

    if (empty($_POST['phonenumber'])) {
      $phoneError = "Phone number is required";
    } elseif (!preg_match("/^(070|080|081|090|091)[0-9]{8}$/", $_POST['phonenumber'])) {
      $phoneError = "Enter a valid Nigerian phone number";
    }

    // Validating Height

    if (empty($height)) {
      $heightError = "Height is required";
    } elseif (!preg_match("/^[0-9]+(cm)?$/", $height)) {
      $heightError = "Height must be a number (e.g. 180 or 180cm)";
    }

    // Validating Weight

    if (empty($weight)) {
      $weightError = "Weight is required";
    } elseif (!preg_match("/^[0-9]+(kg)?$/", $weight)) {
      $weightError = "Weight must be a number (e.g. 65 or 65kg)";
    }

    // Validating Goal

    if (empty($goal)) {
      $goalError = "Please select a fitness goal";
    }


    // Validating Username

    if (empty($username)) {
      $usernameError = "Username is required";
    } elseif (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
      $usernameError = "Username must be 3–20 characters (letters & numbers)";
    }


    // Validating Password

    if (empty($password)) {
      $passwordError = "Password is required";
    } elseif (strlen($password) < 8) {
      $passwordError = "Password must be at least 8 characters";
    } else if ($password != $cpassword) {
      $passwordError = $cpasswordError = "Passwords does not match";
    }


    // Validating Confirm Password

    if (empty($cpassword)) {
      $cpasswordError = "Confirm Password is required";
    } elseif (strlen($cpassword) < 8) {
      $cpasswordError = "Password must be at least 8 characters";
    }

    // Success Message

    // if (
    //   empty($fullnameError) &&
    //   empty($emailError) &&
    //   empty($ageError) &&
    //   empty($phoneError) &&
    //   empty($heightError) &&
    //   empty($weightError) &&
    //   empty($goalError) &&
    //   empty($usernameError) &&
    //   empty($passwordError) &&
    //   empty($cpasswordError)
    // ) {
    //   $successMessage = "Registration successful! Welcome to our fitness program 💪";
    // }

    // Populating Database
    if (empty($fullnameError) && empty($emailError) && empty($ageError) && empty($phoneError) && empty($heightError) && empty($weightError) && empty($goalError) && empty($usernameError) && empty($passwordError) && empty($cpasswordError)) {
      $code = rand(100000, 999999);
      $pass = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO `users`(`full_name`, `email`, `phone`, `age`, `height`, `weight`, `goal`, `username`, `password`,`verification_code`) VALUES (?,?,?,?,?,?,?,?,?,?)";

      $stmt = $conn->prepare($query);
      $stmt->bind_param('ssssssssss', $fullname, $email, $phonenumber, $age, $height, $weight, $goal, $username, $pass, $code);

      if ($stmt->execute()) {
        $msg = "Registered Successfully";
      }
    } else {
      $msg = "Registration Unsuccessful";
    }
  }


  ?>

</head>

<body>
  <section class="container">

    <!-- Left Split Section-->
    <div class="left-section">
      <div>
        <h1>Elevate Your Fitness</h1>
        <p>Join our professional fitness program and take control of your
          health with structure training and expert guidance</p>
      </div>
    </div>

    <!-- Right Split Section-->
    <div class="right-section">
      <div class="form-card">
        <h2>Membership Registration</h2>
        <p>Please fill in your details to get started</p>
        <h2 align="center"><?= $msg ?></h2>

        <form action="" method="POST">
          <!-- Full Name -->
          <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" placeholder="John Doe" value="<?= $fullname ?>">
            <span class="error"><?= $fullnameError ?></span>
          </div>
          <!-- Email Address-->
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" placeholder="example@email.com" value="<?= $email ?>">
            <span class="error"><?= $emailError ?></span>
          </div>
          <!-- Age-->
          <div class="form-row">
            <div class="form-group">
              <label for="age">Age</label>
              <input type="number" placeholder="18" name="age" value="<?= $age ?>">
              <span class="error"><?= $ageError ?></span>
            </div>
            <!-- Phone Number-->
            <div class="form-group">
              <label for="phonenumber">Phone Number</label>
              <input type="tel" placeholder="090" name="phonenumber" value="<?= $phonenumber ?>">
              <span class="error"><?= $phoneError ?></span>


            </div>
          </div>
          <!-- Height-->
          <div class="form-row">
            <div class="form-group">
              <label for="height">Height</label>
              <input type="text" placeholder="180cm" name="height" value="<?= $height ?>">
              <span class="error"><?= $heightError ?></span>
            </div>
            <!-- Weight-->
            <div class="form-group">
              <label for="weight">Weight</label>
              <input type="text" placeholder="65kg" name="weight" value="<?= $weight ?>">
              <span class="error"><?= $weightError ?></span>
            </div>
          </div>
          <!-- Goal-->
          <div class="form-group">
            <label for="goal">Fitness Goal</label>
            <select id="goal" name="goal">
              <option value="" <?= $goal == '' ? 'selected' : '' ?>>-- Select goal --</option>
              <option value="lose_weight" <?= $goal == 'lose_weight' ? 'selected' : '' ?>>Lose Weight</option>
              <option value="gain_muscle" <?= $goal == 'gain_muscle' ? 'selected' : '' ?>>Gain Muscle</option>
              <option value="stay_fit" <?= $goal == 'stay_fit' ? 'selected' : '' ?>>Stay Fit</option>
            </select>

            <span class="error"><?= $goalError ?></span>

          </div>
          <!-- Username-->
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" placeholder="Enter Nickname" name="username" value="<?= $username ?>">
            <span class="error"><?= $usernameError ?></span>

          </div>

          <!-- Password-->
          <!-- ACCOUNT SETUP -->

          <div class="form-row">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" placeholder="Password" name="password" value="<?= $password ?>">
              <span class="error"><?= $passwordError ?></span>

            </div>
            <!-- Confirm Password-->
            <div class="form-group">
              <label for="cpassword">Confirm Password</label>
              <input type="password" placeholder="Confirm Password" name="cpassword" value="<?= $cpassword ?>">
              <span class="error"><?= $cpasswordError ?></span>

            </div>
          </div>

          <!-- Success Message-->
          <?php if (!empty($successMessage)) : ?>
            <p style="color: green; font-weight: bold; margin-bottom: 15px;">
              <?= $successMessage ?>
            </p>
          <?php endif; ?>

          <button type="submit">Create Account</button>


        </form>
      </div>
    </div>
  </section>

</body>

</html>