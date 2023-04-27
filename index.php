<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/output.css" rel="stylesheet">
    <title>Recipe Saver - Home</title>
</head>

<body>
    <!-- Navigation Bar -->
    <my-header id=nav-ph w3-include-html='navbar.php'></my-header>
    <script type="module" src="javascript/navbar.js"></script>

    <?php 
        $mysqli = require __DIR__ . "/php/database.php";
        $sql = "SELECT * FROM recipe ORDER BY id DESC LIMIT 4;";
        $result = $mysqli->query($sql);
    ?>

    <div name="Home" class='min-h-screen max-w-screen bg-LMbg'>
        <div class="px-8 pt-12 pb-24 mx-auto md:px-24 lg:px-32 sm:pt-24 text-LMtext1">
            <!-- Header -->
            <div>
                <h1 class="pb-3 text-4xl">Recipe Saver</h1>
                <div class='w-full mx-auto border border-LMtext2'></div>
            </div>

            <p class="max-w-4xl py-5 mx-auto text-2xl text-center">Welcome to Recipe Saver - your one stop shop for all things cooking. Here, you'll find a collection of our users' favorite recipes, 
                    from breakfast and dinners to dessert, to drinks and snacks.</p>

            <!-- Most Recently Published Recipes -->
            <p class="pt-5 text-3xl text-center">NEWEST RECIPES</p>
            <div class="grid py-8 mx-auto w-fit sm:grid-cols-2 xl:grid-cols-4 place-items-center gap-x-3 md:gap-x-8 gap-y-20">
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

            <p class="pt-5 text-3xl text-center">Want to check out all of our recipes? <a href="allrecipes" class="underline text-accentPink">Start here.</a></p>
        </div>
    </div>
</body>

</html>