<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
	<title> home</title>
	<link rel="stylesheet" href="StyleSheet.css ">
	<script src="javaScript.js"></script>
</head>
	
	<body >
		<header>
			<nav>
				<ul class="navb">
					<li><a href="aboutUS.html"accesskey="a">About us</a></li>
					<li><a href="help.html"accesskey="q">Help</a> </li>
				</ul>
			</nav>
		</header>
		
		
		<main>
			<a href="index.php"><img src="img/HRMS.png" alt="logo" width="270" height="100"></a><br>

			<br>
			<h1>Welcome to HRMS</h1>
			<button class="EMPbutton" onclick="EMPlogin(); return false;">Employee Log-in</button>
			<button class="MANbutton" onclick="MANlogin(); return false;">Manager Log-in</button>
                        <h4 class="sign">New Employee? <a id="sign" href="EMP_signup.php">Sign Up</a></h4>

		</main>
		
		<footer>
			<img src="img/twitter.png" alt="Twitter" width="30" height="30" onclick="twitter()">
			<img src="img/email.png" alt="Email" width="30" height="30" onclick="email()">
			<img src="img/call.png" alt="phoneNumber" width="30" height="30" onclick="phone()">
			<aside><P>&copy;2021 KSU</P></aside>
		</footer>
	</body>
</html>

