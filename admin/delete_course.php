<?php
include 'connection.php';

if($_GET['c_id'])
{
    $id=$_GET['c_id'];

}
else{
    die();
}

$sql="delete from course where cno=$id";

$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {


    header("Location:add_course.php");

}

pg_close($db);
?>