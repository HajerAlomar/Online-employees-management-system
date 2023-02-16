<?php
if(!isset($_SESSION)) 
{session_start();} 
include("db.php");
$request_id  = $_GET['request_id'];					
$q1 = "SELECT * FROM request where id=$request_id";
$r1 = mysqli_query($connection, $q1);
$row1 = mysqli_fetch_array($r1);
$_SESSION['emp_num'] = $row1['emp_id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Edit Request page</title>
		<link rel="stylesheet" href="StyleSheet.css">
		<script src="javaScript.js"></script>
	
	</head>
	
	<body >
		<header>
			<nav>
				<ul class="navb">
					<li><a href="EMP_page.php?emp_num=<?php echo $_SESSION['emp_num']?> " accesskey="h"> Employee Home </a></li>
					<li><a href="aboutUS.html"accesskey="a">About us</a></li>
					<li><a href="help.html"accesskey="q">Help</a> </li>

					<div class="logOut">
                                            <a href="logout.php"> <img src="img/logOut.png" alt="log out" width="40" height="40"></a></div>
				</ul>
			</nav>

			<ul class="breadcrumbs">
                            <li></><a href="logout.php">Home</a></li>
				<li><a href="EMP_page.php?emp_num=<?php echo $_SESSION['emp_num']?>" > Employee Home</a></li>
				<li><span>Edit Request </span></li>
			</ul>

		</header>
		
		
		<main>
                    <a href="EMP_page.php?emp_num=<?php echo $_SESSION['emp_num']?> ">
				<img src="img/HRMS.png" alt="logo" width="270" height="100">
				</a>
				<br>
				<h1>HRMS Company</h1>
				<div class="formInfo2">

                                    <form id="addform" action="saveUpdate.php?request_id=<?php echo $row1['id']?>" method="POST" enctype="multipart/form-data">
						<fieldset>
							<legend id="legend">Please fill your request information</legend>
							<br>

							<label for="type">Enter your request service type:</label>
							<select name="sertyp" id="sertyp">
								<?php
								$q2 = "SELECT * FROM service";
								$r2 = mysqli_query($connection, $q2);
								while($row2 = mysqli_fetch_array($r2)) {
									$service_id = $row1['service_id'];
									if($row2['id'] == $service_id) {
										echo "<option value='" . $row2['id'] . "' selected='selected'>" . $row2['type'] . "</option>";
									} else {
										echo "<option value='" . $row2['id'] . "'>" . $row2['type'] . "</option>";
									}
								}
							?>
								
							</select>

							<br><br>

							<label for="dscrp">Enter your request service description:</label>
							<br>
							<textarea id="dscrp" name="dscrp" rows="4" required cols="30"><?php echo $row1['description']; 
                                                        
                                                        ?> </textarea>

							<br><br>

							<label for="myfile">Select a file:</label>
							<input type="file" id="fileToUpload1" name="fileToUpload1"  > 
                                                        <input type="file" id="fileToUpload2" name="fileToUpload2"  >
                                                        
							<input type="hidden" id="request_id" name="request_id" value="<?php echo $request_id ?>">

							<br><br>
							<input type="submit" value="update" name="update" onclick="check(); " />


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

