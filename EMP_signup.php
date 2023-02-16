<?php 
if(!isset($_SESSION)) 
{session_start();} 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Employee sing up</title>
		<link rel="stylesheet" href="StyleSheet.css ">
				<script src="javaScript.js"></script>

	</head>
	
	<body >
		<header>
			<nav>
				<ul class="navb">
					<li><a href="aboutUS.php" accesskey="a">About us</a></li>
					<li><a href="help.php" accesskey="q">Help</a> </li>
					<div class="logOut"><a href="logout.php"> <img src="img/home.png" alt="log out" width="40" height="40"></a></div>
				</ul>

				
			</nav>

			<ul class="breadcrumbs">
                            <li><a href="logout.php">Home</a></li>
			     <li><span>Sign up</span></li>
			</ul>
		</header>
		
		
		<main>
			<a href="index.php"><img src="img/HRMS.png" alt="logo" width="270" height="100"></a><br>
			<h1>HRMS Company</h1>
			<div class="formInfo">
				<?php 
					require_once("DB.php");
					if(isset($_POST['submit'])) {
						$EMPfristName = $_POST['first_name'];
						$EMPlastName = $_POST['last_name'];
						$EMPjobTitle = $_POST['job_title'];
						$EMP_num = $_POST['Employee_number'];
						$EMPpassword = password_hash($_POST['EMPpassword'], PASSWORD_DEFAULT);
                                                
                                                
						$maxID= "SELECT MAX(id) FROM `Employee`";
                                                $maxID = mysqli_query($connection, $maxID);
                                                $maxID = mysqli_fetch_assoc($maxID);  
                                                  foreach ($maxID as $maxID) 
                                                       $maxID++;
                                                  
	 					$execution = mysqli_query($connection, "SELECT * FROM Employee WHERE Employee_number='$EMP_num'");
						$num = mysqli_num_rows($execution);
						if($num ==1) {
							echo '<p align="center">this employee number found already in Employee Table</p>';
							
						} else {

							$insert_execution = mysqli_query($connection,"INSERT INTO Employee VALUES(NULL,'$EMP_num','$EMPfristName', '$EMPlastName', '$EMPjobTitle', '$EMPpassword')");
							if($insert_execution) {
								$_SESSION['first_name'] = $EMPfristName;
								$_SESSION['last_name'] = $EMPlastName;
								$_SESSION['Employee_number'] = $EMP_num;
								$_SESSION['job_title'] = $EMPjobTitle;

								echo '<p align="center">You Have Successfully Logged in to employee account</p>';
								?>
			
								<META HTTP-EQUIV="Refresh" Content="5; URL=EMP_page.php?emp_id=<?php echo $maxID; ?> "> 
								<?php
                                                                 
							}
						}


					}	
				?>
				<form id="form2" action="" method="post">
					<fieldset>
						<legend id="legend">Please fill your information as employee</legend>
						<br>
						<label for="name">Enter your first name:</label>
						<input type="text" id="EMPfristName" name="first_name">
						<br><br>
						<label for="name">Enter your last name:</label>
						<input type="text" id="EMPlastName" name="last_name">
						<br><br>
						<label for="name">Enter your employee number:</label>
						<input type="text" id="EMPid" name="Employee_number" maxlength="4">
						<br><br>
						<label for="name">Enter your job title:</label>
						<input type="text"  id="EMPjobTitle" name="job_title">
						<br><br>
						<label for="password">Enter the new password:</label>
						<input type="password" id="EMPpassword" name="EMPpassword">
						<br><br>
						<div class="formSubmit"><input type="submit" onClick="validatesignup();" name="submit" id="submit"
													/>
					</fieldset>

				</form>
			</div>
		</main>
		
		<footer>
			<img src="img/twitter.png" alt="Twitter" width="30" height="30" onclick="twitter()">
			<img src="img/email.png" alt="Email" width="30" height="30" onclick="email()">
			<img src="img/call.png" alt="phoneNumber" width="30" height="30" onclick="phone()">
			<aside><P>&copy;2021 KSU</P></aside>
		</footer>
	</body>
</html>