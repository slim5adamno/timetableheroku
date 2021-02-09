<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
include 'connection.php';
    $sname =strtoupper($_POST['SN']);
    $subcode = strtoupper($_POST['SC']);
    $sem =strtoupper($_POST['SEM']);
    $subtype=strtoupper($_POST['STYPE']);
    $tname =strtoupper($_POST['TNAME']);
    $department =strtoupper($_POST['TDP']);
    $ctype =strtoupper($_SESSION['ctype']);
    $year = strtoupper($_POST['YEAR']);

$sql="select did from department where name='$department'";
$sql1="select tid from teacher where name='$tname'";
$sql2="select * from subjects";

$ret = pg_query($db, $sql);
$ret1 = pg_query($db,$sql1);
$ret2 = pg_query($db,$sql2);
if(!$ret) {
    echo pg_last_error($db);
} else {
    $id =pg_fetch_row($ret);

}
if(!$ret1) {
    echo pg_last_error($db);
} else {
    $id1 =pg_fetch_row($ret1);

}

if(!$ret2) {
    echo pg_last_error($db);
} else {
    $num_rows =pg_num_rows($ret2);

}
$num_rows++;

$sql="insert into subjects values  ($num_rows,'$sname','$sem','$subtype',$id1[0],$id[0],'$year','$subcode')";



$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {


    header("Location:addsubjectstep1.php");


}


pg_close($db);

?>