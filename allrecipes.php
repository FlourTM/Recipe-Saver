<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/output.css" rel="stylesheet">
    <link href="./css/input.css" rel="stylesheet">
    <title>Recipe Saver - All Recipes</title>
</head>

<body>
    <!-- Navigation Bar -->
    <my-header id=nav-ph w3-include-html='navbar.php'></my-header>
    <script type="module" src="javascript/navbar.js"></script>
    <script type="module" src="javascript/recipeSections.js"></script>

    <?php
    $mysqli = require __DIR__ . "/php/database.php";
    $sql = "SELECT * FROM recipe";
    $result = $mysqli->query($sql);
    ?>

    <div name="AllRecipes" class='min-h-screen max-w-screen bg-LMbg'>
        <div class="px-8 pt-12 pb-24 mx-auto md:px-24 lg:px-32 sm:pt-24 text-LMtext1">
            <!-- Header -->
            <div>
                <div class="items-center justify-between pb-3 text-center lg:flex lg:gap-4 lg:text-left">
                    <h1 class="text-4xl">All Recipes</h1>
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
            </div>
            
            <!-- Recipe Icons -->
            <div class="grid py-12 mx-auto w-fit sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 place-items-center gap-x-3 md:gap-x-8 gap-y-20">
                <!-- Individual Recipe -->
                <?php
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <a href="recipe.php?id=<?= $row['id'] ?>" class="recipe w-11/12 max-w-sm sm:w-[250px] 2xl:w-[300px] category-<?=strtolower($row['category'])?>">
                        <img src="uploads/<?=$row['imagePath']?>" alt="image" class="object-cover object-center w-full aspect-square">
                        <div class="flex flex-col justify-center h-32 p-2 my-auto text-left bg-white">
                            <p id="category" class="text-base uppercase text-accentPink"><?=$row['category']?></p>
                            <h2 id="title" class="text-2xl"><?=$row['title']?></h2>
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined" style="font-size:20px;">timer</span>
                                <p class="text-base"><span id="time"><?=($row['prepTime'] + $row['cookTime'])?></span> mins</p>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>