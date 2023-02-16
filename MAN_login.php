<?php
if(!isset($_SESSION)) 
{session_start();} 
include './DB.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manegar log in</title>
		<link rel="stylesheet" href="StyleSheet.css ">
		<script src="javaScript.js"></script>

	</head>
	
	<body >
		<header>
			<nav>
				<ul class="navb">
					<li><a href="aboutUS.html"accesskey="a">About us</a></li>
					<li><a href="help.html"accesskey="q">Help</a> </li>
					<div class="logOut"><a href="logout.php"> <img src="img/home.png" alt="log out" width="40" height="40"></a></div>
				</ul>
			</nav>

			<ul class="breadcrumbs">
				<li></><a href="logout.php">Home</a></li>
				<li><span>log in</span></li>
			</ul>
		</header>
		

		<main>
			<a href="logout.php"><img src="img/HRMS.png" alt="logo" width="270" height="100"></a><br>
			<h1>HRMS Company</h1>
			<div class="formInfo">

				<form id="form3" action="MAN_login.php" method="POST" >
                                    <div id="error_comments" role="alert"></div>
					<fieldset>
						<legend id="legend">Please fill your information as maneger</legend>
						<br>
						<label for="name">Enter your user name:</label>
						<input type="text"  id="MANname" name="ManName">
						<br><br>
						<label for="password">Enter your password:</label>
						<input type="password" id="MANpassword" name="Manpassword">
						<br><br>
						<div class="formSubmit"><input type="submit" value="LogIn" />   <!--  onClick="validateMANForm();return false;" -->                                       

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
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if($_SERVER['REQUEST_METHOD']== 'POST')
{
    $MAN_name = htmlspecialchars($_POST['ManName']);
    $MAN_pass = htmlspecialchars($_POST['Manpassword']);
    //valedation
    //#1 not empty
   
    if(empty($MAN_name) || empty($MAN_pass)  )
    {
        echo '<script>document.getElementById("error_comments").innerText="Please fill out all the required information"</script>';
    }
    //#2 contains only letters
    else if(!ctype_alpha($MAN_name))
    {
        echo '<script>document.getElementById("error_comments").innerText="Please fill in letter only in the username"</script>';
    }
    else{
        
        $sql_MAN="SELECT * from Manager where username = '".$MAN_name."'";
        echo $sql_MAN;
        $query_MAN= mysqli_query($connection, $sql_MAN);
        if($query_MAN -> num_rows>0)
        {
            $MAN= mysqli_fetch_assoc($query_MAN);
            $MAN_PASSWOER =$MAN['password'];
            //password_verify($MAN_pass, $MAN_PASSWOER
            if(password_verify($MAN_pass, $MAN_PASSWOER))
            {
                $_SESSION['man_id'] = $MAN['id'];
                $_SESSION['man_name'] = $MAN['first_name'].' '.$MAN['last_name'];
                $_SESSION['role'] = 'manager';
                //move to the employee page with the emp name 
                echo '<script>window.location.href="MAN_page.php?id='.$_SESSION['man_id'].'"</script>';
              //  echo '<script>window.location.href="EMP_page.php?emp_id='.$_SESSION['emp_id'].'"</script>';

            }//
            else{
                echo '<script>document.getElementById("error_comments").innerText="Failed in connect with database"</script>';
            }         
        }//
        else{
            echo '<script>document.getElementById("error_comments").innerText="Incorrect username or password"</script>';
        }
    }
} //3

?>
