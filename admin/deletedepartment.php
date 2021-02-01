<?php
include 'connection.php';

if($_GET['dept_id'])
{
    $id=$_GET['dept_id'];
  
}
else{
    die();
}

$sql="delete from department where did=$id";

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    
       
        header("Location:department.php");
    
}

pg_close($db);
?>