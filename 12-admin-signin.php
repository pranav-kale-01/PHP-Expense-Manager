<?php 
    include_once "./init.php";
    
    // User login check
    if (isset($_SESSION['UserId'])) {
        header('Location: ./templates/13-admin-Dashboard.php');
    }

    // Validate credentials and log the user in
    if (isset($_POST['login']) && !empty($_POST)) {
        $password = $_POST['password'];
        $username = $_POST['username'];
        
        if(!empty($username) || !empty($password)) {
            $username = $getFromU->checkInput($username);
            $password = $getFromU->checkInput($password);

            if( $getFromU->checkAdmin($username) === false ) { 
                $error = "The user is not a admin";
            }
            else if( $getFromU->loginAdmin($username, $password, './templates') === false ) {
                $error = "The username or password is incorrect";     
            }
          } 
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/wallet.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="./static/css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <title>Expense Tracker</title>
</head>

<body>
    <div class="container">

        <div class="mob-hidden">
            <h1>Welcome to ExpenseManager!</h1>
        </div>

        <div class="top-heading">
            <h1>Welcome to ExpenseManager!</h1>
        </div>
        <form action="./12-admin-signin.php" method="post" onsubmit = "return validate()" id="form1">

            <div class="group">


                <div class="form-controller">
                <i class="fa fa-user-plus u3" aria-hidden="true"></i>
                <input type="text" name="username" placeholder="Username" id="user1" required>
                <br>
                <small></small>
                </div>

                <div class="form-controller">
                <i class="fa fa-key u4" aria-hidden="true"></i>
                <input type="password" name="password" placeholder="Password" id="pass1" autocomplete="on" required>
                <br>
                <small></small>
                </div>

            </div>
            <button type="submit" class="sign-in" name="login">SIGN IN</button>

            <br>
            <?php
                if (isset($error)) {
                    $font = "Source Sans Pro";
                    echo '<div style="color:  red;font-family:'.$font.';">'.$error.'</div>';
                }
            ?>
            
            <div class="new-account" style="padding-top: 5px; padding-bottom: 10px">
                <span style="color: rgba(0, 0, 0, 0.54); font-weight: bolder; font-family: 'Source Sans Pro';">Are You a User?</span> 
                <a href="./index.php" style="text-decoration: none;"><span style="color: rgba(5, 0, 255, 0.81); font-weight: bolder; font-family: 'Source Sans Pro';">Sign in here</span></a>
            </div>

        </form>

        <div class="img-container">
            <img src="./static/images/login.jpg" alt="Login-screen-picture">
        </div>
    </div>

<script src="../static/js/index.js"></script>
</body>

</html>