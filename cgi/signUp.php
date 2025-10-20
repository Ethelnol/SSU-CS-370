<?php
session_start();

// Attempts to connect to mysql data base
require_once "connection.php";

// Try to add user data via POST to db.
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // If both fields were filled then we try login
        if (isset($_POST['newEmail']) && isset($_POST['newPassword'])) {
            // String to check if record exist with passed information
            // Note: The usage of 1 here prevents usage of data, replace
            // with * if access to the record is needed
            $sql = "SELECT 1 FROM users WHERE email=:Email AND password=:Password";

            // This prepare statement escapes/sanitizes user entered data
            $statements = $connection->prepare($sql);
            // If this point is reached then passed data is 'safe' and command occurs
            $statements->execute(array(
                ':Email' => $_POST['newEmail'],
                ':Password' => $_POST['newPassword']
            ));
            // If user was not found then injection is tried
            // Note: fetchColumn() returns 1 meaning true and 0 meaning false
            if (!((bool)$statements->fetchColumn())) {
                // String to insert data to db
                $sql = "INSERT INTO users (email, password) VALUES (:Email, :Password)";

                // This prepare statement escapes/sanitizes user entered data
                $statements = $connection->prepare($sql);
                // If this point is reached then passed data is 'safe' and injection occurs
                $statements->execute(array(
                    ':Email' => $_POST['newEmail'],
                    ':Password' => $_POST['newPassword']
                ));
            }

            $_SESSION["account"] = $_POST['newEmail'];
            $_SESSION["success"] = "Logged in.";
            header('Location: index.php');
            return;
        }
    }
} catch (Exception $e) {
    // If this point is reached then passed data does not match 
    // an existing account or addition of data failed. 

    $_SESSION["error"] = "Email or Username is already in use";
        header('Location: index.php');
    return;
}

echo "<pre>";
print_r($_POST);



?>
