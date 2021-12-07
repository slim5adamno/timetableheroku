<?php
include 'connection.php';

if($_GET['t_id'])
{
    $id=$_GET['t_id'];
    
}
else{
    die();
}

$sql="delete from teacher where tid=$id";

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    
       
        header("Location:view-lecturer.php");
    
}

pg_close($db);
?>