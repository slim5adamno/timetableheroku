<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
include 'connection.php';
    $sname =strtoupper($_POST['SN']);
    $subcode = $_POST['SC'];
    $sem =strtoupper($_POST['SEM']);
    $subtype=strtoupper($_POST['STYPE']);
    $tname =strtoupper($_POST['TNAME']);
    $cname =strtoupper($_POST['CNAME']);
    $department =strtoupper($_SESSION['dept']);
    $ctype =strtoupper($_SESSION['ctype']);

    pg_last_error();



$sql="select did from department where name='$department'";
$sql1="select tid from teacher where name='$tname'";
$sql2="select cno from course where cname='$cname'";


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
    $id2 =pg_fetch_row($ret2);

}


$sql="insert into subjects values  ($subcode,'$sname','$sem','$subtype',$id1[0],$id2[0])";



$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {


    header("Location:addsubjectstep1.php");


}


pg_close($db);

?>