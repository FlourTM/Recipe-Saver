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

    <?php if (isset($_GET["msg"]) && $_GET["msg"] == 'loggedin') {
        session_start();
        $user = $_SESSION["userid"];
    ?>
        <script>
            sessionStorage.setItem("userid", 'loggedin')
        </script>
    <?php
    } ?>

    <div name="Home" class='w-full min-h-screen bg-LMbg'>

    </div>
</body>

</html>