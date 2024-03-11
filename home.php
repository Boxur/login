<?php


    session_start();
    if(empty($_SESSION["data"]["username"]))
    {
        header("Location: index.php");
    }
    $username = $_SESSION["data"]["username"];
    $password = $_SESSION["data"]["password"];
    echo "Welcome " . $username . " twoje haslo to: ". $password;


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>simple login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>
        <form action="logout.php" method="post">
            <button id="register" type="submit">Log out</button>
        </form>
    </body>
</html>