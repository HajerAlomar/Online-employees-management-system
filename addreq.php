<?php
//DB connection
if(!isset($_SESSION)) 
{session_start();} 
include('DB.php'); 
$emp_id=$_GET['emp_id'];
$_SESSION['emp_num'] = $emp_id;
$file1=false;
$file2= false;

?>
<!DOCTYPE html>
<html>
	<head>
		<title> Add Request page</title>
		<link rel="stylesheet" href="StyleSheet.css ">
                <link rel="stylesheet" href="StyleSheet.css" type="text/css"/>

		<script src="javaScript.js"></script>
	

	</head>
	
	<body>
		<header>
			<nav>
				<ul class="navb">
                                    <li><a href="Emp_page.php?emp_num=<?php echo $_SESSION['emp_num']?> " accesskey="h"> Employee Home </a></li>
					<li><a href="aboutUS.html"accesskey="a">About us</a></li>
					<li><a href="help.html"accesskey="q">Help</a> </li>

					<div class="logOut">
                                            <a href="logout.php"><img src="img/logOut.png" alt="log out" width="40" height="40"></a></div>
				</ul>
			</nav>

			<ul class="breadcrumbs">
                            <li></><a href="logout.php">Home</a></li>
                            <li><a href="Emp_page.php?emp_num=<?php echo $_SESSION['emp_num']?> "> Employee Home</a></li>
				<li><span>Add Request</span></li>
			</ul>

		</header>

		<element accesskey="character">
			<a href="" accesskey="h"></a><br>
			<a href="" accesskey="c"></a>
		</element>

		<main>
                    <a href="Emp_page.php?emp_num=<?php echo $_SESSION['emp_num']?> "><img src="img/HRMS.png" alt="logo" width="270" height="100"></a><br>
			<h1>HRMS Company</h1>
     

			<div class="formInfo2">
                            <form id="addform" action="addreq.php?emp_id=<?php echo $emp_id;?>" method="POST" enctype="multipart/form-data" >
					<fieldset>
						<legend id="legend">Please fill your request information</legend>
						<br>

						<label for="type">Enter your request service type:</label>
						<select name="sertyp" id="sertyp">
							<option value="promotion">promotion</option>
							<option value="leave">leave</option>
							<option value="resignation">resignation</option>
							<option value="allowance">allowance</option>
							<option value="health insurance">health insurance</option>
						</select>

						<br><br>

						<label for="dscrp">Enter your request service description:</label>
						<br>
						<textarea id="dscrp" name="dscrp" rows="4" cols="30"></textarea>

						<br><br>

						<label for="myfile">Select a file:</label>
						<input type="file" id="fileToUpload1" name="fileToUpload1"  >
                                                <input type="file" id="fileToUpload2" name="fileToUpload2"  >

						<br><br>
						<input type="submit" value="submit" name="submit" />
					
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo $emp_id;
     // check filling all Fields
    if ( empty($_POST['sertyp']) || empty($_POST['dscrp']) || !(is_uploaded_file($_FILES["fileToUpload1"]["tmp_name"])) || !(is_uploaded_file($_FILES["fileToUpload2"]["tmp_name"])))  
        echo '<script> alert("error fill the form")</script> '."<br>";
    else{ // all fields completed
        if (isset($_POST['sertyp'])) {
             $type = mysqli_real_escape_string($connection,$_POST['sertyp']); // checking user input
                //finding service id 
                $sert=$_POST['sertyp']; 
                $sert= "SELECT id FROM `service` WHERE type='$sert'";
                $serid = mysqli_query($connection, $sert);
                $serid = mysqli_fetch_assoc($serid);
                 $serid=$serid['id'];
        
        }
         
        if (isset($_POST['dscrp'])) {
              $dscrp = mysqli_real_escape_string($connection, $_POST['dscrp']);
              $dscrp=$_POST['dscrp'];
           }
   //increment requests' id       
    $maxID= "SELECT MAX(id) FROM `request`";
    $maxID = mysqli_query($connection, $maxID);
    $maxID = mysqli_fetch_assoc($maxID);  
        foreach ($maxID as $maxID) 
          $maxID++;
           
    // create DIRECTORY
    $uploadDir = 'uploads';
     if (!is_dir($uploadDir)){ // check if Directory exist or no
        umask(mask:0);
        mkdir($uploadDir, 0775);
    }
                          
    // allowed files type
    function canupload($fileType){
        $allowedFile =['jpg' ,
                       'jpeg', 
                       'png',
                       'pdf'];
       
        if(in_array($fileType, $allowedFile))     
           echo 1;
          else 
            echo 2;
 } // end of function
  if(isset($_FILES['fileToUpload1']) && $_FILES['fileToUpload1']['error'] ==0){   // check filled in the form without error
       $fi = $_FILES['fileToUpload1']['name'];
          $ext = pathinfo($fi, PATHINFO_EXTENSION);
          
        $canupload1 = canupload($ext);
          if($canupload1){
        // find file name, location, and move it to server
            $FileName1 = $_FILES['fileToUpload1']['name'];
            $file_location1= $uploadDir.'/'.$FileName1;
            $movFile1= move_uploaded_file($_FILES['fileToUpload1']['tmp_name'],$file_location1);
            $file1=true;
          }
         }
    if(isset($_FILES['fileToUpload2']) && $_FILES['fileToUpload2']['error'] ==0){
        $fi2 = $_FILES['fileToUpload2']['name'];
          $ext2 = pathinfo($fi2, PATHINFO_EXTENSION);
          

// check filled in the form without error
         $canupload2 = canupload($ext2);
              if($canupload2){
        // find file name, location, and move it to server
            $FileName2 = $_FILES['fileToUpload2']['name'];
            $file_location2= $uploadDir.'/'.$FileName2;
            $movFile2= move_uploaded_file($_FILES['fileToUpload2']['tmp_name'],$file_location2);
           
            $file2=true;
              }
                      }
                      
                      
if( $file1 == true & $file2 == true){ // if files allowed and move successufully
    $add = "INSERT INTO `request`(`id`, `emp_id`, `service_id`, `description`, `attachment1`, `attachment2`, `status`) VALUES ('$maxID','$emp_id','$serid','$dscrp','$file_location1','$file_location2' ,DEFAULT)";
    $result = mysqli_query($connection, $add);        
   
     echo '<script> alert("your request added correctly")</script> ';
     echo '<script>window.location.href ="reqinfo.php?request_id='.$maxID. '&role=Employee"</script>';
    }
    else 
        echo '<script> alert("error in filling the form .. only PDF, JPEG, JPG, PNG are allowed!")</script> ';
    }// end else all fields filled
} // end POST request
  ?>
       
