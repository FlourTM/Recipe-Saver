<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/output.css" rel="stylesheet">
    <link href="./css/input.css" rel="stylesheet">
    <title>Upload a Recipe</title>
</head>

<body>
    <!-- Navigation Bar -->
    <my-header id=nav-ph w3-include-html='navbar.php'></my-header>
    <script type="module" src="javascript/navbar.js"></script>

    <script type="module" src="javascript/upload.js"></script>

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
    if ($user) {
    ?>

    <div name="Recipe" class='max-w-screen min-h-screen bg-LMbg'>
        <div class="mx-auto px-8 md:px-24 lg:px-32 pt-12 pb-24 sm:pt-24 text-LMtext1">
            <!-- Header -->
            <div>
                <h1 class="text-4xl pb-3">Upload a Recipe</h1>
                <div class='border w-full mx-auto border-LMtext2'></div>
            </div>

            <form id='uploadForm' class="w-full max-w-[1000px] h-fit mx-auto py-12">
                <div class="border-2 border-LMtext1 rounded py-8 bg-white h-fit px-5 sm:px-12 text-xl grid gap-y-4">
                    <div class="sm:flex gap-3 items-center">
                        <p class="whitespace-nowrap font-semibold">Title</p>
                        <input id="title" type="text" placeholder="Enter the title of the recipe" class="inputField w-full h-fit px-2 text-lg bg-transparent border-b border-LMtext2">
                    </div>
                    <div class="flex gap-3 items-center">
                        <p class="whitespace-nowrap font-semibold">Category</p>
                        <select id='category' class="inputField h-fit px-2 text-lg bg-transparent border-b border-LMtext2 cursor-pointer">
                            <option selected disabled hidden></option>
                            <option id="dinners">Dinners</option>
                            <option id="breakfast">Breakfast</option>
                            <option id="desserts">Desserts</option>
                            <option id="snacks">Snacks</option>
                            <option id="drinks">Drinks</option>
                        </select>
                    </div>
                    <div class="flex gap-3 items-center">
                        <p class="whitespace-nowrap font-semibold">Prep Time</p>
                        <input id='prepTime' type="text" onkeypress="return /[0-9]/i.test(event.key)" class="inputField text-center w-16 h-fit px-2 text-lg bg-transparent border-b border-LMtext2">
                        <p class="text-lg">mins</p>
                    </div>
                    <div class="flex gap-3 items-center">
                        <p class="whitespace-nowrap font-semibold">Cook Time</p>
                        <input id='cookTime' type="text" onkeypress="return /[0-9]/i.test(event.key)" class="inputField text-center w-16 h-fit px-2 text-lg bg-transparent border-b border-LMtext2">
                        <p class="text-lg">mins</p>
                    </div>
                    <div class="">
                        <div class="sm:flex justify-between items-end">
                            <p class="whitespace-nowrap font-semibold">Ingredients</p>
                            <p class="text-sm text-accentPink">Enter the ingredients, separated by a semicolon.</p>
                        </div>
                        <textarea id='ingredients' class="inputField w-full h-44 px-2 text-lg bg-transparent border border-LMtext2"></textarea>
                    </div>
                    <div class="">
                        <div class="sm:flex justify-between items-end">
                            <p class="whitespace-nowrap font-semibold">Instructions</p>
                            <p class="text-sm text-accentPink">Enter the instructions, separated by a semicolon.</p>
                        </div>
                        <textarea id='instructions' class="inputField w-full h-44 px-2 text-lg bg-transparent border border-LMtext2"></textarea>
                    </div>
                    <div class="flex gap-3 items-center w-fit">
                        <p class="whitespace-nowrap font-semibold">Image</p>
                        <input id="recipeImg" type="file" class="inputField w-full h-fit px-2 text-lg">
                    </div>

                    <p id='errorMsg' class="text-center text-accentPink"></p>

                    <!-- Button -->
                    <div class='flex justify-center'>
                        <button id='uploadBtn' type="button" class='rounded px-8 w-fit text-lg border border-b-4 border-LMtext1 text-LMtext1
                        hover:bg-LMtext1 hover:text-LMbg'>Upload this Recipe</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <?php
        $mysqli->close();
    } else {
        echo ('<script>window.location = "index"</script>');
    }
    ?>
</body>

</html>