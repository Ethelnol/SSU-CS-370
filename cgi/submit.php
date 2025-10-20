<?php
session_start();


// Attempts to connect to mysql data base
require_once "connection.php";

// Try to add user data via POST to db.
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // If both fields were filled then we try login
        if (isset($_POST['Email']) && isset($_POST['Password'])) {
            // String to check if record exist with passed information
            // Note: The usage of 1 here prevents usage of data, replace
            // with * if access to the record is needed
            $sql = "SELECT 1 FROM users WHERE email=:Email AND password=:Password";

            // This prepare statement escapes/sanitizes user entered data
            $statements = $connection->prepare($sql);
            // If this point is reached then passed data is 'safe' and command occurs
            $statements->execute(array(
                ':Email' => $_POST['Email'],
                ':Password' => $_POST['Password']
            ));

            
            //if not found
            if (!((bool)$statements->fetchColumn())) {
                $_SESSION["error"] = "Incorrect.";
                header('Location: index.php');
                return;
            }

            $_SESSION["account"] = $_POST['Email'];
            $_SESSION["success"] = "Logged in.";
            header('Location: index.php');
            return;
        }
    }
} catch (Exception $e) {

    $_SESSION["error"] = "error caught";
    header('Location: index.php');
    return;
}
