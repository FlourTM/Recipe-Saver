<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/output.css" rel="stylesheet">
    <link href="./css/input.css" rel="stylesheet">
    <title>Recipe Saver - Account</title>
</head>

<body>
    <!-- Navigation Bar -->
    <my-header id=nav-ph w3-include-html='navbar.php'></my-header>
    <script type="module" src="javascript/navbar.js"></script>

    <script type="module" src="javascript/account.js"></script>

    <?php
    $mysqli = require __DIR__ . "/php/database.php";
    $sql = sprintf(
        "SELECT * FROM user
            WHERE id = '%s'",
        $mysqli->real_escape_string($_SESSION['userid'])
    );
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    // User Uploaded Recipes
    $recipesql = sprintf(
        "SELECT r.id, r.title, r.category, r.prepTime, r.cookTime, r.imagePath
        FROM recipe r
        INNER JOIN userrecipes ur ON r.id = ur.recipeID
        WHERE ur.userID = '%s'",
        $mysqli->real_escape_string($_SESSION['userid'])
    );
    $reciperesult = $mysqli->query($recipesql);
    $recipes = $reciperesult->fetch_all(MYSQLI_ASSOC);

    if ($user) {
    ?>

        <div name="Account" class='max-w-screen min-h-screen bg-LMbg'>
            <div class="mx-auto px-8 md:px-24 lg:px-32 pt-12 pb-24 sm:pt-24 text-LMtext1">
                <!-- Header -->
                <div>
                    <div class="lg:flex lg:gap-4 justify-between items-center pb-3 text-center lg:text-left">
                        <h1 class="text-4xl">My Account</h1>
                        <div id="section" class="pt-2 text-xl grid sm:flex gap-3 sm:gap-8 justify-center">
                            <button id="myInfo" class="active section">MY INFORMATION</button>
                            <button id="uploaded" class="section">UPLOADED RECIPES</button>
                        </div>
                    </div>
                    <div class='border w-full mx-auto border-LMtext2'></div>
                </div>

                <!-- My Information -->
                <div id="information" class="w-full max-w-[700px] h-fit mx-auto py-12">
                    <div class="border-2 border-LMtext1 rounded py-8 bg-white">
                        <h2 class="text-center text-3xl font-semibold">Hello <span id="helloName">
                                <?= $user['firstName'] ?></span>!</h2>
                        <p class="text-center text-xl text-LMtext1">Not you?
                            <button type="submit" id="logout" class="logout font-semibold text-accentPink underline" name="logout">Logout.</button>
                        </p>

                        <p id="confirm-msg" class="confirm-message text-center text-lg text-red-600"></p>

                        <!-- Information -->
                        <div class='grid w-full h-fit px-5 sm:px-12 text-2xl'>
                            <!-- Account Details -->
                            <form id="accountForm" class="text-LMtext2 py-5">
                                <div class='grid sm:flex items-center'>
                                    <p class='font-semibold text-LMtext1 pr-2 whitespace-nowrap'>First
                                        Name:</p>
                                    <input id="fName" name="firstname" type='text' placeholder='<?= $user["firstName"] ?>' value='<?= $user["firstName"] ?>' class='input1 w-full h-fit rounded px-2 text-xl bg-transparent' readonly></input>
                                </div>
                                <div class='grid sm:flex items-center pt-5'>
                                    <p class='font-semibold text-LMtext1 pr-2 whitespace-nowrap'>Last
                                        Name:</p>
                                    <input id="lName" name="lastname" type='text' placeholder='<?= $user["lastName"] ?>' value='<?= $user["lastName"] ?>' class='input1 w-full h-fit rounded px-2 text-xl bg-transparent' readonly></input>
                                </div>
                                <div class='grid sm:flex items-center pt-5'>
                                    <p class='font-semibold text-LMtext1 pr-2 whitespace-nowrap'>Email:
                                    </p>
                                    <input id="email" name="email" type='email' placeholder='<?= $user["email"] ?>' value='<?= $user["email"] ?>' class='input1 w-full h-fit rounded px-2 text-xl bg-transparent' readonly></input>
                                </div>
                                <div class='grid sm:flex items-center pt-5'>
                                    <p class='font-semibold text-LMtext1 pr-2 whitespace-nowrap'>Phone:
                                    </p>
                                    <input id="phone" name="phone" type='tel' placeholder='<?php if ($user["phone"] != null) { ?>
                                        <?= $user["phone"] ?>
                                        <?php } else { ?>No phone number added.<?php } ?>' value='<?= $user["phone"] ?>' class='input1 w-full h-fit rounded px-2 text-xl bg-transparent' readonly></input>
                                </div>
                            </form>

                            <!-- Password -->
                            <form id="passForm" class='hidden text-LMtext2'>
                                <div class='flex flex-col w-full pt-5'>
                                    <p class='font-semibold text-LMtext1 pr-2'>Current
                                        Password:</p>
                                    <div class="flex">
                                        <input id="current" name="current" type='password' class='pwFields current rounded px-2 text-xl bg-transparent border-b border-LMtext1 w-full'></input>
                                        <button type="button"><span class="material-symbols-outlined eyeIcon current" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span></button>
                                    </div>
                                </div>
                                <div class='flex flex-col pt-5'>
                                    <p class='font-semibold text-LMtext1 pr-2 w-fit'>New
                                        Password:
                                    </p>
                                    <div class="flex">
                                        <input id="new" name="new" type='password' class='pwFields new rounded px-2 text-xl bg-transparent border-b border-LMtext1 w-full'></input>
                                        <button type="button"><span class="material-symbols-outlined eyeIcon new" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span></button>
                                    </div>
                                </div>
                                <div class='flex flex-col pt-5'>
                                    <p class='font-semibold text-LMtext1 pr-2 w-fit'>Confirm
                                        Password:</p>
                                    <div class="flex">
                                        <input id="confirm" name="confirm" type='password' class='pwFields confirm rounded px-2 text-xl bg-transparent border-b border-LMtext1 w-full'></input>
                                        <button type="button"><span class="material-symbols-outlined eyeIcon confirm" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span></button>
                                    </div>
                                </div>
                            </form>

                            <!-- Information Buttons -->
                            <div class='grid sm:flex justify-center pt-5 gap-4 sm:gap-8'>
                                <button id="edit" type="button" class='edit rounded px-8 w-52 text-lg border border-b-4 border-LMtext1 text-LMtext1
                                    hover:bg-LMtext1 hover:text-LMbg'>Edit Details</button>
                                <button id="change" type="button" class='change rounded px-8 w-52 text-lg border border-b-4 border-LMtext1 text-LMtext1
                                    hover:bg-LMtext1 hover:text-LMbg'>Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id='recipes' class="hidden">
                    <p class="text-2xl text-center py-5">Want to upload a recipe? <a href="upload"
                        class="text-accentPink underline">Start here.</a></p>
                    <?php if ($recipes) { ?> 
                        <!-- Recipe Icons -->
                        <div class="py-12 w-fit mx-auto grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 place-items-center gap-x-3 md:gap-x-8 gap-y-20">
                            <!-- Individual Recipe -->
                            <?php foreach ($recipes as $recipe) { ?>
                                <a href="recipe.php?id=<?= $recipe['id'] ?>" class="recipe w-11/12 max-w-sm sm:w-[250px] 2xl:w-[300px] category-<?=strtolower($recipe['category'])?>">
                                    <img src="uploads/<?=$recipe['imagePath']?>" alt="image" class="w-full object-cover object-center aspect-square">
                                    <div class="bg-white p-2 text-left">
                                        <p id="category" class="text-accentPink text-base uppercase"><?=$recipe['category']?></p>
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
                        <div class="border-2 border-LMtext1 rounded p-5 bg-white w-11/12 sm:max-w-2xl mx-auto">
                            <h4 class="text-3xl text-center">It seems that you haven't uploaded any recipes yet.</h4>
                        </div>
                    <?php } ?>
                </div>
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