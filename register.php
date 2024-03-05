<?php

	$errors = ["username"=>"","email"=>"","password"=>"","repeat-password"=>""] ;
	$email = "";
    $username = "";
    $password = "";
	if(isset($_POST["email"]))
	{
		//email
		if(empty($_POST["email"]))
			$errors['email'] = "Missing email";
		else
		{
			$email = $_POST["email"];
			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$errors['email']="This is not an email";
			}
				
		}
		//password
		if(empty($_POST["password"]))
			$errors['password'] =  "Missining password";
        else
            if($_POST['password']!=$_POST['repeat-password'])
                $errors['repeat-password']="the passwords don't mach";
        if(empty($_POST['username']))
            $errors['username']= 'this can\'t be empty';
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
	}
    

	if(!array_filter($errors))
	{
        if(!empty($email))
        {
            $conn = mysqli_connect('localhost','admin','admin','main');
            $sql = "SELECT * FROM logins WHERE email='$email' OR username='$username'";
            $result = mysqli_query($conn, $sql);
            $response = mysqli_fetch_all($result,MYSQLI_ASSOC);
            if(empty($response))
            {
                $sql = "INSERT INTO `logins`(`id`, `username`, `password`, `email`) VALUES (NULL,'$username','$password','$email')";
                mysqli_query($conn, $sql);
                header("Location: created.php");
            }
            else
            {
                $errors['username']="given username or email are already used";
            }
        }
        
			
	}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>simple login</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
	<link rel="stylesheet" href="style.css" type="text/css" />
	
</head>

<body>

	<div id="container">
		<form action="register.php" method="POST">
            <span class="error"><?php echo $errors['username']?></span>
			<input name="username" type="text" value="<?php echo htmlspecialchars($username)?>" placeholder="username" onfocus="this.placeholder=''" onblur="this.placeholder='username'">
			<span class="error"><?php echo $errors['email']?></span>
			<input name="email" type="text" value="<?php echo htmlspecialchars($email)?>" placeholder="email" onfocus="this.placeholder=''" onblur="this.placeholder='email'">
			<span class="error"><?php echo $errors['password']?></span>
			<input name="password" type="password" placeholder="password" onfocus="this.placeholder=''" onblur="this.placeholder='password'">
            <span class="error"><?php echo $errors['repeat-password']?></span>
			<input name="repeat-password" type="password" placeholder="repeat password" onfocus="this.placeholder=''" onblur="this.placeholder='repeat password'">

			<input name="register" id="login" type="submit" value="Register">
			
		</form>
	</div>
	
</body>
</html>