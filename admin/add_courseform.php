<?php

include 'connection.php';
if (isset($_POST['course_id']) && isset($_POST['course_name']) && isset($_POST['course_type']) && isset($_POST['TDP'])) {
    $cname =strtoupper($_POST['course_name']);
    $cid = $_POST['course_id'];
    $ctype =strtoupper($_POST['course_type']);
    $dname =strtoupper($_POST['TDP']);

} else {

    die();
}



$sql="select did from department where name='$dname'";


$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {
    $id =pg_fetch_row($ret);

}


$sql="insert into course values  ($cid,'$cname','$ctype',$id[0])";



$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {


    header("Location:add_course.php");


}


pg_close($db);

?>