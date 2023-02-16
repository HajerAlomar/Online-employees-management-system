<?php
	include("db.php");
        if(!isset($_SESSION)) 
{session_start();} 
if(isset($_POST['update'])) {
	
	$request_id = $_POST['request_id'];
	$sertype = $_POST['sertyp'];
	$dscrp = $_POST['dscrp'];
   
    $uploadDir = 'uploads';
    $file1 = false;
    $file2 = false;
    
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
    // both files updated
    if( $file1 == true && $file2 == true ){ // if files allowed and move successufully
            $update = "UPDATE request SET service_id='$sertype', description='$dscrp', attachment1='$file_location1', attachment2='$file_location2' WHERE id='$request_id'";
    }
else 
    if ($file1 == true && $file2 == false){
    //only file 1 updated
    $update = "UPDATE request SET service_id='$sertype', description='$dscrp', attachment1='$file_location1' WHERE id='$request_id'";
    echo $update;
    
    }
    else 
    if ($file1 == false && $file2 == true){
     // only file 2 updated
    $update = "UPDATE request SET service_id='$sertype', description='$dscrp', attachment2='$file_location2' WHERE id='$request_id'";
    }
      else {
   // no files updated
   if ($file1 == false && $file2 == false){
       $update = "UPDATE request SET service_id='$sertype', description='$dscrp' WHERE id='$request_id'";
      }
     }
	$r_update = mysqli_query($connection, $update);
        
}


?>
<p style='background-color:green; color:white;text-align:Center;'>Your reuest saved success</p>
<meta http-equiv="Refresh" content="1; reqinfo.php?request_id=<?php echo $request_id ?>&role=Employee">