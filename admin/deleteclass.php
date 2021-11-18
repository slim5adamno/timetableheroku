<?php
include 'connection.php';

if($_GET['d_id'] && $_GET['time'] && $_GET['sem'])
{
    $id=$_GET['d_id'];
    $time=$_GET['time'];
    $sem = $_GET['sem'];
}
else{
    die();
}

$sql="delete from classroom_allot where cno=$id and time='$time' and semester='$sem'";
$sql1="select * from classroom_allot where cno=$id";

$ret = pg_query($db, $sql);
$ret1 = pg_query($db,$sql1);
if(!$ret || !$ret1) {
   echo pg_last_error($db);
} else {
    $num_rows = pg_num_rows($ret1);
    if($num_rows == 0) {
        $sql2 = "delete from classroom where cno=$id";
        $ret2 = pg_query($db,$sql2);
    }
    
       
        header("Location:venue.php");
    
}

pg_close($db);
?>