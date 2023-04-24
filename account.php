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

        <div name="Account" class='min-h-screen max-w-screen bg-LMbg'>
            <div class="px-8 pt-12 pb-24 mx-auto md:px-24 lg:px-32 sm:pt-24 text-LMtext1">
                <!-- Header -->
                <div>
                    <div class="items-center justify-between pb-3 text-center lg:flex lg:gap-4 lg:text-left">
                        <h1 class="text-4xl">My Account</h1>
                        <div id="section" class="grid justify-center gap-3 pt-2 text-xl sm:flex sm:gap-8">
                            <button id="myInfo" class="active section">MY INFORMATION</button>
                            <button id="uploaded" class="section">UPLOADED RECIPES</button>
                        </div>
                    </div>
                    <div class='w-full mx-auto border border-LMtext2'></div>
                </div>

                <!-- My Information -->
                <div id="information" class="w-full max-w-[700px] h-fit mx-auto py-12">
                    <div class="py-8 bg-white border-2 rounded border-LMtext1">
                        <h2 class="text-3xl font-semibold text-center">Hello <span id="helloName">
                                <?= $user['firstName'] ?></span>!</h2>
                        <p class="text-xl text-center text-LMtext1">Not you?
                            <button type="submit" id="logout" class="font-semibold underline logout text-accentPink" name="logout">Logout.</button>
                        </p>

                        <p id="confirm-msg" class="text-lg text-center text-red-600 confirm-message"></p>

                        <!-- Information -->
                        <div class='grid w-full px-5 text-2xl h-fit sm:px-12'>
                            <!-- Account Details -->
                            <form id="accountForm" class="py-5 text-LMtext2">
                                <div class='grid items-center sm:flex'>
                                    <p class='pr-2 font-semibold text-LMtext1 whitespace-nowrap'>First
                                        Name:</p>
                                    <input id="fName" name="firstname" type='text' placeholder='<?= $user["firstName"] ?>' value='<?= $user["firstName"] ?>' class='w-full px-2 text-xl bg-transparent rounded input1 h-fit' readonly></input>
                                </div>
                                <div class='grid items-center pt-5 sm:flex'>
                                    <p class='pr-2 font-semibold text-LMtext1 whitespace-nowrap'>Last
                                        Name:</p>
                                    <input id="lName" name="lastname" type='text' placeholder='<?= $user["lastName"] ?>' value='<?= $user["lastName"] ?>' class='w-full px-2 text-xl bg-transparent rounded input1 h-fit' readonly></input>
                                </div>
                                <div class='grid items-center pt-5 sm:flex'>
                                    <p class='pr-2 font-semibold text-LMtext1 whitespace-nowrap'>Email:
                                    </p>
                                    <input id="email" name="email" type='email' placeholder='<?= $user["email"] ?>' value='<?= $user["email"] ?>' class='w-full px-2 text-xl bg-transparent rounded input1 h-fit' readonly></input>
                                </div>
                                <div class='grid items-center pt-5 sm:flex'>
                                    <p class='pr-2 font-semibold text-LMtext1 whitespace-nowrap'>Phone:
                                    </p>
                                    <input id="phone" name="phone" type='tel' placeholder='<?php if ($user["phone"] != null) { ?>
                                        <?= $user["phone"] ?>
                                        <?php } else { ?>No phone number added.<?php } ?>' value='<?= $user["phone"] ?>' class='w-full px-2 text-xl bg-transparent rounded input1 h-fit' readonly></input>
                                </div>
                            </form>

                            <!-- Password -->
                            <form id="passForm" class='hidden text-LMtext2'>
                                <div class='flex flex-col w-full pt-5'>
                                    <p class='pr-2 font-semibold text-LMtext1'>Current
                                        Password:</p>
                                    <div class="flex">
                                        <input id="current" name="current" type='password' class='w-full px-2 text-xl bg-transparent border-b rounded pwFields current border-LMtext1'></input>
                                        <button type="button"><span class="material-symbols-outlined eyeIcon current" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span></button>
                                    </div>
                                </div>
                                <div class='flex flex-col pt-5'>
                                    <p class='pr-2 font-semibold text-LMtext1 w-fit'>New
                                        Password:
                                    </p>
                                    <div class="flex">
                                        <input id="new" name="new" type='password' class='w-full px-2 text-xl bg-transparent border-b rounded pwFields new border-LMtext1'></input>
                                        <button type="button"><span class="material-symbols-outlined eyeIcon new" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span></button>
                                    </div>
                                </div>
                                <div class='flex flex-col pt-5'>
                                    <p class='pr-2 font-semibold text-LMtext1 w-fit'>Confirm
                                        Password:</p>
                                    <div class="flex">
                                        <input id="confirm" name="confirm" type='password' class='w-full px-2 text-xl bg-transparent border-b rounded pwFields confirm border-LMtext1'></input>
                                        <button type="button"><span class="material-symbols-outlined eyeIcon confirm" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span></button>
                                    </div>
                                </div>
                            </form>

                            <!-- Information Buttons -->
                            <div class='grid justify-center gap-4 pt-5 sm:flex sm:gap-8'>
                                <button id="edit" type="button" class='px-8 text-lg border border-b-4 rounded edit w-52 border-LMtext1 text-LMtext1 hover:bg-LMtext1 hover:text-LMbg'>Edit Details</button>
                                <button id="change" type="button" class='px-8 text-lg border border-b-4 rounded change w-52 border-LMtext1 text-LMtext1 hover:bg-LMtext1 hover:text-LMbg'>Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id='recipes' class="hidden">
                    <p class="py-5 text-2xl text-center">Want to upload a recipe? <a href="upload"
                        class="underline text-accentPink">Start here.</a></p>
                    <?php if ($recipes) { ?> 
                        <!-- Recipe Icons -->
                        <div class="grid py-12 mx-auto w-fit sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 place-items-center gap-x-3 md:gap-x-8 gap-y-20">
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