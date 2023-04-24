<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/output.css" rel="stylesheet">
    <link href="./css/input.css" rel="stylesheet">
    <title>Recipe Saver - My Recipes</title>
</head>

<body>
    <!-- Navigation Bar -->
    <my-header id=nav-ph w3-include-html='navbar.php'></my-header>
    <script type="module" src="javascript/navbar.js"></script>
    <script type="module" src="javascript/recipeSections.js"></script>

    <?php
    $user = false;
    if (isset($_SESSION['userid'])){
        $mysqli = require __DIR__ . "/php/database.php";
        $sql = sprintf(
            "SELECT * FROM user
                WHERE id = '%s'",
            $mysqli->real_escape_string($_SESSION['userid'])
        );
        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();
    }

    // User Saved Recipes
    $recipesql = sprintf(
        "SELECT r.id, r.title, r.category, r.prepTime, r.cookTime, r.imagePath
        FROM recipe r
        INNER JOIN savedrecipes ur ON r.id = ur.recipeID
        WHERE ur.userID = '%s'",
        $mysqli->real_escape_string($_SESSION['userid'])
    );
    $reciperesult = $mysqli->query($recipesql);
    $recipes = $reciperesult->fetch_all(MYSQLI_ASSOC);
    ?>
    <div name="MyRecipes" class='min-h-screen max-w-screen bg-LMbg'>
        <div class="px-8 pt-12 pb-24 mx-auto md:px-24 lg:px-32 sm:pt-24 text-LMtext1">
            <?php if ($user) { ?>
            <!-- Header -->
            <div>
                <div class="items-center justify-between pb-3 text-center lg:flex lg:gap-4 lg:text-left">
                    <h1 class="text-4xl">My Recipes</h1>
                    <div id="section" class="grid grid-cols-3 pt-2 text-xl lg:flex lg:gap-8">
                        <button id="all" class="active">ALL</button>
                        <button id="dinners">DINNERS</button>
                        <button id="breakfast">BREAKFAST</button>
                        <button id="desserts">DESSERTS</button>
                        <button id="snacks">SNACKS</button>
                        <button id="drinks">DRINKS</button>
                    </div>
                </div>
                <div class='w-full mx-auto border border-LMtext2'></div>

                <p class="pt-5 text-3xl text-center">Here's recipes you've loved.</p>
                <p class="text-2xl text-center">Want to upload your own? <a href="upload"
                        class="underline text-accentPink">Start here.</a></p>
            </div>

            <div class="py-12">
                <?php if ($recipes) { ?> 
                    <!-- Recipe Icons -->
                    <div class="grid mx-auto w-fit sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 place-items-center gap-x-3 md:gap-x-8 gap-y-20">
                        <!-- Individual Recipe -->
                        <?php foreach ($recipes as $recipe) { ?>
                            <a href="recipe.php?id=<?= $recipe['id'] ?>" class="recipe w-11/12 max-w-sm sm:w-[250px] 2xl:w-[300px] category-<?=strtolower($recipe['category'])?>">
                                <img src="uploads/<?=$recipe['imagePath']?>" alt="image" class="object-cover object-center w-full aspect-square">
                                <div class="flex flex-col justify-center h-32 p-2 my-auto text-left bg-white">
                                    <p id="category" class="text-base uppercase text-accentPink"><?=$recipe['category']?></p>
                                    <h2 id="title" class="text-2xl"><?=$recipe['title']?></h2>
                                    <div class="flex items-center gap-1">
                                        <span class="material-symbols-outlined" style="font-size:20px;">timer</span>
                                        <p class="text-base"><span id="time"><?=($recipe['prepTime'] + $recipe['cookTime'])?></span> mins</p>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <!-- If no recipes -->
                    <div class="w-11/12 p-5 mx-auto bg-white border-2 rounded border-LMtext1 sm:max-w-2xl">
                        <h4 class="text-3xl text-center">It seems that you haven't added any recipes yet. To view your
                            favorites here, press the heart on a recipe or add your own.</h4>
                    </div>
                <?php } ?>
            </div>

            <?php
            $mysqli->close();
            } else { ?>
            <div>
                <div class="items-center justify-between pb-3 text-center lg:flex lg:gap-4 lg:text-left">
                    <h1 class="text-4xl">My Recipes</h1>
                    <div id="section" class="grid grid-cols-3 pt-2 text-xl lg:flex lg:gap-8">
                        <button id="all">ALL</button>
                        <button id="dinners">DINNERS</button>
                        <button id="breakfast">BREAKFAST</button>
                        <button id="desserts">DESSERTS</button>
                        <button id="snacks">SNACKS</button>
                        <button id="drinks">DRINKS</button>
                    </div>
                </div>
                <div class='w-full mx-auto border border-LMtext2'></div>
                <p class="pt-10 text-3xl text-center">You must be signed in to view your saved recipes.</p>
            </div>
            <?php }
            ?>
        </div>
    </div>
</body>

</html>