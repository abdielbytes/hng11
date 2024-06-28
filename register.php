<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require('db.php');
$error_message = '';

if (isset($_REQUEST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['psw']);
    $password = mysqli_real_escape_string($con, $password);
    $confirm_password = stripslashes($_REQUEST['psw-repeat']);
    $confirm_password = mysqli_real_escape_string($con, $confirm_password);

    if ($password === $confirm_password) {
        $trn_date = date("Y-m-d H:i:s");
        $query = "INSERT INTO `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3>
                  <br/>Click here to <a href='login.php'>Login</a></div>";
        } else {
            $error_message = "There was an error in registration. Please try again.";
        }
    } else {
        $error_message = "Passwords do not match. Please try again.";
    }
}
?>

<form method="post" action="register.php">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        
        <?php if (!empty($error_message)) { ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php } ?>
        
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="What should we call you?" name="username" id="username" value="<?php echo isset($_REQUEST['username']) ? htmlspecialchars($_REQUEST['username']) : ''; ?>" required>
    
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" id="email" value="<?php echo isset($_REQUEST['email']) ? htmlspecialchars($_REQUEST['email']) : ''; ?>" required>
    
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
    
        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
        <hr>
    
        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn">Register</button>
    </div>
    
    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>
</body>
</html>
