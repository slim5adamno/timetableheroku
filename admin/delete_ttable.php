<?php
include 'connection.php';

if($_GET['dept_name'] && $_GET['sem'] && $_GET['sid'] && $_GET['tid'] && $_GET['day'] && $_GET['tslot'])
{
   $dept_name=$_GET['dept_name'];
   $sem=$_GET['sem'];
   $sid=$_GET['sid'];
   $tid=$_GET['tid'];
   $day=$_GET['day'];
   $tslot=$_GET['tslot'];
}
else{
    die();
}

$sql="delete from allot where did=(select did from department where name='$dept_name') and semester='$sem' and sid=$sid and tid=$tid and timeslot='$tslot' and day='$day'";

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    
       
        header("Location:gen-time-table.php");
    
}

pg_close($db);
?>