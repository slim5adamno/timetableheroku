<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
include 'connection.php';
    $sname =strtoupper($_POST['SN']);
    $subcode = strtoupper($_POST['SC']);
    $sem =strtoupper($_POST['SEM']);
    $subtype=strtoupper($_POST['STYPE']);
    $tid = intval($_POST['TNAME']);
    $department = intval($_POST['TDP']);
    $ctype =strtoupper($_SESSION['ctype']);
    $stream =strtoupper($_SESSION['stream']);
    $year = strtoupper($_POST['YEAR']);

//$sql="select did from department where did=$department";
//$sql1="select tid from teacher where name='$tname'";
$sql2="select * from subjects order by sid desc limit 1";

//$ret = pg_query($db, $sql);
//$ret1 = pg_query($db,$sql1);
$ret2 = pg_query($db,$sql2);
/*if(!$ret) {
    echo pg_last_error($db);
} else {
    $id =pg_fetch_row($ret);

}
if(!$ret1) {
    echo pg_last_error($db);
} else {
    $id1 =pg_fetch_row($ret1);

}*/

if(!$ret2) {
    echo pg_last_error($db);
} else {
    $num_rows =pg_fetch_row($ret2);

}
$num_rows[0]++;

$sql="insert into subjects values  ($num_rows[0],'$sname','$sem','$subtype',$tid,$department,'$year','$subcode')";



$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {


    header("Location:addsubjectstep1.php");


}


pg_close($db);

?>