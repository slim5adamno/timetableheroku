<?php

include 'connection.php';
if (isset($_POST['DNO']) && isset($_POST['DN']) && isset($_POST['STREAM'])) {
    $name =strtoupper($_POST['DN']);
    $dno = $_POST['DNO'];
    $st =strtoupper($_POST['STREAM']);
   
} else {

    die();
}




$sql="insert into department values($dno,'$name','$st')";


$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    
       
        header("Location:department.php");
    
  
}


pg_close($db);

?>