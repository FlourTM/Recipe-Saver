<?php
session_start();
// Grabs the SQL database from the database.php file
$mysqli = require __DIR__ . "/database.php";

if (isset($_POST["title"])) {
    $title = $mysqli->real_escape_string($_POST['title']);
    $category = $mysqli->real_escape_string($_POST['category']);
    $prepTime = $mysqli->real_escape_string($_POST['prepTime']);
    $cookTime = $mysqli->real_escape_string($_POST['cookTime']);
    $ingredients = $mysqli->real_escape_string($_POST['ingredients']);
    $instructions = $mysqli->real_escape_string($_POST['instructions']);
    $sesid = $mysqli->real_escape_string($_SESSION['userid']);

    // Get the image data
    $image = file_get_contents($_FILES['image']['tmp_name']);

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // File uploaded successfully, continue with other database insertions
    } else {
        // Debug: Print out the error message
        echo "Upload error: " . $_FILES["image"]["error"] . "<br>";
        echo "Sorry, there was an error uploading your file.";
        exit();
    }

    $image_path = $target_file;
    $image_type = $_FILES['image']['type'];

    // Insert the data into the database
    $sql = "INSERT INTO recipe (title, category, prepTime, cookTime, ingredients, instructions, imagePath, imageType) 
            VALUES ('$title', '$category', '$prepTime', '$cookTime', '$ingredients', '$instructions', '$image_path', '$image_type')";
    $stmt = $mysqli->prepare($sql);

    if (!$stmt->execute()) {
        echo "Error uploading recipe. Please try again later.";
        exit();
    }

    // Retrieve the ID of the newly inserted recipe
    $recipeId = $mysqli->insert_id;

    // Insert a new row into the userRecipes table
    $sql = "INSERT INTO userrecipes (userID, recipeID) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $sesid, $recipeId);

    if (!$stmt->execute()) {
        echo "Error adding recipe to user's recipe list. Please try again later.";
        exit();
    }

    echo "Recipe uploaded successfully!";
}
