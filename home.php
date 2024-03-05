<?php


    session_start();

    $conn = mysqli_connect('localhost','admin','admin','main');
    $username = $_SERVER['QUERY_STRING'];
    $query = "SELECT * FROM logins WHERE username='$username'";

    $result = mysqli_query($conn, $query);

    $ans = mysqli_fetch_all($result,MYSQLI_ASSOC);

    if(empty($ans))
    {
        header("Location: index.php");
    }
    echo "Welcome " . $ans[0]["username"] . " twoje haslo to: ".$ans[0]["password"];


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