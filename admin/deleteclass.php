<?php
include 'connection.php';

if($_GET['d_id'])
{
    $id=$_GET['d_id'];
}
else{
    die();
}

$sql="delete from classroom where cno='$id'";

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    
       
        header("Location:venue.php");
    
}

pg_close($db);
?>