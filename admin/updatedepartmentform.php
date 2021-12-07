<?php

include 'connection.php';
if (isset($_POST['DNO']) && isset($_POST['DN']) && isset($_POST['STREAM']) && isset($_POST['course_type'])) {
    $name =strtoupper($_POST['DN']);
    $dno = $_POST['DNO'];
    $st =strtoupper($_POST['STREAM']);
    $ct = strtoupper($_POST['course_type']);
} else {

    die();
}




$sql="update department set name='$name',stream='$st',ctype='$ct' where did=$dno";


$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {


    header("Location:updatedepartment.php");


}


pg_close($db);

?>