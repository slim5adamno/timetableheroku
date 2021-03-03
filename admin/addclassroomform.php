<?php

include 'connection.php';
if (isset($_POST['CN']) && isset($_POST['TDP']) && isset($_POST['SEM']) && isset($_POST['YEAR'])) {
    
    $cno = $_POST['CN'];
    $dept = $_POST['TDP'];
    $sem = $_POST['SEM'];
    $year = $_POST['YEAR'];
   
} else {

    die();
}

$sql="select did from department where name='$dept'";


$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {
    $id =pg_fetch_row($ret);

}

$sql="insert into classroom values ($cno,'$year','$sem',$id[0])";


$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
        header("Location:venue.php");
}


pg_close($db);

?>