<?php session_start();

// get the recipe ID from the query parameter
if (!isset($_GET['id'])) {
    header('Location: allrecipes.php');
    exit();
}
$recipeId = $_GET['id'];
$_SESSION['current_recipe_id'] = $recipeId;
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

    $savedsql = sprintf(
        "SELECT * FROM savedrecipes WHERE userID = '%s' and recipeID ='$recipeId'",
        $mysqli->real_escape_string($_SESSION['userid'])
    );
    $savedresult = $mysqli->query($savedsql);
    $saved = $savedresult->fetch_assoc();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div name="Recipe" class='min-h-screen max-w-screen bg-LMbg'>
        <div class="px-8 pt-12 pb-24 mx-auto md:px-24 lg:px-32 sm:pt-24 text-LMtext1">
            <!-- Header -->
            <div>
                <h1 class="pb-3 text-4xl"><?=$row['title']?></h1>
                <div class='w-full mx-auto border border-LMtext2'></div>
            </div>

            <!-- Recipe -->
            <div class="grid gap-8 py-12 mx-auto text-lg sm:px-12 w-fit lg:grid-cols-3 place-items-start sm:text-xl">
                <img src="uploads/<?=$row['imagePath']?>" alt="image" class="w-full max-w-xl aspect-square">

                <!-- Recipe Information -->
                <div class="grid w-full p-5 text-left bg-white lg:col-span-2 gap-y-2">
                    <div class="flex justify-between">
                        <p class="uppercase text-accentPink"><?=$row['category']?></p>
                        <?php if ($user) {
                            if ($saved) { ?>
                                <button id="saveBtn" type='button' class="flex items-center gap-1 uppercase unsave text-LMtext1 hover:text-accentPink">
                                    <span id="saveIcon" class="material-symbols-outlined" style="font-size:32px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">
                                        heart_minus</span>
                                    <p id="saveText">Unsave it</p>
                                </button>
                            <?php } else { ?>
                                <button id="saveBtn" type='button' class="flex items-center gap-1 uppercase save text-LMtext1 hover:text-accentPink">
                                    <span id="saveIcon" class="material-symbols-outlined" style="font-size:32px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">
                                        heart_plus</span>
                                    <p id="saveText">Save it</p>
                                </button>
                            <?php } 
                        } else { ?>
                            <button id="saveBtn" type='button' class="flex items-center gap-1 uppercase save text-LMtext1 hover:text-accentPink">
                                <span id="saveIcon" class="material-symbols-outlined" style="font-size:32px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">
                                    heart_plus</span>
                                <p id="saveText">Save it</p>
                            </button>
                        <?php } ?>
                    </div>
                    <h2 id="title" class="text-2xl sm:text-3xl"><?=$row['title']?></h2>
                    <div class="grid items-center grid-cols-2 sm:flex gap-x-8 sm:gap-x-12 whitespace-nowrap">
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

                    <h3 class="pt-5 text-xl sm:text-2xl">Ingredients</h3>
                    <div class='w-full mx-auto border border-LMtext2'></div>
                    <ul class="px-12 list-disc">
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

                    <h3 class="pt-5 text-xl sm:text-2xl">Instructions</h3>
                    <div class='w-full mx-auto border border-LMtext2'></div>
                    <ol class="px-12 list-decimal">
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
                <div class="grid w-full p-5 text-sm text-left bg-white lg:col-span-3 gap-y-2 sm:text-xl">
                    <h2 class="text-2xl sm:text-3xl">Comments</h2>
                    <div class='w-full mx-auto border border-LMtext2'></div>
                    <?php
                    if ($user) {
                    ?>
                        <form id="commentBox" class="grid items-center px-2 sm:flex gap-x-3 sm:px-12">
                            <p class="text-accentPink whitespace-nowrap"><?= $user['firstName'] ?> <?= $user['lastName'] ?></p>
                            <div class="flex items-center w-full gap-3">
                                <input id="comment" name="comment" type="text" placeholder='Add a comment' class='w-full px-2 bg-transparent border-b rounded h-fit border-LMtext2' required></input>
                                <button id="sendBtn" type='button'><span class="material-symbols-outlined">send</span></button>
                            </div>
                        </form>
                        <p id='confirmMsg' class="text-center text-accentPink"></p>
                    <?php
                    } else {
                        ?><p class="text-center">You must be signed in to comment.</p><?php
                    }
                    ?>

                    <!-- Comments -->
                    <div id='commentDiv' class="grid gap-8 px-2 py-5 sm:px-12">
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