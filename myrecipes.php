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
    ?>
    <div name="MyRecipes" class='max-w-screen min-h-screen bg-LMbg'>
        <div class="mx-auto px-8 md:px-24 lg:px-32 pt-12 pb-24 sm:pt-24 text-LMtext1">
            <?php if ($user) { ?>
            <!-- Header -->
            <div>
                <div class="lg:flex lg:gap-4 justify-between items-center pb-3 text-center lg:text-left">
                    <h1 class="text-4xl">My Recipes</h1>
                    <div id="section" class="pt-2 text-xl grid grid-cols-3 lg:flex lg:gap-8">
                        <button id="all">ALL</button>
                        <button id="dinners">DINNERS</button>
                        <button id="breakfast">BREAKFAST</button>
                        <button id="desserts">DESSERTS</button>
                        <button id="snacks">SNACKS</button>
                        <button id="drinks">DRINKS</button>
                    </div>
                </div>
                <div class='border w-full mx-auto border-LMtext2'></div>

                <p class="text-3xl text-center pt-5">Here's recipes you've loved.</p>
                <p class="text-2xl text-center">Want to upload your own? <a href="upload"
                        class="text-accentPink underline">Start here.</a></p>
            </div>

            <div class="py-12">
                <!-- If no recipes -->
                <div class="hidden border-2 border-LMtext1 rounded p-5 bg-white w-11/12 sm:w-[500px] mx-auto">
                    <h4 class="text-3xl text-center">It seems that you haven't added any recipes yet. To view your
                        favorites here, press the heart on a recipe or add your own.</h4>
                </div>

                <!-- Recipe Icons -->
                <div class="w-fit mx-auto grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 place-items-center gap-x-3 md:gap-x-8 gap-y-20">
                    <!-- Individual Recipe -->
                    <button class="w-11/12 max-w-sm sm:w-[250px] 2xl:w-[300px]">
                        <img src="https://plus.unsplash.com/premium_photo-1664472667313-46bb205215b8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
                            alt="image" class="w-full aspect-square">
                        <div class="bg-white p-2 text-left">
                            <p id="category" class="text-accentPink text-base uppercase">Category</p>
                            <h2 id="title" class="text-2xl">Name of Recipe Here</h2>
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined" style="font-size:20px;">timer</span>
                                <p class="text-base"><span id="time">30</span> mins</p>
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <?php
            $mysqli->close();
            } else { ?>
            <div>
                <div class="lg:flex lg:gap-4 justify-between items-center pb-3 text-center lg:text-left">
                    <h1 class="text-4xl">My Recipes</h1>
                    <div id="section" class="pt-2 text-xl grid grid-cols-3 lg:flex lg:gap-8">
                        <button id="all">ALL</button>
                        <button id="dinners">DINNERS</button>
                        <button id="breakfast">BREAKFAST</button>
                        <button id="desserts">DESSERTS</button>
                        <button id="snacks">SNACKS</button>
                        <button id="drinks">DRINKS</button>
                    </div>
                </div>
                <div class='border w-full mx-auto border-LMtext2'></div>
                <p class="text-3xl text-center pt-10">You must be signed in to view your saved recipes.</p>
            </div>
            <?php }
            ?>
        </div>
    </div>
</body>

</html>