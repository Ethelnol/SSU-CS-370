<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction site</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="tempElements"></div>
    <div class="layout">
        <nav class="header">
            <h1>Auction Site</h1>
            <button id="userProfile">User Profile</button>
            <?php
            if (isset($_GET['timeout'])) {
                echo '<p class="timeout-message">Your session has expired due to inactivity. Please log in again.</p>';
            }
            ?>
        </nav>
        
    </div>

    

    <!-- login menu -->
    <div id="loginPage" class="loginContainer hidden <?php if ( isset($_SESSION["error"]) ) {  echo "show";  }?>">
        <h1>Login</h1>

        <?php
        // Error flash success
        if (isset($_SESSION["success"])) {
            echo ('<p style="color:green">' . $_SESSION["success"] . "</p>\n");

            unset($_SESSION["success"]);
        }

        // Error flash message
        if ( isset($_SESSION["error"]) ) {
            echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
            unset($_SESSION["error"]);
        }

        // If account was not set then the user is not logged in so we display login form
        if (!isset($_SESSION["account"])) { ?>
            <form name="loginForm" action="submit.php" method="post" class="">
                <input type="text" name="Email" id="Email" placeholder="Email" minlength="2" maxlength="50" value="" required>
                <br>
                <br>
                <input type="password" name="Password" id="Password" placeholder="Password" minlength="8" maxlength="255" value="" required>
                <br>
                <br>
                <input type="submit" id="submitLogin" value="Login">

            </form>

            <form name="signUpForm" action="signUp.php" method="post" class="hidden">
                <input type="text" name="newUsername" id="newUsername" placeholder="Username" minlength="2" maxlength="50" value="" required>
                <br>
                <br>
                <input type="text" name="newEmail" id="newEmail" placeholder="Email" minlength="2" maxlength="50" value="" required>
                <br>
                <br>
                <input type="password" name="newPassword" id="newPassword" placeholder="Password" minlength="8" maxlength="255" value="" required>
                <br>
                <br>
                <input type="submit" id="submitSignUp" value="SignUp">
            </form>
            <p id="signUpText">Don't have an account? <span> <button id="signUpButton">SignUp</button> </span> </p>
        <?php } else { ?>
            <?php echo('<p> Hello '.$_SESSION["account"]."</p>\n") ?>
            <p>Please <a href="logout.php">Log Out</a> when you are done.</p>
        <?php } ?>


    </div>

    <script src="script.js"></script>
</body>

</html>
