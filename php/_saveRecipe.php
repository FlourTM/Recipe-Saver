<?php
session_start();
// Grabs the SQL database from the database.php file
$mysqli = require __DIR__ . "/database.php";

if (isset($_POST['saveRecipe'])) {
    echo('hi');
    // Saving recipe
    $recipeID = $mysqli->real_escape_string($_POST['recipeID']);
    $sesid = $mysqli->real_escape_string($_SESSION['userid']);

    $sql = sprintf(
        "INSERT INTO savedrecipes (userID, recipeID) VALUES ('%s', '%s')",
        $sesid,
        $recipeID
    );
    $result = $mysqli->query($sql);

    // display a message to the user
    if ($result) {
        echo "Recipe saved.";
    } else {
        echo "Error saving recipe.";
    }
} elseif (isset($_POST['unsave'])) {
    echo('hello');
    // Unsaving recipe
    $recipeID = $mysqli->real_escape_string($_POST['recipeID']);
    $userID = $_SESSION['userid'];

    $sql = "DELETE FROM savedrecipes WHERE userID = $userID and recipeID = '$recipeID'";
    $result = $mysqli->query($sql);

    if (!$mysqli->query($sql)) {
        echo ($mysqli->affected_rows);
    }
}
