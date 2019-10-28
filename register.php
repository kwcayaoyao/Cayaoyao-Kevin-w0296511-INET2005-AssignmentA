<?php
include('server.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Registration</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LepBb8UAAAAANujZw4Zxg41GNfSzOjIC5hnteq_"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LepBb8UAAAAANujZw4Zxg41GNfSzOjIC5hnteq_', {action: 'homepage'});
        });
    </script>
</head>
<body>

<!-- Form Code Start -->
<form method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password_1" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password_2" required>
        <hr>

        <button type="submit" class="registerbtn" name="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="mainLogin.html">Sign in</a>.</p>
    </div>

    <div class="captcha_wrapper">
        <div class="g-recaptcha" data-sitekey="6LepBb8UAAAAANujZw4Zxg41GNfSzOjIC5hnteq_"></div>
    </div>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->
</body>
</html>