<?php
include("db.php");
if(!isset($_SESSION)) 
{session_start();} 
$_SESSION['emp_num'] = $_GET['emp_id'];
$sql = "SELECT * FROM `Employee` WHERE id='".$_SESSION['emp_num']."'";
$re= mysqli_query($connection, $sql);
$res= mysqli_fetch_assoc($re);

$_SESSION['first_name']=$res['first_name'];
$_SESSION['last_name']=$res['last_name'];
$_SESSION['Employee_number']=$res['Employee_number'];
$_SESSION['job_title']=$res['job_title'];
$_SESSION['id']=$res['id'];

$emp_name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
$Employee_number = $_SESSION['Employee_number'];
$job_title = $_SESSION['job_title'];
$emp_id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Employee page</title>
		<link rel="stylesheet" href="StyleSheet.css ">
		<script src="javaScript.js"></script>
	</head>
	
	<body >
	    <header>
			<nav>
				<ul class="navb">
					<li><a href="aboutUS.html"accesskey="a">About us</a></li>
					<li><a href="help.html"accesskey="q">Help</a> </li>
					<div class="logOut-add">
						<a href="addreq.php?emp_id=<?php echo $_SESSION['id'];?> "><img src="img/add req.png" alt="add request" width="40" height="40" ></a>
						<a href="logout.php" > <img src="img/logOut.png" alt="log out" width="40" height="40"></a>
					
                                        </div>
				</ul>
			</nav>
		</header>
		
		
		<main>
                    <a href="EMP_page.php?emp_num=<?php echo $_SESSION['emp_num']?> "><img src="img/HRMS.png" alt="logo" width="270" height="100"></a><br>
			<h1>HRMS Company</h1>

			<h2>Welcome [<?php echo $emp_name; ?>]</h2>
			<h3>Emplpyee's ID: <?php echo $Employee_number; ?></h3>
			<h3>Job Title: <?php echo $job_title; ?></h3>


			<div class="add">
				<table class="t0">
					<caption>Requests</caption>
					<tr>
						<th class="z0" colspan="2">In Progress</th>
					</tr>
					<tr class="r2">
							<td>Requests</td>
							<td >Status</td>
						</tr>

<tr>
<td colspan="2">
	<?php
	$q1 = "SELECT * FROM request where emp_id='". $_SESSION['emp_num'] ."' and status='in_progress'";
	$r1 = mysqli_query($connection, $q1);
	$c1 = mysqli_num_rows($r1);
	if($c1==0) {
		echo "<p style='background-color:red; color:white;text-align:Center;'>No In Progress
 Requests</p>";
	} else {
		while($row1 = mysqli_fetch_array($r1)) {
	?>
		<tr><td class="p0">
                        <a href="reqinfo.php?request_id=<?php echo $row1['id'] ?>&role=Employee">
				<?php 
					echo $row1['id'];
					echo " - ";
					$service_id = $row1['service_id'];
					 $q2 = "SELECT * FROM service where id=$service_id";
					$r2 = mysqli_query($connection, $q2);
					$row2 = mysqli_fetch_array($r2);
					echo $row2['type'];
				?>
			</a>
			</td>
			
			<td class="t3"><a href="edit.php?request_id=<?php echo $row1['id'] ?>">Edit</a></td>
		</tr>
	<?php
		}
	}
?>
</td>
</tr>
				</table>

				<br>
				<br>
				<div class="t1">
                                    <table class="t0">

						<tr>
							<th class="z0" colspan="3">Previous Requests	</th>
						</tr>
						<tr class="r2">
							<td>Requests</td>
							<td colspan="2">Status</td>
						</tr>
						
<?php
	  $q1 = "SELECT * FROM request where emp_id='$emp_id' and status<>'in_progress'";
	$r1 = mysqli_query($connection, $q1);
	$c1 = mysqli_num_rows($r1);
	if($c1==0) {
		echo "<p style='background-color:red; color:whit;text-align:Center;'>No Not In Progress
 Requests</p>";
	} else {
		//$t = 1;
		while($row1 = mysqli_fetch_array($r1)) {
	?>
		<tr>
			<td class="p0">

			<a href="reqinfo.php?request_id=<?php echo $row1['id'] ?>&role=Employee">
				<?php 
					echo $row1['id'];
					echo " - ";
					$service_id = $row1['service_id'];
					 $q2 = "SELECT * FROM service where id=$service_id";
					$r2 = mysqli_query($connection, $q2);
					$row2 = mysqli_fetch_array($r2);
					echo $row2['type'];
				?>
			</a>
				
			</td>
			<td class="a1">
					<?php
					if( $row1['status'] == "in_progress") {
						echo 'In progress';
					} else if( $row1['status'] == 'Approve') {
						echo 'Approved';
					} elseif( $row1['status'] == 'Decline') {
						echo 'Declined';
					}
					?>
				</td>
			<td class="t5"><a href="edit.php?request_id=<?php echo $row1['id'] ?>">Edit</a></td>
		</tr>
	<?php
		}
	}
?>



					</table>
				</div>




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