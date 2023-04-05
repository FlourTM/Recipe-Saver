<link href="./css/input.css" rel="stylesheet">
<link href="./css/output.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<nav class="navbar">
    <script type="module" src="javascript/navbar.js"></script>

    <!-- Desktop Navbar -->
    <div class="hidden md:block fixed top-0 left-0 w-full bg-LMbg z-20">
        <div class="flex gap-11 lg:gap-16 justify-center py-2 px-5 border-b border-LMtext1">
            <button id="index" class="nav-item flex items-center gap-1">
                <span class="material-symbols-outlined" style="font-size:44px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">home</span>
                <h1 class="text-xl lg:text-2xl">HOME</h1>
            </button>

            <button id="allrecipes" class="nav-item flex items-center gap-1">
                <span class="material-symbols-outlined" style="font-size:44px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">flatware</span>
                <h1 class="text-xl lg:text-2xl">ALL RECIPES</h1>
            </button>

            <button id="myrecipes" class="nav-item flex items-center gap-1">
                <span class="material-symbols-outlined" style="font-size:44px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">favorite</span>
                <h1 class="text-xl lg:text-2xl">MY RECIPES</h1>
            </button>

            <button id="acc" class="nav-item flex items-center gap-1">
                <span class="material-symbols-outlined" style="font-size:44px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">account_circle</span>
                <h1 class="text-xl lg:text-2xl">ACCOUNT</h1>
            </button>
        </div>
    </div>

    <!-- Mobile Navbar -->
    <div class="md:hidden fixed bottom-0 left-0 w-full bg-LMbg z-20">
        <div class="flex justify-between py-2 px-5 sm:px-10 border-t border-LMtext1">
            <button id="index" class="nav-item">
                <span class="material-symbols-outlined" style="font-size:52px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">home</span>
                <h1 class="text-md sm:text-xl">HOME</h1>
            </button>

            <button id="allrecipes" class="nav-item">
                <span class="material-symbols-outlined" style="font-size:52px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">flatware</span>
                <h1 class="text-md sm:text-xl">ALL RECIPES</h1>
            </button>

            <button id="myrecipes" class="nav-item">
                <span class="material-symbols-outlined" style="font-size:52px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">favorite</span>
                <h1 class="text-md sm:text-xl">MY RECIPES</h1>
            </button>

            <button id="acc" class="nav-item">
                <span class="material-symbols-outlined" style="font-size:52px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">account_circle</span>
                <h1 class="text-md sm:text-xl">ACCOUNT</h1>
            </button>
        </div>
    </div>

    <!-- Login/Register Popup -->
    <dialog id='loginRegisterOverlay' class='hidden w-full h-full fixed pt-36 flex justify-center z-10 bg-black-rgba'>
        <div class='border-2 border-LMtext1 rounded p-5 bg-LMbg w-96 h-fit'>
            <p id="confirm-msg" class="confirm-message text-center text-lg text-red-600">
            <?php
            if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
                session_start();
                echo ($_SESSION["msg"]);
            } ?>
            </p>

            <div class='flex justify-between items-center pb-3'>
                <h1 id='header' class='text-LMtext1 text-3xl font-bold'>Log In</h1>
                <button id='close'><span class="material-symbols-outlined" style="font-size:32px">close</span></button>
            </div>
            <!-- Login -->
            <form id='login' class='text-LMtext1'>
                <!-- Header -->
                <p class='text-LMtext2 text-lg pb-5'>New to Recipe Saver? <button id='loginToReg' type='button' class='font-semibold'>Register here</button></p>

                <h2 class='text-xl font-semibold pb-3'>Email</h2>
                <input id="lemail" name="lemail" type='email' placeholder='Email' class='pwFields rounded px-2 w-full text-lg bg-transparent border border-LMtext2'></input>

                <h2 class='text-xl font-semibold pt-5 pb-3'>Password</h2>
                <div class='flex relative'>
                    <input id="lpass" name="lpassword" type='password' placeholder='Password' class='pwFields lpass rounded px-2 w-full text-lg bg-transparent border border-LMtext2'></input>
                    <button type="button">
                        <span class="material-symbols-outlined eyeIcon lpass" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span>
                    </button>
                </div>

                <!-- Button -->
                <div class='flex justify-center'>
                    <button id='loginBtn' type="submit" class='my-8 rounded px-8 w-fit text-lg border border-b-4 border-LMtext1 text-LMtext1
                        hover:bg-LMtext1 hover:text-LMbg'>Log In</button>
                </div>

                <p class='text-lg'>By logging in, you agree to the Terms & Conditions and
                    Privacy Policy.</p>
            </form>

            <!-- Register -->
            <form id='register' class='hidden text-LMtext1'>
                <p class='text-LMtext2 text-lg pb-5'>Already have an account? <button id='regToLogin' type='button' class='font-semibold'>Log in here</button></p>

                <!-- Name -->
                <div class='flex gap-5'>
                    <div>
                        <h2 class='text-xl font-semibold pb-3'>First Name</h2>
                        <input id="rfirstName" name="firstName" type='text' placeholder='First Name' 
                            class='pwFields rounded px-2 w-full text-lg bg-transparent border border-LMtext2'></input>
                    </div>
                    <div>
                        <h2 class='text-xl font-semibold pb-3'>Last Name</h2>
                        <input id="rlastName" name="lastName" type='text' placeholder='Last Name' 
                            class='pwFields rounded px-2 w-full text-lg bg-transparent border border-LMtext2'></input>
                    </div>
                </div>

                <h2 class='text-xl font-semibold pt-5 pb-3'>Email</h2>
                <input id="remail" name="remail" type='email' placeholder='Email' class='pwFields rounded px-2 w-full text-lg bg-transparent border border-LMtext2'></input>

                <h2 class='text-xl font-semibold pt-5 pb-3'>Password</h2>
                <div class='flex relative'>
                    <input id="rpass" name="rpassword" type='password' placeholder='Password' class='pwFields rpass rounded px-2 w-full text-lg bg-transparent border border-LMtext2'></input>
                    <button type="button">
                        <span class="material-symbols-outlined eyeIcon rpass" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span>
                    </button>
                </div>

                <h2 class='text-xl font-semibold pt-5 pb-3'>Confirm Password</h2>
                <div class='flex relative'>
                    <input id="rconfirm" name="confirmpassword" type='password' placeholder='Password' class='pwFields rconfirm rounded px-2 w-full text-lg bg-transparent border border-LMtext2'></input>
                    <button type="button">
                        <span class="material-symbols-outlined eyeIcon rconfirm" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span>
                    </button>
                </div>

                <!-- Button -->
                <div class='flex justify-center'>
                    <button id='registerBtn' type="submit" class='my-8 rounded px-8 w-fit text-lg border border-b-4 border-LMtext1 text-LMtext1
                        hover:bg-LMtext1 hover:text-LMbg'>Register</button>
                </div>

                <p class='text-lg'>By creating an account, you agree to the Terms &
                    Conditions and Privacy Policy.</p>
            </form>
        </div>
    </dialog>
</nav>