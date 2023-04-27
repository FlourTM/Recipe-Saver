<link href="./css/input.css" rel="stylesheet">
<link href="./css/output.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<nav class="navbar">
    <script type="module" src="javascript/navbar.js"></script>

    <!-- Desktop Navbar -->
    <div class="fixed top-0 left-0 z-20 hidden w-full md:block bg-LMbg">
        <div class="flex justify-center px-5 py-2 border-b gap-11 lg:gap-16 border-LMtext1">
            <button id="index" class="flex items-center gap-1 nav-item">
                <span class="material-symbols-outlined" style="font-size:44px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">home</span>
                <h1 class="text-xl lg:text-2xl">HOME</h1>
            </button>

            <button id="allrecipes" class="flex items-center gap-1 nav-item">
                <span class="material-symbols-outlined" style="font-size:44px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">flatware</span>
                <h1 class="text-xl lg:text-2xl">ALL RECIPES</h1>
            </button>

            <button id="myrecipes" class="flex items-center gap-1 nav-item">
                <span class="material-symbols-outlined" style="font-size:44px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">favorite</span>
                <h1 class="text-xl lg:text-2xl">MY RECIPES</h1>
            </button>

            <button id="acc" class="flex items-center gap-1 nav-item">
                <span class="material-symbols-outlined" style="font-size:44px;font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 48;">account_circle</span>
                <h1 class="text-xl lg:text-2xl">ACCOUNT</h1>
            </button>
        </div>
    </div>

    <!-- Mobile Navbar -->
    <div class="fixed bottom-0 left-0 z-20 w-full md:hidden bg-LMbg">
        <div class="flex justify-between px-5 py-2 border-t sm:px-10 border-LMtext1">
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
    <dialog id='loginRegisterOverlay' class='fixed z-10 flex justify-center hidden w-full h-full pt-36 bg-black-rgba'>
        <div class='p-5 border-2 rounded border-LMtext1 bg-LMbg w-96 h-fit'>
            <p id="confirm-msg" class="text-lg text-center text-red-600 confirm-message"></p>

            <div class='flex items-center justify-between pb-3'>
                <h1 id='header' class='text-3xl font-bold text-LMtext1'>Log In</h1>
                <button id='close'><span class="material-symbols-outlined" style="font-size:32px">close</span></button>
            </div>
            <!-- Login -->
            <form id='login' class='text-LMtext1'>
                <!-- Header -->
                <p class='pb-5 text-lg text-LMtext2'>New to Recipe Saver? <button id='loginToReg' type='button' class='font-semibold'>Register here</button></p>

                <h2 class='pb-3 text-xl font-semibold'>Email</h2>
                <input id="lemail" name="lemail" type='email' placeholder='Email' class='w-full px-2 text-lg bg-transparent border rounded pwFields border-LMtext2'></input>

                <h2 class='pt-5 pb-3 text-xl font-semibold'>Password</h2>
                <div class='relative flex'>
                    <input id="lpass" name="lpassword" type='password' placeholder='Password' class='w-full px-2 text-lg bg-transparent border rounded pwFields lpass border-LMtext2'></input>
                    <button type="button">
                        <span class="material-symbols-outlined eyeIcon lpass" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span>
                    </button>
                </div>

                <!-- Button -->
                <div class='flex justify-center'>
                    <button id='loginBtn' type="submit" class='px-8 my-8 text-lg border border-b-4 rounded w-fit border-LMtext1 text-LMtext1 hover:bg-LMtext1 hover:text-LMbg'>Log In</button>
                </div>

                <p class='text-lg'>By logging in, you agree to the Terms & Conditions and
                    Privacy Policy.</p>
            </form>

            <!-- Register -->
            <form id='register' class='hidden text-LMtext1'>
                <p class='pb-5 text-lg text-LMtext2'>Already have an account? <button id='regToLogin' type='button' class='font-semibold'>Log in here</button></p>

                <!-- Name -->
                <div class='flex gap-5'>
                    <div>
                        <h2 class='pb-3 text-xl font-semibold'>First Name</h2>
                        <input id="rfirstName" name="firstName" type='text' placeholder='First Name' 
                            class='w-full px-2 text-lg bg-transparent border rounded pwFields border-LMtext2'></input>
                    </div>
                    <div>
                        <h2 class='pb-3 text-xl font-semibold'>Last Name</h2>
                        <input id="rlastName" name="lastName" type='text' placeholder='Last Name' 
                            class='w-full px-2 text-lg bg-transparent border rounded pwFields border-LMtext2'></input>
                    </div>
                </div>

                <h2 class='pt-5 pb-3 text-xl font-semibold'>Email</h2>
                <input id="remail" name="remail" type='email' placeholder='Email' class='w-full px-2 text-lg bg-transparent border rounded pwFields border-LMtext2'></input>

                <h2 class='pt-5 pb-3 text-xl font-semibold'>Password</h2>
                <div class='relative flex'>
                    <input id="rpass" name="rpassword" type='password' placeholder='Password' class='w-full px-2 text-lg bg-transparent border rounded pwFields rpass border-LMtext2'></input>
                    <button type="button">
                        <span class="material-symbols-outlined eyeIcon rpass" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span>
                    </button>
                </div>

                <h2 class='pt-5 pb-3 text-xl font-semibold'>Confirm Password</h2>
                <div class='relative flex'>
                    <input id="rconfirm" name="confirmpassword" type='password' placeholder='Password' class='w-full px-2 text-lg bg-transparent border rounded pwFields rconfirm border-LMtext2'></input>
                    <button type="button">
                        <span class="material-symbols-outlined eyeIcon rconfirm" style="font-size:24px;margin-left:-32px;margin-top:4px;">visibility_off</span>
                    </button>
                </div>

                <!-- Button -->
                <div class='flex justify-center'>
                    <button id='registerBtn' type="submit" class='px-8 my-8 text-lg border border-b-4 rounded w-fit border-LMtext1 text-LMtext1 hover:bg-LMtext1 hover:text-LMbg'>Register</button>
                </div>

                <p class='text-lg'>By creating an account, you agree to the Terms &
                    Conditions and Privacy Policy.</p>
            </form>
        </div>
    </dialog>
</nav>