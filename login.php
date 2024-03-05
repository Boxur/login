<?php

	$errors = ["username"=>"","password"=>""] ;
	$username = "";
	if(isset($_POST["login"]))
	{
		$username = htmlspecialchars($_POST["username"]);
		$password = htmlspecialchars($_POST["password"]);
		//username
		if(empty($_POST["username"]))
			$errors['username'] = "Missing username";
		else
		{
			$username = $_POST["username"];				
		}
		//password
		if(empty($_POST["password"]))
			$errors['password'] =  "Missining password";	
	}

	if(!array_filter($errors))
	{
		if(!empty($username))
		{
			$conn = mysqli_connect('localhost','admin','admin','main');

			$query = "SELECT * FROM logins WHERE username='$username' AND password='$password'";

			$result = mysqli_query($conn, $query);

			$ans = mysqli_fetch_all($result,MYSQLI_ASSOC);

			if(!empty($ans))
			{
				session_start();
				$_SESSION["username"] = $username;
				$_SESSION["data"] = $ans[0];
				header("Location: home.php?{$ans[0]['username']}");
			}
			else
			{
				$errors["username"] = "username or password is incorrect";
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
		<form action="login.php" method="POST">
			<span class="error"><?php echo $errors['username']?></span>
			<input name="username" type="text" value="<?php echo htmlspecialchars($username)?>" placeholder="username" onfocus="this.placeholder=''" onblur="this.placeholder='username'">
			<span class="error"><?php echo $errors['password']?></span>
			<input name="password" type="password" placeholder="password" onfocus="this.placeholder=''" onblur="this.placeholder='password'">
			
			<input name="login" id="login" type="submit" value="Log in">
			
		</form>
		<form action="register.php" method="POST">
		<input name="sth" id="register" type="submit" value="Register">
		</form>
	</div>
	
</body>
</html>