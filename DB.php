<?php
    define("DBHOST", "localhost");//:
    define("DBUSER", "root");
    define("DBPASS","root");
    define("DBNAME","HRMS");
    
    $connection = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
    $error = mysqli_connect_error();
    if ($error != null){
       echo "<p>could not connect to the database . </p>";
    }
  
   
   
?>