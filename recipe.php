<?php session_start();

// get the recipe ID from the query parameter
if (!isset($_GET['id'])) {
    header('Location: allrecipes.php');
    exit();
}
$recipeId = $_GET['id'];
$mysqli = require __DIR__ . '/php/database.php';
$recipesql = sprintf(
    "SELECT * FROM recipe WHERE id = '%s'",
    $mysqli->real_escape_string($recipeId)
);
$reciperesult = $mysqli->query($recipesql);
if ($reciperesult->num_rows === 0) {
    header('Location: allrecipes.php');
    exit();
}
$row = $reciperesult->fetch_assoc();

// gets the user information if they are signed in
$user = false;
if (isset($_SESSION['userid'])){
    $usersql = sprintf(
        "SELECT * FROM user
            WHERE id = '%s'",
        $mysqli->real_escape_string($_SESSION['userid'])
    );
    $userresult = $mysqli->query($usersql);
    $user = $userresult->fetch_assoc();
}

// gets comments for the specific recipe
$commentsql = sprintf(
    "SELECT comments.content, comments.date, user.firstName, user.lastName
     FROM comments
     INNER JOIN user ON comments.userID = user.id
     WHERE comments.recipeID = %s",
    $mysqli->real_escape_string($recipeId)
);
$commentresult = $mysqli->query($commentsql);
$comments = array();
if ($commentresult->num_rows > 0) {
    while ($comment = $commentresult->fetch_assoc()) {
        $comments[] = $comment;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/output.css" rel="stylesheet">
    <link href="./css/input.css" rel="stylesheet">
    <title>Recipe Saver - Recipe</title>
</head>

<body data-recipeid="<?php echo $recipeId; ?>">
    <!-- Navigation Bar -->
    <my-header id=nav-ph w3-include-html='navbar.php'></my-header>
    <script type="module" src="javascript/navbar.js"></script>

    <script type="module" src="javascript/recipe.js"></script>

    <div name="Recipe" class='max-w-screen min-h-screen bg-LMbg'>
        <div class="mx-auto px-8 md:px-24 lg:px-32 pt-12 pb-24 sm:pt-24 text-LMtext1">
            <!-- Header -->
            <div>
                <h1 class="text-4xl pb-3"><?=$row['title']?></h1>
                <div class='border w-full mx-auto border-LMtext2'></div>
            </div>

            <!-- Recipe -->
            <div class="p-12 w-fit mx-auto grid lg:grid-cols-3 place-items-start gap-8 text-xl">
                <img src="uploads/<?=$row['imagePath']?>" alt="image" class="w-full max-w-xl aspect-square">

                <!-- Recipe Information -->
                <div class="bg-white p-5 text-left grid lg:col-span-2 w-full gap-y-2">
                    <div class="flex justify-between">
                        <p class="text-accentPink uppercase"><?=$row['category']?></p>
                        <button id="saveBtn" type='button' class="save flex items-center gap-1 uppercase text-LMtext1 hover:text-accentPink">
                            <span id="saveIcon" class="material-symbols-outlined" style="font-size:32px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">
                                heart_plus</span>
                            <p id="saveText">Save it</p>
                        </button>
                    </div>
                    <h2 id="title" class="text-3xl"><?=$row['title']?></h2>
                    <div class="flex items-center gap-12 whitespace-nowrap">
                        <div class="text-center">
                            <p class="text-accentPink">Prep Time:</p>
                            <p><span id="prep"><?=$row['prepTime']?></span> mins</p>
                        </div>
                        <div class="text-center">
                            <p class="text-accentPink">Cook Time:</p>
                            <p><span id="cook"><?=$row['cookTime']?></span> mins</p>
                        </div>
                        <div class="text-center">
                            <p class="text-accentPink">Total Time:</p>
                            <p><span id="total"><?=($row['prepTime'] + $row['cookTime'])?></span> mins</p>
                        </div>
                    </div>

                    <h3 class="text-2xl pt-5">Ingredients</h3>
                    <div class='border w-full mx-auto border-LMtext2'></div>
                    <ul class="list-disc px-12">
                        <?php
                        $ingredients = explode(';', $row['ingredients']);
                        foreach ($ingredients as $ingredient) {
                            $ingredient = trim($ingredient);
                            if (!empty($ingredient)) {
                            echo '<li>' . $ingredient . '</li>';
                            }
                        }
                        ?>
                    </ul>

                    <h3 class="text-2xl pt-5">Instructions</h3>
                    <div class='border w-full mx-auto border-LMtext2'></div>
                    <ol class="list-decimal px-12">
                        <?php
                        $instructions = explode(';', $row['instructions']);
                        foreach ($instructions as $instruction) {
                            $instruction = trim($instruction);
                            if (!empty($instruction)) {
                            echo '<li>' . $instruction . '</li>';
                            }
                        }
                        ?>
                    </ol>
                </div>

                <!-- Comment Section -->
                <div class="bg-white p-5 text-left grid lg:col-span-3 w-full gap-y-2">
                    <h2 class="text-3xl">Comments</h2>
                    <div class='border w-full mx-auto border-LMtext2'></div>
                    <?php
                    if ($user) {
                    ?>
                        <form id="commentBox" class="flex items-center gap-3 px-12">
                            <p class="text-accentPink whitespace-nowrap"><?= $user['firstName'] ?> <?= $user['lastName'] ?></p>
                            <input id="comment" name="comment" type="text" placeholder='Add a comment' class='rounded px-2 w-full h-fit bg-transparent border-b border-LMtext2' required></input>
                            <button id="sendBtn" type='button'><span class="material-symbols-outlined">send</span></button>
                        </form>
                        <p id='confirmMsg' class="text-center text-accentPink"></p>
                    <?php
                    } else {
                        ?><p class="text-center">You must be signed in to comment.</p><?php
                    }
                    ?>

                    <!-- Comments -->
                    <div id='commentDiv' class="grid gap-8 py-5 px-12">
                        <!-- Individual Comment -->
                        <?php
                        if (!empty($comments)) {
                            $comments = array_reverse($comments);
                            foreach ($comments as $comment) { ?>
                                <div class="flex gap-8">
                                    <div class="whitespace-nowrap">
                                        <p id="name" class="text-accentPink"><?=$comment['firstName'] . ' ' . $comment['lastName']?></p>
                                        <p id="date" class="text-sm"><?=date('M j, Y', strtotime($comment['date']))?></p>
                                    </div>
                                    <p id="comment"><?=$comment['content']?></p>
                                </div>
                            <?php } 
                        } else { ?>
                            <p class="text-center">Be the first to comment.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $mysqli->close();
    ?>
</body>

</html>