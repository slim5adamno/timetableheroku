<?php
include 'connection.php';

if(isset($_GET['d_id']) && isset($_GET['sem']) && isset($_GET['sid']) && isset($_GET['tid']) && isset($_GET['day']) && isset($_GET['timeslot_id']) &&isset($_GET['year']) && isset($_GET['cno']))
{
   $did=$_GET['d_id'];
   $sem=$_GET['sem'];
   $sid=$_GET['sid'];
   $tid=$_GET['tid'];
   $day=$_GET['day'];
   $timeslot_id=$_GET['timeslot_id'];
   $year=$_GET['year'];
   $cno=$_GET['cno'];
}
else{
    die();
}

$sql="delete from allot where did=$did and semester='$sem' and sid=$sid and tid=$tid and day='$day' and year='$year' and cno=$cno  and timeslot_id=$timeslot_id";

$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    
       
        header("Location:gen-time-table.php");
    
}

pg_close($db);
?>