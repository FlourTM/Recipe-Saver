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

    <div name="AllRecipes" class='max-w-screen min-h-screen bg-LMbg'>
        <div class="mx-auto px-8 md:px-24 lg:px-32 pt-12 pb-24 sm:pt-24 text-LMtext1">
            <!-- Header -->
            <div>
                <div class="lg:flex lg:gap-4 justify-between items-center pb-3 text-center lg:text-left">
                    <h1 class="text-4xl">All Recipes</h1>
                    <div id="section" class="pt-2 text-xl grid grid-cols-3 lg:flex lg:gap-8">
                        <button id="all" class="active">ALL</button>
                        <button id="dinners">DINNERS</button>
                        <button id="breakfast">BREAKFAST</button>
                        <button id="desserts">DESSERTS</button>
                        <button id="snacks">SNACKS</button>
                        <button id="drinks">DRINKS</button>
                    </div>
                </div>
                <div class='border w-full mx-auto border-LMtext2'></div>
            </div>
            
            <!-- Recipe Icons -->
            <div class="py-12 w-fit mx-auto grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 place-items-center gap-x-3 md:gap-x-8 gap-y-20">
                <!-- Individual Recipe -->
                <?php
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <a href="recipe.php?id=<?= $row['id'] ?>" class="recipe w-11/12 max-w-sm sm:w-[250px] 2xl:w-[300px] category-<?=strtolower($row['category'])?>">
                        <img src="uploads/<?=$row['imagePath']?>" alt="image" class="w-full object-cover object-center aspect-square">
                        <div class="bg-white p-2 text-left">
                            <p id="category" class="text-accentPink text-base uppercase"><?=$row['category']?></p>
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