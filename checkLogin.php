<?php
    include('server.php');
    session_start();

    $conn = mysqli_connect("localhost", "Kevin", "Password", "employees");
    if(!$conn){
        die("Unable to connect: ". mysqli_connect_error());
    }

    $username = $_POST['loginUser'];
    $pwd = $_POST['loginPwd'];
    $response = $_POST["g-recaptcha-response"];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => '6LepBb8UAAAAANAfotFIQ0H5L9YEovbqePWVxy_X',
        'response' => $_POST["g-recaptcha-response"]
    );
    $options = array(
        'http' => array (
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success=json_decode($verify);
    if ($captcha_success->success==false) {
        echo "<p>You are a bot! Go away!</p>";
    } else if ($captcha_success->success==true) {
        echo "<p>You are not not a bot!</p>";
    }

    //sanitize our inputs
    $username = stripslashes($username);
    $username = mysqli_real_escape_string($conn, $username);

    $sql = "SELECT * FROM WebUsers WHERE username = '$username'";

    $result = mysqli_query($conn, $sql);
    if(!$result){
        die("An error occured in query: " . mysqli_error($conn));
    }
    mysqli_close($conn);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        //a row was returned....
        $row = mysqli_fetch_assoc($result);
        //get the hashed value from the user_pwd
        $hash = $row['password'];

        if(password_verify($pwd, $hash)){
            //password matches, grant access
            $_SESSION['LoggedInUser'] = $username;
            header("location:employees.php");
        }
    }



    echo "Incorrect Login<br/>";
    echo "<a href='mainLogin.html'>Try Again</a>";