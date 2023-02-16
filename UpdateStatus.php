<?php
 include_once('DB.php');
if(!isset($_SESSION)) 
{session_start();} 

    $id=$_GET['request_id'];
    $state=$_GET['state'];
    
   // $id=$_POST['request_id'];
  //  $state=$_POST['state'];
    
  
    $manID= $_SESSION['man_id']=$_GET['man_id'];
    if($state== 'Approve')
        $sql="UPDATE request SET status='Approve' WHERE id=".$id;
    else if($state== 'Decline') 
        $sql="UPDATE request SET status='Decline' WHERE id=".$id;
    
     $sq=mysqli_query($connection, $sql);
  
      

?>

<meta http-equiv="Refresh" content="1; MAN_page.php?&id=<?php echo $_SESSION['man_id']?>">