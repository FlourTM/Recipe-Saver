<?php
session_start();
// Grabs the SQL database from the database.php file
$mysqli = require __DIR__ . "/database.php";

if (isset($_POST['comment'])) {
    // get the comment text and user ID
    $comment = $mysqli->real_escape_string($_POST['comment']);
    $recipeID = $mysqli->real_escape_string($_POST['recipeID']);
    $sesid = $mysqli->real_escape_string($_SESSION['userid']);

    // insert the comment into the comments table
    $sql = sprintf(
        "INSERT INTO comments (userID, recipeID, content, date) VALUES ('%s', '%s', '%s', NOW())",
        $sesid,
        $recipeID,
        $comment
    );
    $result = $mysqli->query($sql);

    // display a message to the user
    if ($result) {
        echo "Comment posted!";
    } else {
        echo "Error posting comment.";
    }
}
