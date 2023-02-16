<?php
if(!isset($_SESSION)) 
{session_start();} 
include "DB.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Employee log in</title>
		<link rel="stylesheet" href="StyleSheet.css ">
		<script src="javaScript.js"></script>
	</head>
	
	<body>
		<header>
			<nav>
				<ul class="navb">
					<li><a href="aboutUS.html"accesskey="a">About us</a></li>
					<li><a href="help.html"accesskey="q">Help</a> </li>
					<div class="logOut"><a href="index.php"> <img src="img/home.png" alt="log out" width="40" height="40"></a></div>
				</ul>
			</nav>

			<ul class="breadcrumbs">
				<li></><a href="index.php">Home</a></li>
				<li><span>Log in</span></li>
			</ul>

		</header>
		
		
		<main>
			<a href="index.php"><img src="img/HRMS.png" alt="logo" width="270" height="100"></a><br>
			<h1>HRMS Company</h1>
			<div class="formInfo">
                            <div id="error_comments" role="alert"></div>
                            <form name="loginForm"  id="form1"  action="EMP_login.php" method="POST"> <!-- onSubmit="return EmpName1();" -->
					<fieldset>
						<legend id="legend">Please fill your information as employee</legend>
						<br>
						<label for="name">Enter your Employee number:</label>
						<input type="text"  id="EMPname" name="EMPNum">
						<br><br>
						<label for="password">Enter your password:</label>
						<input type="password" id="EMPpassword" name="Emppassword">
						<br><br>
                                                <div class="formSubmit"><input type="submit" value="LogIn"  /> <!-- onclick="validateEMPForm(); return false;" -->
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
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
  
    $EMP_num = htmlspecialchars($_POST['EMPNum']); // User name in Form
    $EMP_pass = htmlspecialchars($_POST['Emppassword']); // password in Form
    //valedation
    //#1 not empty
    if(empty($EMP_num) || empty($EMP_pass)  )
    {
        echo '<script>document.getElementById("error_comments").innerText="Please fill out all the required information"</script>';
    }
    else if (!ctype_digit($EMP_num)){
            echo '<script>document.getElementById("error_comments").innerText="Please fill in numbers only in the employee number"</script>';

        }
        
        else{
         // name in Form
        $sql_EMP="SELECT * FROM `Employee` WHERE `Employee_number` ='".$EMP_num."'";
        $query_EMP= mysqli_query($connection, $sql_EMP);
        if($query_EMP -> num_rows>0)
        {
            $EMP= mysqli_fetch_assoc($query_EMP);
            $EMP_PASSWOER =$EMP['password'];
            echo  $EMP_PASSWOER . $EMP['first_name']  . "<br>";  // name & password from DB
            echo  $EMP_name . $EMP_pass ;
            if(password_verify($EMP_pass,$EMP_PASSWOER))
            {
                $_SESSION['emp_num'] = $EMP['Employee_number'];
                $_SESSION['emp_name'] = $EMP['first_name'].''.$EMP['last_name'];
                $_SESSION['role'] = 'employee';
                 $_SESSION['emp_id'] = $EMP['id'];
                //move to the employee page with the emp name 
               echo '<script>window.location.href="EMP_page.php?emp_id='.$_SESSION['emp_id'].'"</script>';

            }//
        else{
            echo '<script>document.getElementById("error_comments").innerText="Failed in connect with database"</script>';
          }
        }
            else{
                echo '<script>document.getElementById("error_comments").innerText="Incorrect employee number or password"</script>';
            }         
        }//
        
      }
   // } //3
      else{
         echo 'error with method post in the form';  
}

?>