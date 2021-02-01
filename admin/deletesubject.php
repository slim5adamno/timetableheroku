<?php
include 'connection.php';

if($_GET['c_id'])
{
    $id=$_GET['c_id'];
  
}
else{
    die();
}

$sql="delete from subjects where sid=$id";

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    
       
        header("Location:addsubjectstep1.php");
    
}

pg_close($db);
?>