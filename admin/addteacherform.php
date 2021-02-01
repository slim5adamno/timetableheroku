<?php

include 'connection.php';
if (isset($_POST['TF']) && isset($_POST['TN']) && isset($_POST['TD']) && isset($_POST['TDP']) && isset($_POST['TP']) && isset($_POST['TE'])) {
    $name =strtoupper($_POST['TN']);
    $facno = $_POST['TF'];
    $designation =strtoupper($_POST['TD']);
    $department =strtoupper($_POST['TDP']);
    $contact = $_POST['TP'];
    $email = strtoupper($_POST['TE']);
} else {

    die();
}


  
$sql="select did from department where name='$department'"; 


$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    $id =pg_fetch_row($ret);
  
}


$sql="insert into teacher values  ($facno,'$name','$designation','$contact','$email',$id[0])";


$ret = pg_query($db, $sql);
if(!$ret) {
   echo pg_last_error($db);
} else {
    
       
        header("Location:addlecturer.php");
    
  
}


pg_close($db);

?>