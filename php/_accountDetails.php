<?php
session_start();
// Grabs the SQL database from the database.php file
$mysqli = require __DIR__ . "/database.php";

// Checks if $_POST['name'] exists, if true, then we're updating the user's info
if (isset($_POST["fName"])) {
    $first = $mysqli->real_escape_string($_POST['fName']);
    $last = $mysqli->real_escape_string($_POST['lName']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $phone = isset($_POST['phone']) && !empty($_POST['phone']) ? "'" . $mysqli->real_escape_string($_POST['phone']) . "'" : "NULL";
    $sesid = $mysqli->real_escape_string($_SESSION['userid']);

    $sqlfetch = sprintf("SELECT * FROM user WHERE id = %d", $sesid);
    $result = $mysqli->query($sqlfetch);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['email'] == $_POST['email'] && $row['id'] != $_SESSION['userid']) {
            echo ("Email already taken!");
        } elseif ($row['phone'] == $_POST['phone'] && $row['id'] != $_SESSION['userid']) {
            echo ("Phone already taken!");
        } else {
            $sql = "UPDATE user 
                    SET firstName = '$first', lastName = '$last', email = '$email', phone = $phone
                    WHERE id = '$sesid'";
            echo ("Account details successfully saved.");
            if (!$mysqli->query($sql)) {
                echo ($mysqli->affected_rows);
            }
        }
    }
}

// Else if $_POST['password'] exists, then we're updating the user's password
elseif (isset($_POST["password"])) {
    $pass = $mysqli->real_escape_string(password_hash($_POST["newpass"], PASSWORD_DEFAULT));
    $sesid = $mysqli->real_escape_string($_SESSION['userid']);

    $sqlfetch = sprintf(
        "SELECT * FROM user WHERE id = '%s'",
        $mysqli->real_escape_string($_SESSION['userid'])
    );
    $result = $mysqli->query($sqlfetch);
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST["password"], $user["pass_hash"])) {
            $sql = "UPDATE user 
                SET pass_hash = '$pass'
                WHERE id = '$sesid'";

            if (!$mysqli->query($sql)) {
                echo ($mysqli->affected_rows);
            }
            echo ("Password successfully changed!");
        } else {
            echo ("Current password incorrect!");
        }
    }
}

$mysqli->close();