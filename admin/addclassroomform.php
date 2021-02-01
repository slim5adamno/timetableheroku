<?php

include 'connection.php';
if (isset($_POST['CN'])) {
    
    $cno = $_POST['CN'];
   
} else {

    die();
}


$sql="insert into classroom values ($cno)";


$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
        header("Location:venue.php");
}


pg_close($db);

?>