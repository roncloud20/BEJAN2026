<?php
    $pagetitle = 'Instrumentalist Registration';
   require_once 'assets/header.php';
?>

<link rel="stylesheet" href="instrument.css">

<h1>Instrumentalist Registration</h1>

<form action="" method="post">
    
    <label>First Name</label>
    <input type="text" name="firstname" placeholder="Enter first name" value="<?php echo $firstname ?? ''; ?>">
    
    <label>Surname</label>
    <input type="text" name="surname" placeholder="Enter surname" value="<?php echo $surname ?? ''; ?>">
    
    <label>Phone Number</label>
    <input type="tel" name="phone" placeholder="Enter phone number" value="<?php echo $phone ?? ''; ?>">
    
    <label>Email Address</label>
    <input type="email" name="email" placeholder="Enter email" value="<?php echo $email ?? ''; ?>">
    
    <br>
    <div class="checkbox-group">
        <label>Select Your Instrument(s)</label><br>
        <input type="checkbox" name="instruments[]" value="Piano"> Piano <br>
        <input type="checkbox" name="instruments[]" value="Guitar"> Guitar <br>
        <input type="checkbox" name="instruments[]" value="Saxophone"> Saxophone <br>
        <input type="checkbox" name="instruments[]" value="Drums"> Drums <br>
        <input type="checkbox" name="instruments[]" value="Trumpet"> Trumpet <br>
    </div>
    
    <br>
    <button type="submit" name="register">Register</button>
    
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $firstname = $_POST['firstname'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $instruments = $_POST['instruments'] ?? [];
    
    // Check if all fields are filled
    if(empty($firstname)) {
        $error = 'Please enter your first name';
    } else if(empty($surname)) {
        $error = 'Please enter your surname';
    } else if(empty($phone)) {
        $error = 'Please enter your phone number';
    } else if(empty($email)) {
        $error = 'Please enter your email address';
    } else if(empty($instruments)) {
        $error = 'Please select at least one instrument';
    } else {
        // All fields are good
        
        // Make instruments list
        $instrument_text = '';
        $instrument_count = count($instruments);
        if($instrument_count > 0) {
            foreach($instruments as $inst) {
                if($instrument_text != '') {
                    $instrument_text .= ', ';
                }
                $instrument_text .= $inst;
            }
        }
        
        // Find teachers for each selected instrument
        $teachers_list = '';
        foreach($instruments as $inst) {
            if($inst == "Piano") {
                $teachers_list .= "<div class='teacher-item'>Piano - Mr Adebayo (Keyboard Class)</div>";
            } else if($inst == "Guitar") {
                $teachers_list .= "<div class='teacher-item'>Guitar - Mr John (String Class)</div>";
            } else if($inst == "Drums") {
                $teachers_list .= "<div class='teacher-item'>Drums - Mr Tunde (Percussion Class)</div>";
            } else if($inst == "Saxophone") {
                $teachers_list .= "<div class='teacher-item'>Saxophone - Mrs Grace (Wind Class)</div>";
            } else if($inst == "Trumpet") {
                $teachers_list .= "<div class='teacher-item'>Trumpet - Mr Charles (Brass Class)</div>";
            }
        }
        
        // Show success message
        echo "<div class='success-message'>";
        echo "<h3>Registration successful!</h3>";
        echo "<div class='info-section'>";
        echo "<p><strong>Name:</strong> $firstname $surname</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Instruments:</strong> $instrument_text</p>";
        echo "</div>";
        
        if($teachers_list != '') {
            echo "<div class='teacher-list'>";
            echo "<h4>Your Teachers:</h4>";
            echo $teachers_list;
            echo "</div>";
        }
        
        echo "<p><strong>Status:</strong> Awaiting admin approval</p>";
        echo "</div>";
        
        $message = "success";
    }
    
    // Show error if any
    if(!empty($error)) {
        echo "<div class='error-message'>";
        echo $error;
        echo "</div>";
    }
}
?>

</body>
</html>