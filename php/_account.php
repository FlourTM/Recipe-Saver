<?php
session_start();

// Signing up
if (isset($_POST['confirmpassword'])) {
    // Grabs the SQL database from the database.php file
    $mysqli = require __DIR__ . "/database.php";

    // Variables sent from JS
    $first = $_POST["firstName"];
    $last = $_POST["lastName"];
    $email = $_POST["remail"];
    $pass_hash = password_hash($_POST["rpassword"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (firstName, lastName, email, pass_hash)
    VALUES (
        '$first',
        '$last',
        '$email',
        '$pass_hash'
    );";

   $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
    }

    try {
        $stmt->execute();
        echo ("Registration successful!");
        $mysqli->close();
    } catch (Exception $e) {
        echo ("Email already taken!");
    }
}

//Logging in
if (isset($_POST['lemail'])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf(
        "SELECT * FROM user
            WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["lemail"])
    );
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST["lpassword"], $user["pass_hash"])) {
            $_SESSION["userid"] = $user["id"];
            header("Location: ../index.php?msg=loggedin");
        } else {
            echo ("Invalid email or password!");
        }
        $mysqli->close();
    } else {
        echo ("No account associated with this email!");
    }

    $is_invalid = true;
    exit;
}

//Logging out
if (isset($_POST['logout'])) {
    unset($_SESSION['userid']);
    session_destroy();
}